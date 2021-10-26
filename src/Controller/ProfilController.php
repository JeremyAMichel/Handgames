<?php

namespace App\Controller;

use App\Entity\Avatar;
use App\Entity\Trophee;
use App\Repository\AvatarRepository;
use App\Repository\StatistiqueRepository;
use App\Repository\TropheeRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfilController extends AbstractController
{

    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @var AvatarRepository
     */
    private $ar;

    /**
     * @var UserRepository
     */
    private $ur;



    public function __construct(EntityManagerInterface $em, AvatarRepository $ar, UserRepository $ur)
    {
        $this->em=$em;
        $this->ar=$ar;
        $this->ur=$ur;

    }
   
    /**
     * @Route("/profil-general", name="profilGeneral")
     */
    public function profilGeneral(): Response
    {

        $avatars=$this->ar->findAll();
        if(count($avatars)!= 8){
            $firstAvatar = $this->ar->findOneBy(['path' => '/build/image/avatars/default-avatar.png']);
            if(null==$firstAvatar){
                $firstAvatar = new Avatar();
                $firstAvatar->setPath('/build/image/avatars/default-avatar.png');
                $this->em->persist($firstAvatar);
            }

            $secondAvatar = $this->ar->findOneBy(['path' => '/build/image/avatars/profil-pic-1.jpg']);
            if(null==$secondAvatar){
                $secondAvatar = new Avatar();
                $secondAvatar->setPath('/build/image/avatars/profil-pic-1.jpg');
                $this->em->persist($secondAvatar);
            }

            $thirdAvatar = $this->ar->findOneBy(['path' => '/build/image/avatars/profil-pic-2.png']);
            if(null==$thirdAvatar){
                $thirdAvatar = new Avatar();
                $thirdAvatar->setPath('/build/image/avatars/profil-pic-2.png');
                $this->em->persist($thirdAvatar);
            }

            $fourthAvatar = $this->ar->findOneBy(['path' => '/build/image/avatars/profil-pic-3.jpg']);
            if(null==$fourthAvatar){
                $fourthAvatar = new Avatar();
                $fourthAvatar->setPath('/build/image/avatars/profil-pic-3.jpg');
                $this->em->persist($fourthAvatar);
            }

            $fifthAvatar = $this->ar->findOneBy(['path' => '/build/image/avatars/profil-pic-4.png']);
            if(null==$fifthAvatar){
                $fifthAvatar = new Avatar();
                $fifthAvatar->setPath('/build/image/avatars/profil-pic-4.png');
                $this->em->persist($fifthAvatar);
            }

            $sixthAvatar = $this->ar->findOneBy(['path' => '/build/image/avatars/profil-pic-5.png']);
            if(null==$sixthAvatar){
                $sixthAvatar = new Avatar();
                $sixthAvatar->setPath('/build/image/avatars/profil-pic-5.png');
                $this->em->persist($sixthAvatar);
            }

            $seventhAvatar = $this->ar->findOneBy(['path' => '/build/image/avatars/profil-pic-6.png']);
            if(null==$seventhAvatar){
                $seventhAvatar = new Avatar();
                $seventhAvatar->setPath('/build/image/avatars/profil-pic-6.png');
                $this->em->persist($seventhAvatar);
            }

            $eighthAvatar = $this->ar->findOneBy(['path' => '/build/image/avatars/profil-pic-7.jpg']);
            if(null==$eighthAvatar){
                $eighthAvatar = new Avatar();
                $eighthAvatar->setPath('/build/image/avatars/profil-pic-7.jpg');
                $this->em->persist($eighthAvatar);
            }

            $this->em->flush();

        }

        $avatars = $this->ar->findAll();

        $firstAvatarGroup = array_slice($avatars,0,4);
        $secondAvatarGroup = array_slice($avatars,4);

        return $this->render('profil/profil-general.html.twig', [
            'firstAvatarGroup'=>$firstAvatarGroup,
            'secondAvatarGroup'=>$secondAvatarGroup,

        ]);
    }

    /**
     * @Route("/profil-general/{idAvatar}/{idUser}", name="profilPicChangeTreatment")
     */
    public function profilPicChangeTreatment(int $idAvatar, int $idUser): RedirectResponse
    {
        $user=$this->ur->find($idUser);
        $avatar=$this->ar->find($idAvatar);

        $user->setAvatar($avatar);

        $this->em->persist($user);
        $this->em->flush();

        return $this->redirectToRoute('profilGeneral');

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
