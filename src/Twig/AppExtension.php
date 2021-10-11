<?php

namespace App\Twig;


use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

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


    public function __construct(Environment $twigEnvironment, AuthenticationUtils $authenticationUtils)
    {
        $this->twigEnvironment=$twigEnvironment;
        $this->authenticationUtils=$authenticationUtils;
    }
    
    public function getFunctions()
    {
        return [
            new TwigFunction('currentPage', [$this, 'currentPage']),
            new TwigFunction('loginFormRender', [$this, 'loginFormRender']),
        ];
    }

    public function currentPage()
    {
        return $_SERVER['REQUEST_URI'];
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

}