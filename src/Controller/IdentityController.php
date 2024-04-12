<?php

namespace App\Controller;

use App\Entity\Identity;
use App\Form\IdentityType;
use App\Repository\IdentityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/identity')]
class IdentityController extends AbstractController
{
    #[Route('/', name: 'app_identity_index', methods: ['GET'])]
    public function index(IdentityRepository $identityRepository): Response
    {
        return $this->render('identity/index.html.twig', [
            'identities' => $identityRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_identity_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $identity = new Identity();
        $form = $this->createForm(IdentityType::class, $identity);
        $form->handleRequest($request);
        $today = new \DateTime();

        if ($form->isSubmitted() && $form->isValid()) {
            $identity = $form->getData();
            $identity->setStatus("on")->setCreatedAt($today)
                ->setUpdatedAt($today);
            $entityManager->persist($identity);
            $entityManager->flush();

            return $this->redirectToRoute('app_identity_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('identity/new.html.twig', [
            'identity' => $identity,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_identity_show', methods: ['GET'])]
    public function show(Identity $identity): Response
    {
        return $this->render('identity/show.html.twig', [
            'identity' => $identity,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_identity_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Identity $identity, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(IdentityType::class, $identity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_identity_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('identity/edit.html.twig', [
            'identity' => $identity,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_identity_delete', methods: ['POST'])]
    public function delete(Request $request, Identity $identity, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$identity->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($identity);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_identity_index', [], Response::HTTP_SEE_OTHER);
    }
}
