<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'home')]
    public function index(?UserInterface $user): Response
    {
        return $this->render('main.html.twig', [
            'controller_name' => 'HomeController',
            'userName' => $user->getIdMusico()?->getNombre()
        ]);
    }
}
