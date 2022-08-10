<?php

namespace App\Controller;

use App\Entity\Massage;
use App\Entity\MassCategory;
use App\Entity\Feedback;

use App\Repository\MassageRepository;
use App\Repository\MassCategoryRepository;
use App\Repository\PackRepository;
use App\Repository\PackCatSoloRepository;
use App\Repository\PackCatMultiRepository;
use App\Repository\FeedbackRepository;

use Doctrine\ORM\EntityManagerInterface;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

#[Route('/mes-prestations')]
class MassageController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager){
        $this->entityManager = $entityManager;
    }
    
    #[Route('/', name: 'massCategory')]
    public function index(): Response
    {    
        $massCategories = $this->entityManager
            ->getRepository(MassCategory::class)
            ->findAll();

        return $this->render('massage/index.html.twig', [
            'massCategories' => $massCategories,
        ]);
    }

    #[Route('/{slug}', name: 'massage_by_category')]
    public function indexByCategory(MassCategory $massCategory, 
                                    MassCategoryRepository $massCategories
                                    ): Response
    {   
        if (!$massCategory){
            return $this->redirectToRoute('massCategory');
        }

        $massages = $this->entityManager
            ->getRepository( Massage::class)
            ->findByMassCategory($massCategory);

        return $this->render('massage/index_by_category.html.twig', [
            'massCategories' => $massCategories->findAll(),
            'massCategory' => $massCategory,
            'massages' => $massages,
        ]);
    }

    #[Route('/{slug}/{title_massage}', name: 'massage')]
    #[ParamConverter('massage',options:['mapping'=>['title_massage'=>'title']])]
    public function show(   
                            MassCategory $massCategory, 
                            MassCategoryRepository $massCategories, 
                            Massage $massage,
                            MassageRepository $massages,
                            PackCatMultiRepository $packMultis,
                            PackCatSoloRepository $packSolos
                        ): Response
    { 
        
        if (!$massCategories){
            return $this->redirectToRoute('massCategory');
        }

         if(!$massage){
            return $this->redirectToRoute('massage_by_category');
        }

        $feedbacks = $this->entityManager->getRepository(Feedback::class)->findByIsBest(1);        
        
        return $this->render('massage/show.html.twig', [
            'massCategories' => $massCategories->findAll(),
            'massCategory' => $massCategory,
            'massages' => $massages->findByMassCategory($massCategory),
            'massage' => $massage,
            'packMultis' => $packMultis->findAll(),
            'packSolos' => $packSolos->findAll(),
            'feedbacks' => $feedbacks,
        ]);
    }
}
