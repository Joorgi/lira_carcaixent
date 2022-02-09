<?php

namespace App\Controller;

use App\Entity\Noticia;
use App\Form\NoticiaType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

#[Route('/admin/noticia')]
class NoticiaController extends AbstractController
{

    #[Route('/new', name: 'noticia_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        $noticium = new Noticia();
        $form = $this->createForm(NoticiaType::class, $noticium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $brochureFile */
            $brochureFile = $form->get('imagen')->getData();

            // this condition is needed because the 'brochure' field is not required
            // so the PDF file must be processed only when a file is uploaded
            if ($brochureFile) {
                $originalFilename = pathinfo($brochureFile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $newFilename = uniqid() . '.' . $brochureFile->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $brochureFile->move(
                        $this->getParameter('noticias_files_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
                $noticium->setImagen($newFilename);
            }
            $entityManager->persist($noticium);
            $entityManager->flush();

            return $this->redirectToRoute('home', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('noticia/new.html.twig', [
            'noticium' => $noticium,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/edit', name: 'noticia_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Noticia $noticium, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(NoticiaType::class, $noticium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('noticia_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('noticia/edit.html.twig', [
            'noticium' => $noticium,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'noticia_delete', methods: ['POST'])]
    public function delete(Request $request, Noticia $noticium, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $noticium->getId(), $request->request->get('_token'))) {
            $entityManager->remove($noticium);
            $entityManager->flush();
        }

        return $this->redirectToRoute('noticia_index', [], Response::HTTP_SEE_OTHER);
    }
}
