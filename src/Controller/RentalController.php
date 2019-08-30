<?php

namespace App\Controller;

use App\Form\RentalType;
use App\Entity\Rental;
use App\Repository\DriverRepository;
use App\Repository\RentalRepository;
use App\Repository\VehicleRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class RentalController extends AbstractController
{
    /**
     * @Route("/rental", name="rental")
     */
    public function index(RentalRepository $rentalRepository)
    {
        return $this->render('rental/index.html.twig', [
            'controller_name' => 'RentalController',
            'rentals'=>$rentalRepository->findAll(),

        ]);
    }

    /**
     * @Route("rental/new", name="rental_create",methods={"GET","POST"})
     * @Route("rental/new/{id}/edit", name="rental_edit",methods={"GET","POST"})
     */
    public function create(ObjectManager $manager, Request $request,Rental $rental  = null)
    {
        if (!$rental) {
            $rental = new Rental();
        }
        $form = $this->createForm(RentalType::class, $rental);


        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $manager->persist($rental);
            $manager->flush();

            return $this->redirectToRoute('rental');
        }

        return $this->render('rental/create.html.twig', [
            'form' => $form->createView(),
            'editMode' => $rental->getId()//gerer le bouton update ou save selon le cas
        ]);
    }

}
