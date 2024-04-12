<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class StepController extends AbstractController
{
    #[Route('/step', name: 'app_step')]
    public function index(): Response
    {
        return $this->render('step/index.html.twig', [
            'controller_name' => 'StepController',
        ]);
    }
}
