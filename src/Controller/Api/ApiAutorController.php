<?php

namespace App\Controller\Api;

use App\Repository\AutorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

#[Route('/api')]
class ApiAutorController extends AbstractController
{
  private $autorRepository;

  public function __construct(AutorRepository $autorRepository)
  {
    $this->autorRepository = $autorRepository;
  }
  #[Route('/autores', name: 'api_autor_index', methods: ['GET'])]
  public function getAllAutores(): JsonResponse
  {
    $autores = $this->autorRepository->findAll();
    $data = [];

    foreach ($autores as $autor) {
      $data[] = [
        'id' => $autor->getId(),
        'nombre' => $autor->getNombre(),
      ];
    }

    if (!$autores) {
      throw new NotFoundHttpException('Not found results!');
    }
    return new JsonResponse($data, Response::HTTP_OK);
  }


  #[Route('/autores/{id}', name: 'api_autor_show', methods: ['GET'])]
  public function getAutorById(int $id): JsonResponse
  {
    $autor = $this->autorRepository->find($id);
    $data = [
        'id' => $autor->getId(),
        'nombre' => $autor->getNombre(),
    ];

    if (!$autor) {
      throw new NotFoundHttpException('Not found results!');
    }
    return new JsonResponse($data, Response::HTTP_OK);
  }
}