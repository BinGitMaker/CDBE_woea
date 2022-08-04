<?php

namespace App\Controller\Admin;

use App\Entity\Massage;
use App\Entity\MassCategory;
use App\Form\MassageType;
use App\Repository\MassageRepository;
use App\Repository\MassCategoryRepository;
use App\Repository\PackRepository;
use App\Repository\PackCatSoloRepository;
use App\Repository\PackCatMultiRepository;

use App\Service\FileUploaderService;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('admin/massage', name:'admin_massage_')]
class MassageCrudController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager){
        $this->entityManager = $entityManager;
    }

    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(
        MassageRepository $massageRepository): Response
    {
        return $this->render('admin/massage/index.html.twig', [
            'massages' => $massageRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'new', methods: ['GET', 'POST'])]
    public function new(Request $request, MassageRepository $massageRepository, PackRepository $packRepository, PackCatSoloRepository $packCatSoloRepository, PackCatMultiRepository $packCatMultiRepository,FileUploaderService $fileUploader): Response
    {
        $massage = new Massage();
        $form = $this->createForm(MassageType::class, $massage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $illustration = $form->get('illustration')->getData();
            if($illustration){
                $illustrationName = $fileUploader->upload($illustration);
                $massage->setIllustration($illustrationName);
            }
            $massageRepository->add($massage, true);

            return $this->redirectToRoute('admin_massage_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/massage/new.html.twig', [
            'massage' => $massage,
            'packs' => $packRepository->findAll(),
            'packCatSolos' => $packCatSoloRepository->findAll(),
            'packCatMultis' => $packCatMultiRepository->findAll(),
            'form' => $form,
        ]);
    }

    #[Route('/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Massage $massage, MassageRepository $massageRepository, PackRepository $packRepository, PackCatSoloRepository $packCatSoloRepository, PackCatMultiRepository $packCatMultiRepository, FileUploaderService $fileUploader): Response
    {
        $form = $this->createForm(MassageType::class, $massage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $illustration = $form->get('illustration')->getData();
            if($illustration){
                $illustrationName = $fileUploader->upload($illustration);
                $massage->setIllustration($illustrationName);
            }
            $massageRepository->add($massage, true);

            return $this->redirectToRoute('admin_massage_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/massage/edit.html.twig', [
            'massage' => $massage,
            'packs' => $packRepository->findAll(),
            'packCatSolos' => $packCatSoloRepository->findAll(),
            'packCatMultis' => $packCatMultiRepository->findAll(),
            'form' => $form,
        ]);
    }

    #[Route('/{id}/delete', name: 'delete', methods: ['POST'])]
    public function delete(Request $request, Massage $massage, MassageRepository $massageRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$massage->getId(), $request->request->get('_token'))) {
            $massageRepository->remove($massage, true);
        }

        return $this->redirectToRoute('admin_massage_index', [], Response::HTTP_SEE_OTHER);
    }
}
