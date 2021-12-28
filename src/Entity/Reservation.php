<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservationRepository::class)]
class Reservation {
	#[ORM\Id]
	#[ORM\GeneratedValue]
	#[ORM\Column(type: 'integer')]
	private ?int $id;

	#[ORM\ManyToOne(targetEntity: Airport::class, inversedBy: 'departureReservations')]
	#[ORM\JoinColumn(nullable: false)]
	private ?Airport $departureAirport;

	#[ORM\ManyToOne(targetEntity: Airport::class, inversedBy: 'arrivalReservations')]
	#[ORM\JoinColumn(nullable: false)]
	private ?Airport $arrivalAirport;

	#[ORM\Column(type: 'datetime')]
	private ?DateTimeInterface $departureDatetime;

	public function getId(): ?int {
		return $this->id;
	}

	public function getDepartureAirport(): ?Airport {
		return $this->departureAirport;
	}

	public function setDepartureAirport(?Airport $departureAirport): self {
		$this->departureAirport = $departureAirport;

		return $this;
	}

	public function getArrivalAirport(): ?Airport {
		return $this->arrivalAirport;
	}

	public function setArrivalAirport(?Airport $arrivalAirport): self {
		$this->arrivalAirport = $arrivalAirport;

		return $this;
	}

	public function getDepartureDatetime(): ?DateTimeInterface {
		return $this->departureDatetime;
	}

	public function setDepartureDatetime(DateTimeInterface $departureDatetime): self {
		$this->departureDatetime = $departureDatetime;

		return $this;
	}
}
