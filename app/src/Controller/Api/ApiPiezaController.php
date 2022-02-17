<?php

namespace App\Controller\Api;

use App\Repository\PiezaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

#[Route('/api')]
class ApiPiezaController extends AbstractController
{
  private $piezaRepository;

  public function __construct(PiezaRepository $piezaRepository)
  {
    $this->piezaRepository = $piezaRepository;
  }
  #[Route('/piezas', name: 'api_pieza_index', methods: ['GET'])]
  public function getAllPiezas(): JsonResponse
  {
    $piezas = $this->piezaRepository->findAll();
    $data = [];

    foreach ($piezas as $pieza) {
      $data[] = [
        'id' => $pieza->getId(),
        'nombre' => $pieza->getNombre(),
        'id_autor' => $pieza->getIdAutor(),
        'id_evento' => $pieza->getIdEvento(),
      ];
    }

    if (!$piezas) {
      throw new NotFoundHttpException('Not found results!');
    }
    return new JsonResponse($data, Response::HTTP_OK);
  }

  #[Route('/piezas/{id}', name: 'api_pieza_show', methods: ['GET'])]
  public function getPiezaById(int $id): JsonResponse
  {
    $pieza = $this->piezaRepository->find($id);
    $data = [
      'id' => $pieza->getId(),
      'nombre' => $pieza->getNombre(),
      'id_autor' => $pieza->getIdAutor()->getNombre(),
      'id_evento' => $pieza->getIdEvento()->getNombre(),
    ];

    if (!$pieza) {
      throw new NotFoundHttpException('Not found results!');
    }
    return new JsonResponse($data, Response::HTTP_OK);
  }
}