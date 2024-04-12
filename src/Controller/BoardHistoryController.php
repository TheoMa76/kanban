<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class BoardHistoryController extends AbstractController
{
    #[Route('/board/history', name: 'app_board_history')]
    public function index(): Response
    {
        return $this->render('board_history/index.html.twig', [
            'controller_name' => 'BoardHistoryController',
        ]);
    }
}
