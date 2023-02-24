<?php

namespace App\Controller;

use App\Entity\Alternative;
use App\Form\AlternativeType;
use App\Repository\AlternativeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/alternative')]
class AlternativeController extends AbstractController
{
    #[Route('/', name: 'app_alternative_index', methods: ['GET'])]
    public function index(AlternativeRepository $alternativeRepository): Response
    {
        return $this->render('alternative/index.html.twig', [
            'alternatives' => $alternativeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_alternative_new', methods: ['GET', 'POST'])]
    public function new(Request $request, AlternativeRepository $alternativeRepository): Response
    {
        $alternative = new Alternative();
        $form = $this->createForm(AlternativeType::class, $alternative);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $alternativeRepository->save($alternative, true);

            return $this->redirectToRoute('app_alternative_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('alternative/new.html.twig', [
            'alternative' => $alternative,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_alternative_show', methods: ['GET'])]
    public function show(Alternative $alternative): Response
    {
        return $this->render('alternative/show.html.twig', [
            'alternative' => $alternative,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_alternative_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Alternative $alternative, AlternativeRepository $alternativeRepository): Response
    {
        $form = $this->createForm(AlternativeType::class, $alternative);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $alternativeRepository->save($alternative, true);

            return $this->redirectToRoute('app_alternative_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('alternative/edit.html.twig', [
            'alternative' => $alternative,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_alternative_delete', methods: ['POST'])]
    public function delete(Request $request, Alternative $alternative, AlternativeRepository $alternativeRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$alternative->getId(), $request->request->get('_token'))) {
            $alternativeRepository->remove($alternative, true);
        }

        return $this->redirectToRoute('app_alternative_index', [], Response::HTTP_SEE_OTHER);
    }
}
