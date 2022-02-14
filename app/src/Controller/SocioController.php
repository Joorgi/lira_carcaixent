<?php

namespace App\Controller;

use App\Entity\Socio;
use App\Form\SocioType;
use App\Repository\SocioRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/socio')]
class SocioController extends AbstractController
{
    #[Route('/all', name: 'socio_index', methods: ['GET'])]
    public function index(SocioRepository $socioRepository): Response
    {
        return $this->render('socio/index.html.twig', [
            'socios' => $socioRepository->findAll(),
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
        if ($this->isCsrfTokenValid('delete'.$socio->getId(), $request->request->get('_token'))) {
            $entityManager->remove($socio);
            $entityManager->flush();
        }

        return $this->redirectToRoute('socio_index', [], Response::HTTP_SEE_OTHER);
    }
}
