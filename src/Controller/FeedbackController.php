<?php

namespace App\Controller;

use App\Entity\Feedback;
use App\Repository\AboutRepository;
use App\Repository\FeedbackRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FeedbackController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager){
        $this->entityManager = $entityManager;
    }

    #[Route('/avis', name: 'feedback')]
    public function index(FeedbackRepository $feedbacks, AboutRepository $abouts): Response
    {
        return $this->render('feedback/index.html.twig',[
            'feedbacks' => $feedbacks->findAll(),
            'abouts' => $abouts->findAll(),
        ]);
    }
}
