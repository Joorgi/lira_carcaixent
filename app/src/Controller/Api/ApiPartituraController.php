<?php

namespace App\Controller\Api;

use App\Repository\PartituraRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

#[Route('/api')]
class ApiPartituraController extends AbstractController
{
  private $partituraRepository;

  public function __construct(PartituraRepository $partituraRepository)
  {
    $this->partituraRepository = $partituraRepository;
  }
  #[Route('/partituras', name: 'api_partitura_index', methods: ['GET'])]
  public function getAllPartituras(): JsonResponse
  {
    $partituras = $this->partituraRepository->findAll();
    $data = [];

    foreach ($partituras as $partitura) {
      $data[] = [
        'id' => $partitura->getId(),
        'id_pieza' => $partitura->getNombre(),
        'id_instrumento' => $partitura->getPrimerApellido(),
        'rol_fichero' => $partitura->getSegundoApellido(),
        'fichero' => $partitura->getFechaAlta(),
      ];
    }

    if (!$partituras) {
      throw new NotFoundHttpException('Not found results!');
    }
    return new JsonResponse($data, Response::HTTP_OK);
  }

  #[Route('/partituras/{id}', name: 'api_partitura_show', methods: ['GET'])]
  public function getPartituraById(int $id): JsonResponse
  {
    $partitura = $this->partituraRepository->find($id);
    $data = [
      'id' => $partitura->getId(),
      'id_pieza' => $partitura->getIdPieza()->getNombre(), 
      'id_instrumento' => $partitura->getIdInstrumento()->getNombre(),
      'rol_fichero' => $partitura->getRolInstrumento(),
      'fichero' => $partitura->getFichero(),
    ];

    if (!$partitura) {
      throw new NotFoundHttpException('Not found results!');
    }
    return new JsonResponse($data, Response::HTTP_OK);
  }
}
