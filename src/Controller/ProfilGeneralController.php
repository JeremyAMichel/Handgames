<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfilGeneralController extends AbstractController
{
    /**
     * @Route("/profil-general", name="profilGeneral")
     */
    public function index(): Response
    {
        return $this->render('profilGeneral/profilGeneral.html.twig', [
        ]);
    }
}
