<?php

namespace App\Controller\Admin;

use App\Entity\Logo;
use App\Form\LogoType;
use App\Repository\LogoRepository;
use App\Service\FileUploaderService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/admin/logo', name: 'admin_logo_')]
class LogoController extends AbstractController
{
    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(LogoRepository $logoRepository): Response
    {
        return $this->render('admin/logo/index.html.twig', [
            'logos' => $logoRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'new', methods: ['GET', 'POST'])]
    public function new(Request $request, LogoRepository $logoRepository,  FileUploaderService $fileUploader): Response
    {
        $logo = new Logo();
        $form = $this->createForm(LogoType::class, $logo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $logoPro = $form->get('logoPro')->getData();
            $logoProInversed = $form->get('logoProInversed')->getData();
            if($logoPro && $logoProInversed){
                
                $logoProName = $fileUploader->upload($logoPro);
                $logoProInversedName = $fileUploader->upload($logoProInversed);
                $logo   ->setLogoPro($logoProName)
                        ->setLogoProInversed($logoProInversedName);
            }
            $logoRepository->add($logo, true);

            return $this->redirectToRoute('admin_logo_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/logo/new.html.twig', [
            'logo' => $logo,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Logo $logo, LogoRepository $logoRepository, FileUploaderService $fileUploader): Response
    {
        $form = $this->createForm(LogoType::class, $logo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $logoPro = $form->get('logoPro')->getData();
            $logoProInversed = $form->get('logoProInversed')->getData();
            if($logoPro && $logoProInversed){
                
                $logoProName = $fileUploader->upload($logoPro);
                $logoProInversedName = $fileUploader->upload($logoProInversed);
                $logo   ->setLogoPro($logoProName)
                        ->setLogoProInversed($logoProInversedName);
            }
            $logoRepository->add($logo, true);

            return $this->redirectToRoute('admin_logo_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/logo/edit.html.twig', [
            'logo' => $logo,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/delete', name: 'delete', methods: ['POST'])]
    public function delete(Request $request, Logo $logo, LogoRepository $logoRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$logo->getId(), $request->request->get('_token'))) {
            $logoRepository->remove($logo, true);
        }

        return $this->redirectToRoute('admin_logo_index', [], Response::HTTP_SEE_OTHER);
    }
}
