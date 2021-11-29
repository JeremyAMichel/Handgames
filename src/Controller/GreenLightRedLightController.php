<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GreenLightRedLightController extends AbstractController
{
    /**
     * @Route("/games/greenlightredlight", name="green_light_red_light")
     */
    public function GreenLightRedLight(): Response
    {
        return $this->render('green_light_red_light/green_light_red_light.html.twig', [
        ]);
    }
}
