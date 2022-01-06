<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Repository\FlightRepository;
use App\Repository\SeatRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ReservationController extends AbstractController {
	public function create(Request $request, SeatRepository $seatRepository, FlightRepository $flightRepository, EntityManagerInterface $em): JsonResponse {
		$data = json_decode($request->getContent());

		$reservation = new Reservation();
		$reservation->setDatetime(new \DateTime());
		$reservation->setStatus($data->status);
		$reservation->setSeat($seatRepository->find($data->seat));
		$reservation->setFlight($flightRepository->find($data->flight));
		$reservation->setUser('testUser'); // FIXME

		$em->persist($reservation);
		$em->flush();

		return $this->json('Entity created', Response::HTTP_CREATED);
	}
}