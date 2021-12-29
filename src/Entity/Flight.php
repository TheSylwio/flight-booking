<?php

namespace App\Entity;

use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Flight {
	private ?int $id;
	private ?Airport $departureAirport;
	private ?Airport $arrivalAirport;
	private ?Plane $plane;
	private ?Collection $reservations;
	private ?DateTimeInterface $departureDatetime;

	public function __construct() {
		$this->reservations = new ArrayCollection();
	}

	public function getId(): ?int {
		return $this->id;
	}

	public function getDepartureAirport(): ?Airport {
		return $this->departureAirport;
	}

	public function setDepartureAirport(?Airport $departureAirport): void {
		$this->departureAirport = $departureAirport;
	}

	public function getArrivalAirport(): ?Airport {
		return $this->arrivalAirport;
	}

	public function setArrivalAirport(?Airport $arrivalAirport): void {
		$this->arrivalAirport = $arrivalAirport;
	}

	public function getPlane(): ?Plane {
		return $this->plane;
	}

	public function setPlane(?Plane $plane): void {
		$this->plane = $plane;
	}

	/** @return Collection|Reservation[] */
	public function getReservations(): Collection {
		return $this->reservations;
	}

	public function addReservation(Reservation $reservation): void {
		if (!$this->reservations->contains($reservation)) {
			$this->reservations[] = $reservation;
			$reservation->setFlight($this);
		}
	}

	public function removeReservation(Reservation $reservation): void {
		if ($this->reservations->removeElement($reservation)) {
			if ($reservation->getFlight() === $this) {
				$reservation->setFlight(null);
			}
		}
	}

	public function getDepartureDatetime(): ?DateTimeInterface {
		return $this->departureDatetime;
	}

	public function setDepartureDatetime(DateTimeInterface $departureDatetime): void {
		$this->departureDatetime = $departureDatetime;
	}
}
