<?php

namespace App\Controller;

use App\Entity\Partitura;
use App\Form\PartituraType;
use App\Repository\PartituraRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/partitura')]
class PartituraController extends AbstractController
{
    #[Route('/', name: 'partitura_index', methods: ['GET'])]
    public function index(PartituraRepository $partituraRepository): Response
    {
        return $this->render('partitura/index.html.twig', [
            'partituras' => $partituraRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'partitura_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $partitura = new Partitura();
        $form = $this->createForm(PartituraType::class, $partitura);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($partitura);
            $entityManager->flush();

            return $this->redirectToRoute('partitura_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('partitura/new.html.twig', [
            'partitura' => $partitura,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'partitura_show', methods: ['GET'])]
    public function show(Partitura $partitura): Response
    {
        return $this->render('partitura/show.html.twig', [
            'partitura' => $partitura,
        ]);
    }

    #[Route('/{id}/edit', name: 'partitura_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Partitura $partitura, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PartituraType::class, $partitura);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('partitura_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('partitura/edit.html.twig', [
            'partitura' => $partitura,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'partitura_delete', methods: ['POST'])]
    public function delete(Request $request, Partitura $partitura, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$partitura->getId(), $request->request->get('_token'))) {
            $entityManager->remove($partitura);
            $entityManager->flush();
        }

        return $this->redirectToRoute('partitura_index', [], Response::HTTP_SEE_OTHER);
    }
}
