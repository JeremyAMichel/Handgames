<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

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
     * @var Security
     */
    private $security;

    /**
     * HandBlackWhiteController constructor.
     * @param EntityManagerInterface $em
     * @param UserRepository $userRepository
     * @param Security $security
     */
    public function __construct(EntityManagerInterface $em, UserRepository $userRepository, Security $security)
    {
        $this->em = $em;
        $this->userRepository = $userRepository;
        $this->security = $security;
    }

    /**
     * @Route("/games/rockpaperscissors/{mode}", name="rock_paper_scissors")
     */
    public function RockPaperScissors($mode = null): Response
    {
        if($mode == null){
            return $this->render('rock_paper_scissors/rock_paper_scissors.html.twig', [

            ]);
        }
        else{
            if($mode == 'bot'){
                /**
                 * @var User
                 */
                $currentUser = $this->security->getUser();
                $currentUserSkins = $currentUser->getUserSkins();
                foreach($currentUserSkins as $UserSkin){
                    if(true === $UserSkin->getIsActiveSkin()){
                        $currentUserActiveSkin = $UserSkin->getSkin();
                    }
                }

                return $this->render('rock_paper_scissors/bot.html.twig', [
                    'userSkin' => $currentUserActiveSkin,
                ]);
            }
        }

    }
}
