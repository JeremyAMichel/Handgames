<?php

namespace App\Controller;

use App\Entity\Jeu;
use App\Repository\JeuRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GameController extends AbstractController
{

    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @var JeuRepository
     */
    private $jeuRepository;

    /**
     * GameController constructor.
     * @param EntityManagerInterface $em
     * @param JeuRepository $jeuRepository
     */
    public function __construct(EntityManagerInterface $em, JeuRepository $jeuRepository)
    {
        $this->em = $em;
        $this->jeuRepository = $jeuRepository;
    }


    /**
     * @Route("/games", name="games")
     */
    public function games(): Response
    {

        if ($this->jeuRepository->findOneBy(['nom'=>'Rock Paper Scissors'])===null) {
            $this->addDefaultGameToBDD();
        }

        $games=$this->jeuRepository->findAll();

        return $this->render('game/game.html.twig', [
            'games'=>$games
        ]);
    }

    // ATTENTION !!!!!!!!!!!!!!!!!!!!!!
    // FONCTION SEULEMENT POUR DEV
    // ATTENTION !!!!!!!!!!!!!!!!!!!!!!

    private function addDefaultGameToBDD() : Response
    {
        $rps=new Jeu();

        $rps->setDescription('An issue with your friends ? Resolve it HERE !');
        $rps->setNom('Rock Paper Scissors');
        $rps->setPath('/games/rockpaperscissors');
        $rps->setThumbnail('/build/image/other/pierrefeuilleciseaux.jpg');

        $this->em->persist($rps);
        $this->em->flush();


    }

}
