<?php

namespace App\Controller;

use App\Entity\FormationEtablissement;
use App\Form\FormationEtablissementType;
use App\Repository\FormationEtablissementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/formation/etablissement')]
class FormationEtablissementController extends AbstractController
{
    #[Route('/', name: 'app_formation_etablissement_index', methods: ['GET'])]
    public function index(FormationEtablissementRepository $formationEtablissementRepository): Response
    {
        return $this->render('formation_etablissement/index.html.twig', [
            'formation_etablissements' => $formationEtablissementRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_formation_etablissement_new', methods: ['GET', 'POST'])]
    public function new(Request $request, FormationEtablissementRepository $formationEtablissementRepository): Response
    {
        $formationEtablissement = new FormationEtablissement();
        $form = $this->createForm(FormationEtablissementType::class, $formationEtablissement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $formationEtablissementRepository->save($formationEtablissement, true);

            return $this->redirectToRoute('app_formation_etablissement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('formation_etablissement/new.html.twig', [
            'formation_etablissement' => $formationEtablissement,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_formation_etablissement_show', methods: ['GET'])]
    public function show(FormationEtablissement $formationEtablissement): Response
    {
        return $this->render('formation_etablissement/show.html.twig', [
            'formation_etablissement' => $formationEtablissement,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_formation_etablissement_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, FormationEtablissement $formationEtablissement, FormationEtablissementRepository $formationEtablissementRepository): Response
    {
        $form = $this->createForm(FormationEtablissementType::class, $formationEtablissement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $formationEtablissementRepository->save($formationEtablissement, true);

            return $this->redirectToRoute('app_formation_etablissement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('formation_etablissement/edit.html.twig', [
            'formation_etablissement' => $formationEtablissement,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_formation_etablissement_delete', methods: ['POST'])]
    public function delete(Request $request, FormationEtablissement $formationEtablissement, FormationEtablissementRepository $formationEtablissementRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$formationEtablissement->getId(), $request->request->get('_token'))) {
            $formationEtablissementRepository->remove($formationEtablissement, true);
        }

        return $this->redirectToRoute('app_formation_etablissement_index', [], Response::HTTP_SEE_OTHER);
    }
}
