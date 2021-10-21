<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RockPaperScissorsController extends AbstractController
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
     * @Route("/games/rockpaperscissors", name="rock_paper_scissors")
     */
    public function RockPaperScissors(): Response
    {
        return $this->render('rock_paper_scissors/rock_paper_scissors.html.twig', [

        ]);
    }
}
