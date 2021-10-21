<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RaceTyperController extends AbstractController
{

    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * HandBlackWhiteController constructor.
     * @param EntityManagerInterface $em
     * @param UserRepository $userRepository
     */
    public function __construct(EntityManagerInterface $em, UserRepository $userRepository)
    {
        $this->em = $em;
        $this->userRepository = $userRepository;
    }

    /**
     * @Route("/games/racetyper", name="race_typer")
     */
    public function RaceTyper(): Response
    {
        return $this->render('race_typer/race_typer.html.twig', [

        ]);
    }
}
