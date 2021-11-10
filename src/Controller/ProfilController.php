<?php

namespace App\Controller;

use App\Entity\Avatar;
use App\Entity\Trophee;
use App\Entity\User;
use App\Form\UserPseudoPwType;
use App\Repository\AvatarRepository;
use App\Repository\StatistiqueRepository;
use App\Repository\TropheeRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

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

    /**
     * @var Security
     */
    private $security;



    public function __construct(EntityManagerInterface $em, AvatarRepository $ar, UserRepository $ur,
    Security $security)
    {
        $this->em=$em;
        $this->ar=$ar;
        $this->ur=$ur;
        $this->security=$security;

    }
   
    /**
     * @Route("/profil-general/{error}", name="profilGeneral")
     */
    public function profilGeneral(Request $request, UserPasswordHasherInterface $passwordHasher,
    $error=null): Response
    {

        $this->createAvatarPaths();

        $avatars = $this->ar->findAll();

        $firstAvatarGroup = array_slice($avatars,0,4);
        $secondAvatarGroup = array_slice($avatars,4);


        /**
         * @var User
         */
        $currentUser = $this->security->getUser();

        $form = $this->createForm(UserPseudoPwType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data=$form->getData();
            $isAction = 0;
            //la photo de profil n'étant pas jugé comme étant une information sensible, aucune restriction 
            //sur le changement
            if($data['avatar']!==null){
                if($data['avatar']!==($currentUser->getAvatar()->getId())){
                    $currentUser->setAvatar($this->ar->find($data['avatar']));
                    $this->em->persist($currentUser);
                    $isAction++;    
                }         
            }

            // si l'utilisateur veut changer son pseudo ou son mot de passe il doit renseigner l'ancien
            if($data['newPassword']!==null || $data['pseudo']!==null){
                if($data['oldPassword']!==null){
                    //si l'ancien password est le même que celui qu'il a renseigné
                    if($passwordHasher->isPasswordValid($currentUser,$data['oldPassword'])){
                        // si il y a une valeur dans l'input new password
                        if($data['newPassword']!==null){
                            if(!$passwordHasher->isPasswordValid($currentUser,$data['newPassword'])){
                                $currentUser->setPassword($passwordHasher->hashPassword($currentUser,$data['newPassword']));
                                $isAction++;
                                $this->em->persist($currentUser);
                            }                           
                        }
                        // si il y a une valeur dans l'input pseudo
                        if($data['pseudo']!==null){
                            // si le pseudo n'est pas le même que l'utilisateur possède déjà
                            if($data['pseudo']!==$currentUser->getPseudo()){
                                $currentUser->setPseudo($data['pseudo']);
                                $isAction++;
                                $this->em->persist($currentUser);
                            }                         
                        }  

                    }else{
                        return $this->redirectToRoute('profilGeneral',['error'=>'badPassword']);
                    }
                       
                }else{
                    return $this->redirectToRoute('profilGeneral',['error'=>'noPassword']);
                }
                
            }
            
            if($isAction!==0){
                $this->em->flush();
                return $this->redirectToRoute('profilGeneral');
                // dump('on flush');
            }        
        }

        return $this->render('profil/profil-general.html.twig', [
            'firstAvatarGroup'=>$firstAvatarGroup,
            'secondAvatarGroup'=>$secondAvatarGroup,
            'form'=>$form->createView(),
            'error'=>$error,
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

    ////////////////////////////////////////////////////////
    //this is a temp function for dev working in local//////
    ////////////////////////////////////////////////////////
    private function createAvatarPaths()
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
    }
}
