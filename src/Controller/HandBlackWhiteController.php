<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HandBlackWhiteController extends AbstractController
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
     * @Route("/games/handblackwhite", name="hand_black_white")
     */
    public function HandBlackWhite(): Response
    {
        return $this->render('hand_black_white/hand_black_white.html.twig', [
        ]);
    }
}
