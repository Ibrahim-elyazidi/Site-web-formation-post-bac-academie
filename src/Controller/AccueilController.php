<?php

namespace App\Controller;

use App\Form\AccueilType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\FormationRepository;
use App\Repository\DepartementRepository;
use App\Repository\EtablissementRepository;


class AccueilController extends AbstractController
{

    #[Route('/accueil', name: 'app_accueil_index', methods: ['GET'])]
    public function index(FormationRepository $formationRepository,DepartementRepository $departementRepository,EtablissementRepository $etablissementRepository): Response
    {
        $form = $this->createForm(AccueilType::class);
        return $this->render('accueil/index.html.twig', [
            'controller_name' => 'AccueilController',
            'formations' => $formationRepository->findAll(),
            'departements' => $departementRepository->findAll(),
            'etablissements' => $etablissementRepository->findAll(),
            'form'=> $form->createView()

        ]);
        
        
        
    }
    
    

    
}

