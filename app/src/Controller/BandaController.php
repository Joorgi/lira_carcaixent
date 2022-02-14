<?php

namespace App\Controller;

use App\Entity\Banda;
use App\Form\BandaType;
use App\Repository\BandaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('admin/banda')]
class BandaController extends AbstractController
{
    #[Route('/all', name: 'banda_index', methods: ['GET'])]
    public function index(BandaRepository $bandaRepository): Response
    {
        return $this->render('banda/index.html.twig', [
            'bandas' => $bandaRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'banda_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $banda = new Banda();
        $form = $this->createForm(BandaType::class, $banda);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($banda);
            $entityManager->flush();

            return $this->redirectToRoute('banda_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('banda/new.html.twig', [
            'banda' => $banda,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'banda_show', methods: ['GET'])]
    public function show(Banda $banda): Response
    {
        return $this->render('banda/show.html.twig', [
            'banda' => $banda,
        ]);
    }

    #[Route('/{id}/edit', name: 'banda_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Banda $banda, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(BandaType::class, $banda);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('banda_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('banda/edit.html.twig', [
            'banda' => $banda,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'banda_delete', methods: ['POST'])]
    public function delete(Request $request, Banda $banda, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$banda->getId(), $request->request->get('_token'))) {
            $entityManager->remove($banda);
            $entityManager->flush();
        }

        return $this->redirectToRoute('banda_index', [], Response::HTTP_SEE_OTHER);
    }
}
