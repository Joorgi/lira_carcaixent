<?php

namespace App\Controller\Api;

use App\Entity\Noticia;
use App\Repository\NoticiaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

#[Route('/api')]
class ApiNoticiaController extends AbstractController
{
  private $noticiaRepository;

  public function __construct(NoticiaRepository $noticiaRepository)
  {
    $this->noticiaRepository = $noticiaRepository;
  }
  #[Route('/noticias', name: 'api_noticia_index', methods: ['GET'])]
  public function getAllNews(): JsonResponse
  {
    $noticias = $this->noticiaRepository->findAll();
    $data = [];

    foreach ($noticias as $noticia) {
      $data[] = [
        'titulo' => $noticia->getTitulo(),
        'fecha' => date_format($noticia->getFecha(), 'd/m/Y'),
        'descripcion' => $noticia->getDescripcion(),
        'imagen' => $noticia->getImagen()
      ];
    }

    if (!$noticias) {
      throw new NotFoundHttpException('Not found results!');
    }
    return new JsonResponse($data, Response::HTTP_OK);
  }


  #[Route('/noticias/{id}', name: 'api_noticia_show', methods: ['GET'])]
  public function getNewById(int $id): JsonResponse
  {
    $noticia = $this->noticiaRepository->find($id);
    $data = [
      'titulo' => $noticia->getTitulo(),
      'fecha' => date_format($noticia->getFecha(), 'd/m/Y'),
      'descripcion' => $noticia->getDescripcion(),
      'imagen' => $noticia->getImagen()
    ];

    if (!$noticia) {
      throw new NotFoundHttpException('Not found results!');
    }
    return new JsonResponse($data, Response::HTTP_OK);
  }
}
