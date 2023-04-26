<?php

namespace App\Controller\Admin;

use App\Entity\Offers;
use App\Entity\Pack;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminDashboardController extends AbstractDashboardController
{
    public function __construct(
        private AdminUrlGenerator $adminUrlGenerator){
    }

    #[Route('/admin', name: 'admin.index')]
    public function index(): Response
    {
        $url = $this->adminUrlGenerator
            ->setController(UserCrudController::class)
            ->generateUrl();

        return $this->redirect($url);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Megacasting')
            ->setLocales(['fr']);
    }

    public function configureMenuItems(): iterable
    {
        // Ajouter un lien vers la page d'accueil du site
        yield MenuItem::linkToUrl('Retour à l\'accueil', 'fas fa-home', '/');

        yield MenuItem::section('Utilisateurs');

        yield MenuItem::subMenu('Actions', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Ajouter un utilisateur', 'fas fa-plus', User::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Voir les utilisateurs', 'fas fa-eye', User::class)
         ]);

        yield MenuItem::section('Offres');

        yield MenuItem::subMenu('Actions', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Ajouter une offre', 'fas fa-plus', Offers::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Voir les offres', 'fas fa-eye', Offers::class)
        ]);

        yield MenuItem::section('Packs');

        yield MenuItem::subMenu('Actions', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Ajouter un pack d\'offres', 'fas fa-plus', Pack::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Voir les pack d\'offres', 'fas fa-eye', Pack::class)
        ]);
    }
}
