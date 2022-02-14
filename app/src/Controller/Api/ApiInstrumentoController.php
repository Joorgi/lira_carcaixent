<?php

namespace App\Controller\Api;

use App\Repository\InstrumentoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

#[Route('/api')]
class ApiInstrumentoController extends AbstractController
{
  private $instrumentoRepository;

  public function __construct(InstrumentoRepository $instrumentoRepository)
  {
    $this->instrumentoRepository = $instrumentoRepository;
  }
  #[Route('/instrumentos', name: 'api_instrumento_index', methods: ['GET'])]
  public function getAllInstrumentos(): JsonResponse
  {
    $instrumentos = $this->instrumentoRepository->findAll();
    $data = [];

    foreach ($instrumentos as $instrumento) {
      $data[] = [
        'id' => $instrumento->getId(),
        'nombre' => $instrumento->getNombre(),
      ];
    }

    if (!$instrumentos) {
      throw new NotFoundHttpException('Not found results!');
    }
    return new JsonResponse($data, Response::HTTP_OK);
  }


  #[Route('/instrumentos/{id}', name: 'api_instrumento_show', methods: ['GET'])]
  public function getInstrumentoById(int $id): JsonResponse
  {
    $instrumento = $this->instrumentoRepository->find($id);
    $data = [
      'id' => $instrumento->getId(),
      'nombre' => $instrumento->getNombre(),
    ];

    if (!$instrumento) {
      throw new NotFoundHttpException('Not found results!');
    }
    return new JsonResponse($data, Response::HTTP_OK);
  }
}
