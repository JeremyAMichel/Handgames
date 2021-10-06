<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class MailerController extends AbstractController
{
    /**
     * @Route("/email", name="email")
     */
    public function sendEmail(MailerInterface $mailer):Response
    {
        $email = (new Email())
            ->from(new Address('handgames.mailer@gmail.com'))
            ->to('rem-je42@hotmail.fr')
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject('La tete de nass on dirait la boule que la statue d\'atlas porte')
            ->text('Et toi t\'es un huge dog');

        $mailer->send($email);

        return new Response();
        
    }
}