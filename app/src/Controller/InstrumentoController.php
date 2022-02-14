<?php

namespace App\Controller;

use App\Entity\Instrumento;
use App\Form\InstrumentoType;
use App\Repository\InstrumentoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/instrumento')]
class InstrumentoController extends AbstractController
{
    #[Route('/all', name: 'instrumento_index', methods: ['GET'])]
    public function index(InstrumentoRepository $instrumentoRepository): Response
    {
        return $this->render('instrumento/index.html.twig', [
            'instrumentos' => $instrumentoRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'instrumento_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $instrumento = new Instrumento();
        $form = $this->createForm(InstrumentoType::class, $instrumento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($instrumento);
            $entityManager->flush();

            return $this->redirectToRoute('instrumento_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('instrumento/new.html.twig', [
            'instrumento' => $instrumento,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'instrumento_show', methods: ['GET'])]
    public function show(Instrumento $instrumento): Response
    {
        return $this->render('instrumento/show.html.twig', [
            'instrumento' => $instrumento,
        ]);
    }

    #[Route('/{id}/edit', name: 'instrumento_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Instrumento $instrumento, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(InstrumentoType::class, $instrumento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('instrumento_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('instrumento/edit.html.twig', [
            'instrumento' => $instrumento,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'instrumento_delete', methods: ['POST'])]
    public function delete(Request $request, Instrumento $instrumento, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$instrumento->getId(), $request->request->get('_token'))) {
            $entityManager->remove($instrumento);
            $entityManager->flush();
        }

        return $this->redirectToRoute('instrumento_index', [], Response::HTTP_SEE_OTHER);
    }
}
