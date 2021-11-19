<?php

namespace App\Controller;

use App\Repository\SkinRepository;
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
     * @var SkinRepository
     */
    private $skinRepository;

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
    public function __construct(EntityManagerInterface $em, UserRepository $userRepository, Security $security,
    SkinRepository $skinRepository)
    {
        $this->em = $em;
        $this->userRepository = $userRepository;
        $this->security = $security;
        $this->skinRepository = $skinRepository;
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

                if(null === $currentUser){
                    $currentUserActiveSkin = $this->skinRepository->findOneBy(['name' => 'Default Skin']);
                }else{
                    $currentUserSkins = $currentUser->getUserSkins();
                    foreach($currentUserSkins as $UserSkin){
                        if(true === $UserSkin->getIsActiveSkin()){
                            $currentUserActiveSkin = $UserSkin->getSkin();
                        }
                    }
                }

                return $this->render('rock_paper_scissors/bot.html.twig', [
                    'userSkin' => $currentUserActiveSkin,
                ]);
            }
        }
    }

    /**
     * @Route("/games/rockpaperscissors/ajax/{win}", name="rock_paper_scissors_ajax")
     */
    public function RockPaperScissorsAjax($win):Response
    {
        /**
         * @var User
         */
        $currentUser = $this->getUser();              

        if(null !== $currentUser){

            $stats=$currentUser->getStatistiques()[0];
            $stats->setNbrPartie(($stats->getNbrPartie())+1);
            if('true' === $win){  
                $stats->setNbrWin(($stats->getNbrWin())+1);
            }
            if('false' === $win){
                $stats->setNbrLose(($stats->getNbrLose())+1);
            }

            $this->em->persist($stats);
            $this->em->flush();
            
        }
        
        return new Response();
    }
}
