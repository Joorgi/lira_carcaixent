<?php

namespace App\Controller\Api;

use App\Repository\MusicoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

#[Route('/api')]
class ApiSocioController extends AbstractController
{
  private $socioRepository;

  public function __construct(SocioRepository $socioRepository)
  {
    $this->socioRepository = $socioRepository;
  }
  #[Route('/socios', name: 'api_socio_index', methods: ['GET'])]
  public function getAllSocios(): JsonResponse
  {
    $socios = $this->socioRepository->findAll();
    $data = [];

    foreach ($socios as $socio) {
      $data[] = [
        'id' => $socio->getId(),
        'nombre' => $socio->getNombre(),
        'primer_apellido' => $socio->getPrimerApellido(),
        'segundo_apellido' => $socio->getSegundoApellido(),
        'DNI' => $socio->getDNI(),
        'fecha_alta' => $socio->getFechaAlta(),
        'fecha_baja' => $socio->getFechaBaja(),
        'tipo' => $socio->getTipo(),
      ];
    }

    if (!$socios) {
      throw new NotFoundHttpException('Not found results!');
    }
    return new JsonResponse($data, Response::HTTP_OK);
  }


  #[Route('/socios/{id}', name: 'api_socio_show', methods: ['GET'])]
  public function getSocioById(int $id): JsonResponse
  {
    $socio = $this->socioRepository->find($id);
    $data = [
        'id' => $socio->getId(),
        'nombre' => $socio->getNombre(),
        'primer_apellido' => $socio->getPrimerApellido(),
        'segundo_apellido' => $socio->getSegundoApellido(),
        'DNI' => $socio->getDNI(),
        'fecha_alta' => $socio->getFechaAlta(),
        'fecha_baja' => $socio->getFechaBaja(),
        'tipo' => $socio->getTipo(),
    ];

    if (!$socio) {
      throw new NotFoundHttpException('Not found results!');
    }
    return new JsonResponse($data, Response::HTTP_OK);
  }
}