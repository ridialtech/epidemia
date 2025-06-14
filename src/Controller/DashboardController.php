<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    #[Route('/', name: 'dashboard')]
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig');
    }

    #[Route('/pays/nouveau', name: 'country_new')]
    public function newCountry(): Response
    {
        return $this->render('admin/country_new.html.twig');
    }

    #[Route('/pays', name: 'country_list')]
    public function countryList(): Response
    {
        return $this->render('admin/country_list.html.twig');
    }

    #[Route('/zone/nouvelle', name: 'zone_new')]
    public function newZone(): Response
    {
        return $this->render('admin/zone_new.html.twig');
    }

    #[Route('/point/nouveau', name: 'point_new')]
    public function newPoint(): Response
    {
        return $this->render('admin/point_new.html.twig');
    }

    #[Route('/points', name: 'point_list')]
    public function pointList(): Response
    {
        return $this->render('admin/point_list.html.twig');
    }

    #[Route('/zones', name: 'zone_list')]
    public function zoneList(): Response
    {
        return $this->render('admin/zone_list.html.twig');
    }

    #[Route('/zones/critiques', name: 'critical_zones')]
    public function criticalZones(): Response
    {
        return $this->render('admin/critical_zones.html.twig');
    }
}
