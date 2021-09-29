<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfilSkinsController extends AbstractController
{
    /**
     * @Route("/profil-skins", name="profilSkins")
     */
    public function index(): Response
    {
        return $this->render('profilSkins/profilSkins.html.twig', [
        ]);
    }
}
