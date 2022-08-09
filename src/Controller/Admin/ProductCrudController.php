<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use App\Form\ProductType;
use App\Service\FileUploaderService;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('admin/produit', name:'admin_product_')]
class ProductCrudController extends AbstractController
{
    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(ProductRepository $productRepository): Response
    {
        return $this->render('admin/product/index.html.twig', [
            'products' => $productRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'new', methods: ['GET', 'POST'])]
    public function new(Request $request, ProductRepository $productRepository, FileUploaderService $fileUploader): Response
    {
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $illustration = $form->get('illustration')->getData();
            
            if($illustration == null){
                $product->setIllustration(null);
                
            }else{
                $illustrationName = $fileUploader->upload($illustration);
                $product->setIllustration($illustrationName);
            }

            $productRepository->add($product, true);

            return $this->redirectToRoute('admin_product_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/product/new.html.twig', [
            'product' => $product,
            'form' => $form,
        ]);
    }

   
    #[Route('/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Product $product, ProductRepository $productRepository, FileUploaderService $fileUploader): Response
    {
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $illustration = $form->get('illustration')->getData();

            if($illustration == null){
                $product->setIllustration(null);
                
            }else{
                $illustrationName = $fileUploader->upload($illustration);
                $product->setIllustration($illustrationName);
            }

            $productRepository->add($product, true);

            return $this->redirectToRoute('admin_product_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/product/edit.html.twig', [
            'product' => $product,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/delete', name: 'delete', methods: ['POST'])]
    public function delete(Request $request, Product $product, ProductRepository $productRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$product->getId(), $request->request->get('_token'))) {
            $productRepository->remove($product, true);
        }

        return $this->redirectToRoute('admin_product_index', [], Response::HTTP_SEE_OTHER);
    }
}
