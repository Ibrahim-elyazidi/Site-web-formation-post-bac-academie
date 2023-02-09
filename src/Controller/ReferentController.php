<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReferentController extends AbstractController
{
    #[Route('/referent', name: 'app_referent')]
    public function index(): Response
    {
        return $this->render('referent/index.html.twig', [
            'controller_name' => 'ReferentController',
        ]);
    }
}
