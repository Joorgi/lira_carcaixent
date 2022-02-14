<?php

namespace App\Controller;

use App\Entity\Musico;
use App\Form\MusicoType;
use App\Repository\MusicoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/musico')]
class MusicoController extends AbstractController
{
    #[Route('/', name: 'musico_index', methods: ['GET'])]
    public function index(MusicoRepository $musicoRepository): Response
    {
        return $this->render('musico/index.html.twig', [
            'musicos' => $musicoRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'musico_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $musico = new Musico();
        $form = $this->createForm(MusicoType::class, $musico);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($musico);
            $entityManager->flush();

            return $this->redirectToRoute('musico_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('musico/new.html.twig', [
            'musico' => $musico,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'musico_show', methods: ['GET'])]
    public function show(Musico $musico): Response
    {
        return $this->render('musico/show.html.twig', [
            'musico' => $musico,
        ]);
    }

    #[Route('/{id}/edit', name: 'musico_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Musico $musico, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(MusicoType::class, $musico);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('musico_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('musico/edit.html.twig', [
            'musico' => $musico,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'musico_delete', methods: ['POST'])]
    public function delete(Request $request, Musico $musico, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$musico->getId(), $request->request->get('_token'))) {
            $entityManager->remove($musico);
            $entityManager->flush();
        }

        return $this->redirectToRoute('musico_index', [], Response::HTTP_SEE_OTHER);
    }
}
