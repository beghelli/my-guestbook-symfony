<?php

namespace App\Controller\Admin;

use App\Controller\Admin\ConferenceCrudController;
use App\Entity\Comment;
use App\Entity\Conference;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
	#[Route('/admin', name: 'admin')]
	public function index(): Response
	{
		$adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
		return $this->redirect($adminUrlGenerator->setController(ConferenceCrudController::class)->generateUrl());
	}

	public function configureDashboard(): Dashboard
	{
		return Dashboard::new()
			->setTitle('Myguestbook');
	}

	public function configureMenuItems(): iterable
	{
		yield MenuItem::linktoRoute('Back to the website', 'fas fa-home', 'homepage');
		yield MenuItem::linkToCrud('Conferences', 'fas fa-map-marker-alt', Conference::class);
		yield MenuItem::linkToCrud('Comments', 'fas fa-comments', Comment::class);
	}
}
