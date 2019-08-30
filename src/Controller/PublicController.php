<?php

namespace App\Controller;

use App\Repository\DriverRepository;
use App\Repository\RentalRepository;
use App\Repository\VehicleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PublicController extends AbstractController
{
    /**
     * @Route("/", name="public")
     */
    public function index(DriverRepository $driverRepository,VehicleRepository $vehicleRepository,RentalRepository $rentalRepository)
    {

        return $this->render('public/home.html.twig', [
            'controller_name' => 'PublicController',
            'drivers'=>$driverRepository->findAll(),
            'nbdriver'=>$driverRepository->getNb(),
            'nbvehicle'=>$vehicleRepository->getNb(),
            'nbrental'=>$rentalRepository->getNb()
        ]);
    }
}
