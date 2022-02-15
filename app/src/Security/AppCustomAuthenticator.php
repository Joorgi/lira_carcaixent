<?php

namespace App\Security;

use App\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

// #[Route('/api/')]
// class ApiLoginController extends AbstractController
// {
//     #[Route('login', name: 'api_login')]
//     public function index(#[CurrentUser] ?User $user): Response
//     {
//         if (null === $user) {
//             return $this->json([
//                 'message' => 'missing credentials',
//             ], Response::HTTP_UNAUTHORIZED);
//         }


//         return $this->json([
//             'user'  => $user->getUserIdentifier(),
//             'roleUser' => $user->getRoles(),
//             'message' => "Login successful"
//         ]);
//     }
// }
