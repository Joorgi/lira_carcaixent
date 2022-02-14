<?php

namespace App\Controller;

use App\Entity\Socio;
use App\Form\SocioType;
use App\Repository\SocioRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/admin/socio')]
class SocioController extends AbstractController
{
    #[Route('/all', name: 'socio_index', methods: ['GET'])]
    public function index(SocioRepository $socioRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $query = $socioRepository->findAll();
        $pagination = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            16 /*limit per page*/
        );

        // parameters to template
        return $this->render('socio/index.html.twig', [
            'pagination' => $pagination

        ]);
    }

    #[Route('/new', name: 'socio_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $socio = new Socio();
        $form = $this->createForm(SocioType::class, $socio);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($socio);
            $entityManager->flush();

            return $this->redirectToRoute('socio_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('socio/new.html.twig', [
            'socio' => $socio,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'socio_show', methods: ['GET'])]
    public function show(Socio $socio): Response
    {
        return $this->render('socio/show.html.twig', [
            'socio' => $socio,
        ]);
    }

    #[Route('/{id}/edit', name: 'socio_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Socio $socio, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SocioType::class, $socio);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('socio_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('socio/edit.html.twig', [
            'socio' => $socio,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'socio_delete', methods: ['POST'])]
    public function delete(Request $request, Socio $socio, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $socio->getId(), $request->request->get('_token'))) {
            $entityManager->remove($socio);
            $entityManager->flush();
        }

        return $this->redirectToRoute('socio_index', [], Response::HTTP_SEE_OTHER);
    }

    public function paginaActual()
    {
        $ruta = $_SERVER["REQUEST_URI"];
        $rutaNueva = explode("/", $ruta);
        $cuenta = count($rutaNueva);
        $paginaActual = $rutaNueva[$cuenta - 1];

        if (is_numeric($paginaActual) && !empty($paginaActual) && $paginaActual >= 1) {
            $_SESSION['paginaAct'] = $paginaActual;
            return $paginaActual;
        } elseif (isset($_SESSION['paginaAct'])) {
            return $_SESSION['paginaAct'];
        } else {
            return 1;
        }
    }
}
