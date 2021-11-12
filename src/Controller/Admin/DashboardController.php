<?php

namespace App\Controller\Admin;

use App\Entity\Actualite;
use App\Entity\Jeu;
use App\Entity\Trophee;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Handgames');
    }

    public function configureMenuItems(): iterable
    {
        return [
            MenuItem::linkToDashboard('Dashboard','fa fa-home'),
            MenuItem::linkToRoute('Back to the website', 'fas fa-home','home'),

            MenuItem::section('News'),
            MenuItem::linkToCrud('News', 'fas fa-comments',Actualite::class),

            MenuItem::section('Games'),
            MenuItem::linkToCrud('Games', 'fas fa-comments',Jeu::class),

        ];
    }
}
