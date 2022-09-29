<?php

namespace App\Controller;

use App\Repository\VoitureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ExoController extends AbstractController
{
    /**
     * @Route("/exo", name="app_exo")
     */
    public function index(): Response
    {
        return $this->render('exo/index.html.twig', [
            'controller_name' => 'ExoController',
        ]);
    }

    /**
     * @Route("/voitures", name="voitures")
     */
    public function voitures()
    {
        $voiture = "R5";
        $description = "Un petit véhicule cher";
        $prix = 1600;

        return $this->render('exo/voitures.html.twig', [
            'voiture' => $voiture,
            'desc' => $description,
            'prix' => $prix
        ]);
    }

    /**
     * @Route("/voiture/liste", name="voiture_liste")
     */
    public function liste(VoitureRepository $repo)
    {
        $voitures = $repo->findAll();

        return $this->render('exo/liste.html.twig', [
            'voitures' => $voitures
        ]);
    }
}