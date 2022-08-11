<?php

namespace App\Controller;

use App\Repository\LogoRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AccountController extends AbstractController
{
    #[Route('/compte', name: 'account')]
    public function index(LogoRepository $logos): Response
    {
        return $this->render('account/index.html.twig', [
            'logos' => $logos->findAll(),
        ]);
    }
}
