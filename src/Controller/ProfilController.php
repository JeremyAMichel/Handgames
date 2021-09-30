<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfilController extends AbstractController
{
    /**
     * @Route("/profil-general", name="profilGeneral")
     */
    public function profilGeneral(): Response
    {
        return $this->render('profil/profil-general.html.twig', [
        ]);
    }

    /**
     * @Route("/profil-skins", name="profilSkins")
     */
    public function profilSkins(): Response
    {
        return $this->render('profil/profil-skins.html.twig', [
        ]);
    }
    
    /**
     * @Route("/profil-stats", name="profilStats")
     */
    public function profilStats(): Response
    {
        return $this->render('profil/profil-stats.html.twig', [
        ]);
    }
}
