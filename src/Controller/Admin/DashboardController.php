<?php

namespace App\Controller\Admin;

use App\Entity\OrderItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\Menu\LogoutMenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Entity\Productos;
use App\Entity\Marcas;
use App\Entity\Order;
use App\Entity\Categorias;

/**
 * @IsGranted("ROLE_ADMIN")
 */
class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        $routeBuilder = $this->get(AdminUrlGenerator::class);

        return $this->redirect($routeBuilder->setController(UserCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {

        return Dashboard::new()
            ->setTitle('FreeMarket');


    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToRoute('Inicio', 'fa fa-home','principal');
        yield MenuItem::linkToCrud('Usuarios', 'fas fa-user', User::class);
        yield MenuItem::linkToCrud('Productos', 'fas fa-cube', Productos::class);
        yield MenuItem::linkToCrud('Pedidos', 'fas fa-receipt', Order::class);
        yield MenuItem::linkToCrud('Marcas', 'fas fa-bookmark', Marcas::class);
        yield MenuItem::linkToCrud('Categorias', 'fas fa-copyright', Categorias::class);
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
        yield MenuItem::linkToRoute('Importar', 'fas fa-file-upload','carga_masiva');


    }
}
