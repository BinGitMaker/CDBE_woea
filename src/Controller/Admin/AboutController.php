<?php

namespace App\Controller\Admin;

use App\Entity\About;
use App\Form\AboutType;
use App\Repository\AboutRepository;
use App\Service\FileUploaderService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/admin/about', name: 'admin_about_')]
class AboutController extends AbstractController
{
    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(AboutRepository $aboutRepository): Response
    {
        return $this->render('admin/about/index.html.twig', [
            'abouts' => $aboutRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'new', methods: ['GET', 'POST'])]
    public function new(Request $request, AboutRepository $aboutRepository, FileUploaderService $fileUploader): Response
    {
        $about = new About();
        $form = $this->createForm(AboutType::class, $about);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
           
            $illustration = $form->get('illustration')->getData();

            if($illustration == null){
                $about->setIllustration(null);
                
            }else{
                $illustrationName = $fileUploader->upload($illustration);
                $about->setIllustration($illustrationName);
            }

            $aboutRepository->add($about, true);
            
            return $this->redirectToRoute('admin_about_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/about/new.html.twig', [
            'about' => $about,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, About $about, AboutRepository $aboutRepository, FileUploaderService $fileUploader): Response
    {
        $form = $this->createForm(AboutType::class, $about);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $illustration = $form->get('illustration')->getData();

            if($illustration == null){
                $about->setIllustration(null);

            }else{
                $illustrationName = $fileUploader->upload($illustration);
                $about->setIllustration($illustrationName);
            }
            
            $aboutRepository->add($about, true);

            return $this->redirectToRoute('admin_about_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/about/edit.html.twig', [
            'about' => $about,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'delete', methods: ['POST'])]
    public function delete(Request $request, About $about, AboutRepository $aboutRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$about->getId(), $request->request->get('_token'))) {
            $aboutRepository->remove($about, true);
        }

        return $this->redirectToRoute('admin_about_index', [], Response::HTTP_SEE_OTHER);
    }
}
