<?php

namespace App\Controller;

use App\Entity\ListOfTodo;
use App\Form\ListOfTodoType;
use App\Repository\ListOfTodoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/list/of/todo')]
class ListOfTodoController extends AbstractController
{
    #[Route('/', name: 'app_list_of_todo_index', methods: ['GET'])]
    public function index(ListOfTodoRepository $listOfTodoRepository): Response
    {
        return $this->render('list_of_todo/index.html.twig', [
            'list_of_todos' => $listOfTodoRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_list_of_todo_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $listOfTodo = new ListOfTodo();
        $form = $this->createForm(ListOfTodoType::class, $listOfTodo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $listOfTodo->setCreatedAt(new \DateTime())->setUpdatedAt(new \DateTime())->setStatus("on")->setState(false);
            $entityManager->persist($listOfTodo);
            $entityManager->flush();

            return $this->redirectToRoute('app_list_of_todo_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('list_of_todo/new.html.twig', [
            'list_of_todo' => $listOfTodo,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_list_of_todo_show', methods: ['GET'])]
    public function show(ListOfTodo $listOfTodo): Response
    {
        return $this->render('list_of_todo/show.html.twig', [
            'list_of_todo' => $listOfTodo,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_list_of_todo_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ListOfTodo $listOfTodo, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ListOfTodoType::class, $listOfTodo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_list_of_todo_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('list_of_todo/edit.html.twig', [
            'list_of_todo' => $listOfTodo,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_list_of_todo_delete', methods: ['POST'])]
    public function delete(Request $request, ListOfTodo $listOfTodo, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$listOfTodo->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($listOfTodo);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_list_of_todo_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/update/state/{id}', name: 'app_list_of_todo_update_state', methods: ['POST'])]
    public function updateTodoState(Request $request, EntityManagerInterface $entityManager, $id): Response
    {

        $todo = $entityManager->getRepository(ListOfTodo::class)->find($id);

        if (!$todo) {
            return new JsonResponse(['error' => 'Todo not found'], Response::HTTP_NOT_FOUND);
        }

        $isChecked = $request->request->get('is_checked');

        $todo->setState($isChecked);
        $entityManager->flush();

        return new JsonResponse(['success' => true]);
    }
}
