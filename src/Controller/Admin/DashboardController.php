<?php

namespace App\Controller\Admin;

use App\Entity\Apropos;
use App\Entity\Categorie;
use App\Entity\Vetement;
use App\Repository\AproposRepository;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    private $aproposRepository;
    public function __construct(AproposRepository $aproposRepository){
        $this->aproposRepository=$aproposRepository;
        }

    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        $apropos=$this->aproposRepository->apropos();
        return Dashboard::new()
            ->setTitle($apropos->getTitre());
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Produits', 'fas fa-list', Vetement::class);
        yield MenuItem::linkToCrud('Categories', 'fas fa-tags', Categorie::class);
        yield MenuItem::linkToCrud('Paramètres', 'fas fa-cog', Apropos::class);
    }
}
