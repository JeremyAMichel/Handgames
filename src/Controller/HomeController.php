<?php

namespace App\Controller;

use App\Entity\Skin;
use App\Repository\SkinRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{

    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @var SkinRepository
     */
    private $sr;

    public function __construct(EntityManagerInterface $em, SkinRepository $sr)
    {
        $this->em=$em;
        $this->sr=$sr;
    }


    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        //!!!!!!!!!! THIS IS ONLY FOR DEV !!!!!!!!\\\\\\\\
        $this->bddTempAlterationForDev();
        //\\\\\\\\\\\\\\\\\\\\\\//////////////////////////



        return $this->render('home/index.html.twig', [
            
        ]);
    }

    //!!!!!!!!!! THIS IS ONLY FOR DEV !!!!!!!!\\\\\\\\
    private function bddTempAlterationForDev()
    {
        ///for the Default skin
        $skin=$this->sr->findOneBy(['name' => 'Default Skin']);
        if(null === $skin){
            $skin = new Skin();
            $skin->setName('Default Skin');
            $skin->setRockUrl('/build/image/skins/default-skin/default-hand-rock.png');
            $skin->setScissorUrl('/build/image/skins/default-skin/default-hand-scissors.png');
            $skin->setPaperUrl('/build/image/skins/default-skin/default-hand-paper.png');

            $this->em->persist($skin);
            $this->em->flush();
        }
    }
    //\\\\\\\\\\\\\\\\\\\\\\//////////////////////////
}


