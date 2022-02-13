<?php

namespace App\Controller\Api;

use App\Repository\BandaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

#[Route('/api')]
class ApiNoticiaController extends AbstractController
{
  private $bandaRepository;

  public function __construct(BandaRepository $bandaRepository)
  {
    $this->bandaRepository = $bandaRepository;
  }
  #[Route('/bandas', name: 'api_banda_index', methods: ['GET'])]
  public function getAllBandas(): JsonResponse
  {
    $bandas = $this->bandaRepository->findAll();
    $data = [];

    foreach ($bandas as $banda) {
      $data[] = [
        'id' => $banda->getId(),
        'nombre' => $banda->getNombre(),
      ];
    }

    if (!$bandas) {
      throw new NotFoundHttpException('Not found results!');
    }
    return new JsonResponse($data, Response::HTTP_OK);
  }


  #[Route('/bandas/{id}', name: 'api_banda_show', methods: ['GET'])]
  public function getBandaById(int $id): JsonResponse
  {
    $banda = $this->bandaRepository->find($id);
    $data = [
      'id' => $banda->getId(),
      'nombre' => $banda->getNombre(),
    ];

    if (!$banda) {
      throw new NotFoundHttpException('Not found results!');
    }
    return new JsonResponse($data, Response::HTTP_OK);
  }
}
