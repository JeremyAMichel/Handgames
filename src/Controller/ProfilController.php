<?php

namespace App\Controller;

use App\Entity\Avatar;
use App\Repository\AvatarRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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

    public function __construct(EntityManagerInterface $em, AvatarRepository $ar)
    {
        $this->em=$em;
        $this->ar=$ar;
    }
   
    /**
     * @Route("/profil-general", name="profilGeneral")
     */
    public function profilGeneral(): Response
    {

        // TEMP
        $avatars=$this->ar->findAll();
        if(count($avatars)!= 8){
            $firstAvatar= $this->ar->findOneBy(['path' => 'build/image/avatars/default-avatar.png']);
            if(null==$firstAvatar){
                $firstAvatar= new Avatar();
                $firstAvatar->setPath('build/image/avatars/default-avatar.png');
                $this->em->persist($firstAvatar);
            }

            $secondAvatar= $this->ar->findOneBy(['path' => 'build/image/avatars/profil-pic-1.jpg']);
            if(null==$secondAvatar){
                $secondAvatar= new Avatar();
                $secondAvatar->setPath('build/image/avatars/profil-pic-1.jpg');
                $this->em->persist($secondAvatar);
            }

            $this->em->flush();
        }

        // dump($this->ar->findOneBy(['path' => 'build/image/avatars/']));
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
