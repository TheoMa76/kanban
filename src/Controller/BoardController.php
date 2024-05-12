<?php

namespace App\Controller;

use App\Entity\Board;
use App\Entity\ListOfTodo;
use App\Entity\Step;
use App\Entity\Task;
use App\Form\BoardType;
use App\Repository\BoardRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/board')]
class BoardController extends AbstractController
{
    #[Route('/', name: 'app_board_index', methods: ['GET'])]
    public function index(BoardRepository $boardRepository): Response
    {
        return $this->render('board/index.html.twig', [
            'boards' => $boardRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_board_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $board = new Board();
        $form = $this->createForm(BoardType::class, $board);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $board->setCreatedAt(new \DateTime())->setUpdatedAt(new \DateTime())->setStatus("on");
            
            $entityManager->persist($board);
            $entityManager->flush();

            return $this->redirectToRoute('app_board_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('board/new.html.twig', [
            'board' => $board,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_board_show', methods: ['GET'])]
    public function show(Board $board): Response
    {
        $steps = $board->getSteps();
        $steps = $steps->toArray(); // Convertir la collection en tableau


        usort($steps, function($a, $b) {
            return $a->getPosition() - $b->getPosition();
        });

        return $this->render('board/show.html.twig', [
            'board' => $board,
            'steps' => $steps,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_board_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Board $board, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(BoardType::class, $board);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_board_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('board/edit.html.twig', [
            'board' => $board,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_board_delete', methods: ['POST'])]
    public function delete(Request $request, Board $board, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$board->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($board);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_board_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/{id}/update-title', name: 'app_board_update_title', methods: ['POST'])]
    public function updateTitle(Request $request, Board $board, EntityManagerInterface $entityManager): Response
    {
        $newTitle = $request->request->get('title');

        if ($newTitle !== null && !empty($newTitle)) {
            $board->setTitle($newTitle);
            $entityManager->flush();

            return $this->json(['title' => $board->getTitle()]);
        }

        return $this->json(['error' => 'Erreur lors de la mise à jour du titre'], Response::HTTP_BAD_REQUEST);
    }

    #[Route('/ajouter/ajouterunelist', name: 'app_board_ajouterunelist', methods: ['POST'])]
    public function ajouterunelist(Request $request, EntityManagerInterface $entityManager): Response
    {   
        $requestData = $request->getContent();

        parse_str($requestData, $requestDataArray);

        $taskId = $requestDataArray['task_id'];
        $title = $requestDataArray['title'];
        $description = $requestDataArray['description'];

        // Utiliser les données récupérées
        $task = $entityManager->getRepository(Task::class)->find($taskId);
        $lists = $task->getListOfTodos();

        $listsLength = count($lists) + 1;

        $list = new ListOfTodo();
        $list->setTitle($title);
        $list->setDescription($description);
        $list->setState(0);
        $list->setTasks($task);
        $list->setCreatedAt(new \DateTime())->setUpdatedAt(new \DateTime())->setStatus("on");


        $entityManager->persist($list);
        $entityManager->flush();

        return $this->json(['list-title' => $list->getTitle(),
                            'list-description' => $list->getDescription(),
                            'list-id' => $list->getId(),
                            'list-task' => $list->getTasks()->getId()]);
    }

    #[Route('/ajouter/ajouterunetache', name: 'app_board_ajouterunetache', methods: ['POST'])]
    public function ajouterunetache(Request $request, EntityManagerInterface $entityManager): Response
    {   
        $requestData = $request->getContent();

        parse_str($requestData, $requestDataArray);

        $stepId = $requestDataArray['step_id'];
        $title = $requestDataArray['title'];
        $description = $requestDataArray['description'];

        // Utiliser les données récupérées
        $step = $entityManager->getRepository(Step::class)->find($stepId);
        $tasks = $step->getTasks();

        $taskslength = count($tasks) + 1;

        $task = new Task();
        $task->setTitle($title);
        $task->setDescription($description);
        $task->setPriority($taskslength);
        $task->setStep($step);
        $task->setCreatedAt(new \DateTime())->setUpdatedAt(new \DateTime())->setStatus("on");


        $entityManager->persist($task);
        $entityManager->flush();

        return $this->json(['task-title' => $task->getTitle(),
                            'task-description' => $task->getDescription(),
                            'task-id' => $task->getId(),
                            'task-step' => $task->getStep()->getId()]);
    }

    #[Route('/ajouter/ajouterunestep', name: 'app_board_ajouterunestep', methods: ['POST'])]
    public function ajouterunestep(Request $request, EntityManagerInterface $entityManager): Response
    {   
        $requestData = $request->getContent();
        parse_str($requestData, $requestDataArray);

        $boardId = $requestDataArray['board_id'];
        $title = $requestDataArray['title'];

        $steps = $entityManager->getRepository(Step::class)->findBy(['board' => $boardId]);
        $board = $entityManager->getRepository(Board::class)->find($boardId);

        $position = count($steps) + 1;

        $step = new Step();
        $step->setTitle($title);
        $step->setBoard($board);
        $step->setPosition($position);

        $step->setCreatedAt(new \DateTime())->setUpdatedAt(new \DateTime())->setStatus("on");

        $entityManager->persist($step);
        $entityManager->flush();

        return $this->json(['step-title' => $step->getTitle(),
                            'step-position' => $step->getPosition()]);
    }

    #[Route('/move/movetask', name: 'app_board_movetask', methods: ['POST'])]
    public function movetask(Request $request, EntityManagerInterface $entityManager): Response
    {   
        $requestData = $request->getContent();
        parse_str($requestData, $requestDataArray);

        $stepId = $requestDataArray['step'];
        $taskId = $requestDataArray['movetask_id'];

        $task = $entityManager->getRepository(Task::class)->find($taskId);
        $step = $entityManager->getRepository(Step::class)->find($stepId);
        $task->setStep($step);

        $step->setUpdatedAt(new \DateTime());

        $entityManager->persist($task);
        $entityManager->flush();

        return $this->json(['task-step' => $task->getStep()->getId()]);
    }

}
