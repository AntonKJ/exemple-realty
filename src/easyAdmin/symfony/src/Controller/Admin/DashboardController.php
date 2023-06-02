<?php

namespace App\Controller\Admin;

use App\Entity\Works;
use App\Entity\Categories;
use App\Entity\Rooms;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\CrudUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        // return parent::index();
        $routeBuilder = $this->get(CrudUrlGenerator::class)->build();
        $url = $routeBuilder->setController(CategoriesCrudController::class)->generateUrl();

        return $this->redirect($url);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Symfony')
            ->disableUrlSignatures();
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToUrl('Back to the website', 'fa fa-home', '/');
        yield MenuItem::linkToUrl('', '', '');
        yield MenuItem::linkToCrud('List Rooms', 'far fa-clipboard', Rooms::class);
        yield MenuItem::linkToCrud('Categories', 'fas fa-folder', Categories::class);
        yield MenuItem::linkToCrud('Works', 'far fa-comments', Works::class);
    }
}
