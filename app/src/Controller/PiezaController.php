<?php

namespace App\Controller;

use App\Entity\Pieza;
use App\Form\PiezaType;
use App\Repository\PiezaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/pieza')]
class PiezaController extends AbstractController
{
    #[Route('/', name: 'pieza_index', methods: ['GET'])]
    public function index(PiezaRepository $piezaRepository): Response
    {
        return $this->render('pieza/index.html.twig', [
            'piezas' => $piezaRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'pieza_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $pieza = new Pieza();
        $form = $this->createForm(PiezaType::class, $pieza);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($pieza);
            $entityManager->flush();

            return $this->redirectToRoute('pieza_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pieza/new.html.twig', [
            'pieza' => $pieza,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'pieza_show', methods: ['GET'])]
    public function show(Pieza $pieza): Response
    {
        return $this->render('pieza/show.html.twig', [
            'pieza' => $pieza,
        ]);
    }

    #[Route('/{id}/edit', name: 'pieza_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Pieza $pieza, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PiezaType::class, $pieza);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('pieza_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pieza/edit.html.twig', [
            'pieza' => $pieza,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'pieza_delete', methods: ['POST'])]
    public function delete(Request $request, Pieza $pieza, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$pieza->getId(), $request->request->get('_token'))) {
            $entityManager->remove($pieza);
            $entityManager->flush();
        }

        return $this->redirectToRoute('pieza_index', [], Response::HTTP_SEE_OTHER);
    }
}
