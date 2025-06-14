<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CountryRepository;
use App\Repository\ZoneRepository;
use App\Repository\SurveillancePointRepository;

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
    public function countryList(CountryRepository $repo): Response
    {
        return $this->render('admin/country_list.html.twig', [
            'countries' => $repo->findAll(),
        ]);
    }

    #[Route('/zone/nouvelle', name: 'zone_new')]
    public function newZone(CountryRepository $countries): Response
    {
        return $this->render('admin/zone_new.html.twig', [
            'countries' => $countries->findAll(),
        ]);
    }

    #[Route('/point/nouveau', name: 'point_new')]
    public function newPoint(ZoneRepository $zones): Response
    {
        return $this->render('admin/point_new.html.twig', [
            'zones' => $zones->findAll(),
        ]);
    }

    #[Route('/points', name: 'point_list')]
    public function pointList(SurveillancePointRepository $repo): Response
    {
        return $this->render('admin/point_list.html.twig', [
            'points' => $repo->findAll(),
        ]);
    }

    #[Route('/zones', name: 'zone_list')]
    public function zoneList(ZoneRepository $repo): Response
    {
        return $this->render('admin/zone_list.html.twig', [
            'zones' => $repo->findAll(),
        ]);
    }

    #[Route('/zones/critiques', name: 'critical_zones')]
    public function criticalZones(ZoneRepository $repo): Response
    {
        return $this->render('admin/critical_zones.html.twig', [
            'zones' => $repo->findBy(['status' => ['orange', 'rouge']]),
        ]);
    }
}
