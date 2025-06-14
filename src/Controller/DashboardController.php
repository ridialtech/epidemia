<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Country;
use App\Entity\Zone;
use App\Entity\SurveillancePoint;
use Symfony\Component\Routing\Annotation\Route;

    #[Route('/pays/nouveau', name: 'country_new', methods: ['GET','POST'])]
    public function newCountry(Request $request, EntityManagerInterface $em): Response
        if ($request->isMethod('POST')) {
            $name = trim($request->request->get('name'));
            if ($name !== '') {
                $country = new Country();
                $country->setName($name);
                $em->persist($country);
                $em->flush();
                return $this->redirectToRoute('country_list');
            }
        }

    #[Route('/zone/nouvelle', name: 'zone_new', methods: ['GET','POST'])]
    public function newZone(Request $request, EntityManagerInterface $em, CountryRepository $countries): Response
        if ($request->isMethod('POST')) {
            $name = trim($request->request->get('name'));
            $countryId = $request->request->get('country');
            if ($name !== '' && $countryId) {
                $country = $countries->find($countryId);
                if ($country) {
                    $zone = new Zone();
                    $zone->setName($name);
                    $zone->setCountry($country);
                    $zone->setPopulation((int)$request->request->get('population', 0));
                    $zone->setSymptomatic((int)$request->request->get('symptomatic', 0));
                    $zone->setPositive((int)$request->request->get('positive', 0));
                    $zone->setStatus($request->request->get('status'));
                    $em->persist($zone);
                    $em->flush();
                    return $this->redirectToRoute('zone_list');
                }
            }
        }


    #[Route('/point/nouveau', name: 'point_new', methods: ['GET','POST'])]
    public function newPoint(Request $request, EntityManagerInterface $em, ZoneRepository $zones): Response
        if ($request->isMethod('POST')) {
            $name = trim($request->request->get('name'));
            $zoneId = $request->request->get('zone');
            if ($name !== '' && $zoneId) {
                $zone = $zones->find($zoneId);
                if ($zone) {
                    $point = new SurveillancePoint();
                    $point->setName($name);
                    $point->setZone($zone);
                    $em->persist($point);
                    $em->flush();
                    return $this->redirectToRoute('point_list');
                }
            }
        }

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
