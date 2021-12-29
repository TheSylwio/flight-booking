<?php

namespace App\Entity;

use DateTimeInterface;

class Reservation {
	private ?int $id;
	private ?Airport $departureAirport;
	private ?Airport $arrivalAirport;
	private ?Plane $plane;
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

	public function getPlane(): ?Plane {
		return $this->plane;
	}

	public function setPlane(?Plane $plane): self {
		$this->plane = $plane;

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
