<?php

namespace App\Controller;

use App\Entity\Massage;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MassageController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager){
        $this->entityManager = $entityManager;
    }
    
    #[Route('/mes-prestations', name: 'massage')]
    public function index(): Response
    {
        $massages = $this->entityManager
            ->getRepository( Massage::class)
            ->findAll();

        return $this->render('massage/index.html.twig', [
            'massages' => $massages,
        ]);
    }
}
