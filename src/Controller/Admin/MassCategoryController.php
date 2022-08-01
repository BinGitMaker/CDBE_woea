<?php

namespace App\Controller\Admin;

use App\Entity\MassCategory;
use App\Form\MassCategoryType;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\MassCategoryRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('admin/categories-des-massages', name:'admin_mass_category_')]
class MassCategoryController extends AbstractController
{
    
    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(MassCategoryRepository $massCategoryRepository): Response
    {
        return $this->render('admin/mass_category/index.html.twig', [
            'mass_categories' => $massCategoryRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'new', methods: ['GET', 'POST'])]
    public function new(Request $request, MassCategoryRepository $massCategoryRepository): Response
    {
        $massCategory = new MassCategory();
        $form = $this->createForm(MassCategoryType::class, $massCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $massCategoryRepository->add($massCategory, true);

            return $this->redirectToRoute('admin_mass_category_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/mass_category/new.html.twig', [
            'mass_category' => $massCategory,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, MassCategory $massCategory, MassCategoryRepository $massCategoryRepository): Response
    {
        $form = $this->createForm(MassCategoryType::class, $massCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $massCategoryRepository->add($massCategory, true);

            return $this->redirectToRoute('admin_mass_category_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/mass_category/edit.html.twig', [
            'mass_category' => $massCategory,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/delete', name: 'delete', methods: ['POST'])]
    public function delete(Request $request, MassCategory $massCategory, MassCategoryRepository $massCategoryRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$massCategory->getId(), $request->request->get('_token'))) {
            $massCategoryRepository->remove($massCategory, true);
        }

        return $this->redirectToRoute('admin_mass_category_index', [], Response::HTTP_SEE_OTHER);
    }
}
