<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\ProdCategory;

use App\Repository\LogoRepository;
use App\Repository\ProductRepository;

use App\Repository\ContactMeRepository;

use Doctrine\ORM\EntityManagerInterface;
use App\Repository\ProdCategoryRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

#[Route('/e-commerce')]
class ProductController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager){
        $this->entityManager = $entityManager;
    }

    #[Route('/', name: 'category')]
    public function index(LogoRepository $logos): Response
    {
        $prodCategories = $this->entityManager
            ->getRepository(ProdCategory::class)
            ->findAll();
            
        return $this->render('product/index.html.twig', [
            'prodCategories' => $prodCategories,
            'logos' => $logos->findAll(),
        ]);
    }

    #[Route('/{slug}', name: 'product_by_category')]
    public function indexByCategory(ProdCategory $prodCategory, 
                                    ProdCategoryRepository $prodCategories,
                                    ContactMeRepository $contactMes,
                                    LogoRepository $logos
                                ): Response
    {   
        if (!$prodCategory){
            return $this->redirectToRoute('category');
        }

        $products = $this->entityManager
            ->getRepository( Product::class)
            ->findByProdCategory($prodCategory);

        return $this->render('product/index_by_category.html.twig', [
            'prodCategories' => $prodCategories->findAll(),
            'prodCategory' => $prodCategory,
            'products' => $products,
            'contactMes' => $contactMes->findAll(),
            'logos' => $logos->findAll(),
        ]);
    }

    #[Route('/{slug}/{name_product}', name: 'product')]
    #[ParamConverter('product',options:['mapping'=>['name_product'=>'name']])]
    public function show(   
                            ProdCategory $prodCategory, 
                            ProdCategoryRepository $prodCategories, 
                            Product $product,
                            ProductRepository $products,
                            ContactMeRepository $contactMes,
                            LogoRepository $logos
                        ): Response
    { 
        
        if (!$prodCategories){
            return $this->redirectToRoute('category');
        }

         if(!$product){
            return $this->redirectToRoute('product_by_category');
        }

        return $this->render('product/show.html.twig', [
            'prodCategories' => $prodCategories->findAll(),
            'prodCategory' => $prodCategory,
            'products' => $products->findByCategory($category),
            'product' => $product,
            'contactMes' => $contactMes->findAll(),
            'logos' => $logos->findAll(),
        ]);
    }
}
