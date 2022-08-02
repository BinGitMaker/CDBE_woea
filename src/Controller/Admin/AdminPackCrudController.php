<?php

namespace App\Controller\Admin;

use App\Entity\Pack;
use App\Form\PackType;
use App\Repository\PackRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('admin/forfait', name: 'admin_pack_')]
class AdminPackCrudController extends AbstractController
{
    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(PackRepository $packRepository): Response
    {
        return $this->render('admin/pack/index.html.twig', [
            'packs' => $packRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'new', methods: ['GET', 'POST'])]
    public function new(Request $request, PackRepository $packRepository): Response
    {
        $pack = new Pack();
        $form = $this->createForm(PackType::class, $pack);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $packRepository->add($pack, true);

            return $this->redirectToRoute('admin_pack_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/pack/new.html.twig', [
            'pack' => $pack,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Pack $pack, PackRepository $packRepository): Response
    {
        $form = $this->createForm(PackType::class, $pack);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $packRepository->add($pack, true);

            return $this->redirectToRoute('admin_pack_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/pack/edit.html.twig', [
            'pack' => $pack,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/delete', name: 'delete', methods: ['POST'])]
    public function delete(Request $request, Pack $pack, PackRepository $packRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$pack->getId(), $request->request->get('_token'))) {
            $packRepository->remove($pack, true);
        }

        return $this->redirectToRoute('admin_pack_index', [], Response::HTTP_SEE_OTHER);
    }
}
