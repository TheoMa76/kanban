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
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return $this->render('identity/index.html.twig', [
            'controller_name' => 'IdentityController',
        ]);
    }

    #[Route('/create', name: 'identity_create')]
    public function create(Request $request, EntityManagerInterface $entityManager): Response{
        $identity = new Identity();
        $form = $this->createForm(IdentityType::class, $identity);
        $form->handleRequest($request);
        $today = new \DateTime();
        if( $form->isSubmitted() && $form->isValid()){
            $identity = $form->getData();

            $identity->setStatus("on")->setCreatedAt($today)
                ->setUpdatedAt($today);

            $entityManager->persist($identity);
            $entityManager->flush();
            return $this->redirectToRoute('identity_find', ['id' => $identity->getId()],Response::HTTP_CREATED);
        }

        return $this->render('form/form.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    
    #[Route('/find/{id}', name: 'identity_find')]
    public function find(int $id, IdentityRepository $identityRepository): Response{
        return $this->render('identity/find.html.twig', [
            'identity' => $identityRepository->find($id),
        ]);
    }
}
