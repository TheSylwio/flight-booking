<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Entity\Seat;
use App\Repository\FlightRepository;
use App\Repository\SeatRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ReservationController extends AbstractController {
	public function create(Request $request, SeatRepository $seatRepository, FlightRepository $flightRepository, EntityManagerInterface $em): JsonResponse {
		$data = json_decode($request->getContent());

		$flight = $flightRepository->find($data->flight);
		$plane = $flight->getPlane();

		$chosenSeat = $seatRepository->findBy(['orderNumber' => $data->seat, 'plane' => $plane]);
		if ($chosenSeat) {
			return $this->json(sprintf('Seat with order number: %d already exists!', $data->seat), Response::HTTP_BAD_REQUEST);
		}

		$seat = new Seat();
		$seat->setPlane($plane);
		$seat->setOrderNumber($data->seat);

		$reservation = new Reservation();
		$reservation->setDatetime(new DateTime());
		$reservation->setStatus($data->status);
		$reservation->setSeat($seat);
		$reservation->setFlight($flight);
		$reservation->setUser('testUser'); // FIXME

		$em->persist($seat);
		$em->persist($reservation);
		$em->flush();

		return $this->json('Entity created', Response::HTTP_CREATED);
	}

	public function patch(Request $request, EntityManagerInterface $em): JsonResponse {
		$data = json_decode($request->getContent());

		$reservation = $em->getRepository(Reservation::class)->find($data->id);
		$reservation->setStatus($data->status);

		$em->flush();

		return $this->json('Entity updated', Response::HTTP_OK);
	}
}