<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeBoardController extends AbstractController
{
    #[Route('/home/board', name: 'app_home_board')]
    public function index(): Response
    {
        
        $user = $this->getUser();
        $teams = $user->getTeams();
        $boards = $user->getBoards();

        return $this->render('home_board/index.html.twig', [
            'controller_name' => 'HomeBoardController',
            'user' => $user,
            'teams' => $teams,
            'boards' => $boards,
        ]);
    }
}
