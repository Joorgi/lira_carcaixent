<?php

namespace App\Controller\Api;

use App\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\User\UserInterface;

#[Route('/api/')]
class ApiLoginController extends AbstractController
{
  #[Route('login', name: 'api_login')]
  public function index(?UserInterface $user): JsonResponse
  {

    if (null === $user) {
      return $this->json([
        'message' => 'missing credentials',
      ], Response::HTTP_UNAUTHORIZED);
    }


    return $this->json([
      'user'  => $user->getUserIdentifier(),
      'roleUser' => $user->getRoles(),
      'message' => "Login successful"
    ]);
  }
}
