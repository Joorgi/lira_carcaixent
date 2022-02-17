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
class ApiMusicoController extends AbstractController
{
  private $musicoRepository;

  public function __construct(MusicoRepository $musicoRepository)
  {
    $this->musicoRepository = $musicoRepository;
  }
  #[Route('/musicos', name: 'api_musico_index', methods: ['GET'])]
  public function getAllMusicos(): JsonResponse
  {
    $musicos = $this->musicoRepository->findAll();
    $data = [];

    foreach ($musicos as $musico) {
      $data[] = [
        'id' => $musico->getId(),
        'id_alumno' => $musico->getIdAlumno()->getNombre(),
        'id_socio' => $musico->getIdSocio()->getNombre(),
        'nombre' => $musico->getNombre(),
        'primer_apellido' => $musico->getPrimerApellido(),
        'segundo_apellido' => $musico->getSegundoApellido(),
        'DNI' => $musico->getDNI(),
        'id_instrumento' => $musico->getIdInstrumento(),
        'id_banda' => $musico->getIdBanda(),
      ];
    }

    if (!$musicos) {
      throw new NotFoundHttpException('Not found results!');
    }
    return new JsonResponse($data, Response::HTTP_OK);
  }


  #[Route('/musicos/{id}', name: 'api_musico_show', methods: ['GET'])]
  public function getMusicoById(int $id): JsonResponse
  {
    $musico = $this->musicoRepository->find($id);
    $data = [
      'id' => $musico->getId(),
      'id_alumno' => $musico->getIdAlumno(),
      'id_socio' => $musico->getIdSocio(),
      'nombre' => $musico->getNombre(),
      'primer_apellido' => $musico->getPrimerApellido(),
      'segundo_apellido' => $musico->getSegundoApellido(),
      'DNI' => $musico->getDNI(),
      'id_instrumento' => $musico->getIdInstrumento(),
      'id_banda' => $musico->getIdBanda(),
    ];

    if (!$musico) {
      throw new NotFoundHttpException('Not found results!');
    }
    return new JsonResponse($data, Response::HTTP_OK);
  }
}
