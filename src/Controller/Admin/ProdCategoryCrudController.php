<?php

namespace App\Controller\Admin;

use App\Entity\ProdCategory;
use App\Form\ProdCategoryType;
use App\Repository\ProdCategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('admin/categorie-des-produits', name:'admin_prod_category_')]
class ProdCategoryCrudController extends AbstractController
{
    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(ProdCategoryRepository $prodCategoryRepository): Response
    {
        return $this->render('admin/prod_category/index.html.twig', [
            'prod_categories' => $prodCategoryRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'new', methods: ['GET', 'POST'])]
    public function new(Request $request, ProdCategoryRepository $prodCategoryRepository): Response
    {
        $prodCategory = new ProdCategory();
        $form = $this->createForm(ProdCategoryType::class, $prodCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $prodCategoryRepository->add($prodCategory, true);

            return $this->redirectToRoute('admin_prod_category_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/prod_category/new.html.twig', [
            'prod_category' => $prodCategory,
            'form' => $form,
        ]);
    }


    #[Route('/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ProdCategory $prodCategory, ProdCategoryRepository $prodCategoryRepository): Response
    {
        $form = $this->createForm(ProdCategoryType::class, $prodCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $prodCategoryRepository->add($prodCategory, true);

            return $this->redirectToRoute('admin_prod_category_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/prod_category/edit.html.twig', [
            'prod_category' => $prodCategory,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/delete', name: 'delete', methods: ['POST'])]
    public function delete(Request $request, ProdCategory $prodCategory, ProdCategoryRepository $prodCategoryRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$prodCategory->getId(), $request->request->get('_token'))) {
            $prodCategoryRepository->remove($prodCategory, true);
        }

        return $this->redirectToRoute('admin_prod_category_index', [], Response::HTTP_SEE_OTHER);
    }
}
