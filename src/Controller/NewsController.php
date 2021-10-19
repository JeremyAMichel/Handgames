<?php

namespace App\Controller;

use App\Repository\ActualiteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class NewsController extends AbstractController
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @var ActualiteRepository
     */
    private $ar;

    public function __construct(EntityManagerInterface $em, ActualiteRepository $ar)
    {
        $this->em=$em;
        $this->ar=$ar;
    }

    /**
     * @Route("/news", name="news")
     */
    public function news(): Response
    {
        $news = $this->ar->findAll();

        return $this->render('news/news.html.twig', [
            'news'=>$news,
        ]);
    }
}
