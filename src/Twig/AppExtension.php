<?php

namespace App\Twig;

use App\Entity\Statistique;
use App\Repository\StatistiqueRepository;
use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Repository\AvatarRepository;
use App\Security\EmailVerifier;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Twig\Environment;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mime\Address;

class AppExtension extends AbstractExtension
{

    /**
     * @var Environment
     */
    private $twigEnvironment;

    /**
     * @var AuthenticationUtils
     */
    private $authenticationUtils;

    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @var Request
     */
    private $request;

    /**
     * @var EmailVerifier
     */
    private $emailVerifier;

    /**
     * @var AvatarRepository
     */
    private $avatarRepository;

    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    /**
     * @var Security
     */
    private $security;

    /**
     * @var StatistiqueRepository
     */
    private $sr;

    public function __construct(Environment $twigEnvironment, AuthenticationUtils $authenticationUtils,
    FormFactoryInterface $formFactory, EntityManagerInterface $em, EmailVerifier $emailVerifier,
     AvatarRepository $avatarRepository, RequestStack $request, UserPasswordEncoderInterface $passwordEncoder,
     Security $security, StatistiqueRepository $sr)
    {
        $this->twigEnvironment=$twigEnvironment;
        $this->authenticationUtils=$authenticationUtils;
        $this->formFactory=$formFactory;
        $this->em=$em;
        $this->emailVerifier = $emailVerifier;
        $this->avatarRepository = $avatarRepository;
        $this->request=$request->getCurrentRequest();
        $this->passwordEncoder=$passwordEncoder;
        $this->security = $security;
        $this->sr = $sr;
    }
    
    public function getFunctions()
    {
        return [
            new TwigFunction('currentPage', [$this, 'currentPage']),
            new TwigFunction('currentUserLevel', [$this, 'currentUserLevel']),
            new TwigFunction('loginFormRender', [$this, 'loginFormRender']),
            new TwigFunction('signupFormRender', [$this, 'signupFormRender']),
        ];
    }

    public function currentPage()
    {
        return $_SERVER['REQUEST_URI'];
    }

    public function currentUserLevel()
    {
        /**
        * @var User
        */
        $user = $this->security->getUser();

        if(null==($user->getStatistiques()[0])){
            $stats = new Statistique();
            $stats->setLevel(1);
            $stats->setNbrLose(0);
            $stats->setNbrWin(0);
            $stats->setNbrPartie(0);

            $stats->addUser($user);

            $this->em->persist($user);
            $this->em->flush();
        }

        return $user->getStatistiques()[0]->getLevel();
    }

    public function loginFormRender()
    {       
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $this->authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $this->authenticationUtils->getLastUsername();

        return $this->twigEnvironment->render('partial/login.html.twig',[
            'last_username' => $lastUsername,
            'error' => $error
        ]);
    }


    public function signupFormRender()
    {
        $user = new User();
        $defaultAvatar = $this->avatarRepository->find(1);
        $form = $this->formFactory->create(RegistrationFormType::class, $user);
        $form->handleRequest($this->request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $this->passwordEncoder->encodePassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );
            $user->setAvatar($defaultAvatar);
            $this->em->persist($user);
            $this->em->flush();

            // generate a signed url and email it to the user
            $this->emailVerifier->sendEmailConfirmation('app_verify_email', $user,
                (new TemplatedEmail())
                    ->from(new Address('handgames.mailer@gmail.com', 'Handgames Verification Bot'))
                    ->to($user->getEmail())
                    ->subject('Please Confirm your Email')
                    ->htmlTemplate('registration/confirmation_email.html.twig')
            );
            // do anything else you need here, like send an email

            // return $this->redirectToRoute('home');
        }

        return $this->twigEnvironment->render('partial/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

}