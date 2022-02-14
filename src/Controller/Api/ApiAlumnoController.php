<?php

namespace App\Controller\Api;

use App\Repository\AlumnoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

#[Route('/api')]
class ApiAlumnoController extends AbstractController
{
  private $alumnoRepository;

  public function __construct(AlumnoRepository $alumnoRepository)
  {
    $this->alumnoRepository = $alumnoRepository;
  }
  #[Route('/alumnos', name: 'api_alumno_index', methods: ['GET'])]
  public function getAllAlumnos(): JsonResponse
  {
    $alumnos = $this->alumnoRepository->findAll();
    $data = [];

    foreach ($alumnos as $alumno) {
      $data[] = [
        'id' => $alumno->getId(),
        'nombre' => $alumno->getNombre(),
        'primer_apellido' => $alumno->getPrimerApellido(),
        'segundo_apellido' => $alumno->getSegundoApellido(),        
        'fecha_alta' => $alumno->getFechaAlta(),
        'fecha_baja' => $alumno->getFechaBaja(),
        'id_socio' => $alumno->getIdSocio(),
      ];
    }

    if (!$alumnos) {
      throw new NotFoundHttpException('Not found results!');
    }
    return new JsonResponse($data, Response::HTTP_OK);
  }


  #[Route('/alumnos/{id}', name: 'api_alumno_show', methods: ['GET'])]
  public function getAlumnoById(int $id): JsonResponse
  {
    $alumno = $this->alumnoRepository->find($id);
    $data = [
        'id' => $alumno->getId(),
        'nombre' => $alumno->getNombre(),
        'primer_apellido' => $alumno->getPrimerApellido(),
        'segundo_apellido' => $alumno->getSegundoApellido(),
        'primer_apellido' => $alumno->getPrimerApellido(),
        'fecha_alta' => $alumno->getFechaAlta(),
        'fecha_baja' => $alumno->getFechaBaja(),
        'id_socio' => $alumno->getIdSocio(),
    ];

    if (!$alumno) {
      throw new NotFoundHttpException('Not found results!');
    }
    return new JsonResponse($data, Response::HTTP_OK);
  }
}