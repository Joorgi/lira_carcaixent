<?php

namespace App\Controller\Api;

use App\Repository\EventoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

#[Route('/api')]
class ApiEventoController extends AbstractController
{
  private $eventoRepository;

  public function __construct(EventoRepository $eventoRepository)
  {
    $this->eventoRepository = $eventoRepository;
  }
  #[Route('/eventos', name: 'api_evento_index', methods: ['GET'])]
  public function getAllEventos(): JsonResponse
  {
    $eventos = $this->eventoRepository->findAll();
    $data = [];

    foreach ($eventos as $evento) {
      $data[] = [
        'id' => $evento->getId(),
        'nombre' => $evento->getNombre(),
        'fecha' => $evento->getFecha(),
        'lugar' => $evento->getLugar(),        
        'banda' => $evento->getBanda(),
        'id_pieza' => $evento->getIdPieza(),
      ];
    }

    if (!$eventos) {
      throw new NotFoundHttpException('Not found results!');
    }
    return new JsonResponse($data, Response::HTTP_OK);
  }


  #[Route('/eventos/{id}', name: 'api_evento_show', methods: ['GET'])]
  public function getEventoById(int $id): JsonResponse
  {
    $evento = $this->eventoRepository->find($id);
    $data = [
      'id' => $evento->getId(),
      'nombre' => $evento->getNombre(),
      'fecha' => $evento->getFecha(),
      'lugar' => $evento->getLugar(),        
      'banda' => $evento->getBanda(),
      'id_pieza' => $evento->getIdPieza(),
    ];

    if (!$evento) {
      throw new NotFoundHttpException('Not found results!');
    }
    return new JsonResponse($data, Response::HTTP_OK);
  }
}