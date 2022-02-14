<?php

namespace App\Controller;

use App\Entity\Autor;
use App\Form\AutorType;
use App\Repository\AutorRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('admin/autor')]
class AutorController extends AbstractController
{
    #[Route('/all', name: 'autor_index', methods: ['GET'])]
    public function index(AutorRepository $autorRepository): Response
    {
        return $this->render('autor/index.html.twig', [
            'autors' => $autorRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'autor_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $autor = new Autor();
        $form = $this->createForm(AutorType::class, $autor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($autor);
            $entityManager->flush();

            return $this->redirectToRoute('autor_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('autor/new.html.twig', [
            'autor' => $autor,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'autor_show', methods: ['GET'])]
    public function show(Autor $autor): Response
    {
        return $this->render('autor/show.html.twig', [
            'autor' => $autor,
        ]);
    }

    #[Route('/{id}/edit', name: 'autor_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Autor $autor, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AutorType::class, $autor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('autor_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('autor/edit.html.twig', [
            'autor' => $autor,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'autor_delete', methods: ['POST'])]
    public function delete(Request $request, Autor $autor, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$autor->getId(), $request->request->get('_token'))) {
            $entityManager->remove($autor);
            $entityManager->flush();
        }

        return $this->redirectToRoute('autor_index', [], Response::HTTP_SEE_OTHER);
    }
}
