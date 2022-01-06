<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Seat {
	private ?int $id;
	private ?int $orderNumber;
	private ?Plane $plane;
	private Collection $reservations;

	public function __construct() {
		$this->reservations = new ArrayCollection();
	}

	public function getId(): ?int {
		return $this->id;
	}

	public function getOrderNumber(): ?int {
		return $this->orderNumber;
	}

	public function setOrderNumber(int $orderNumber): void {
		$this->orderNumber = $orderNumber;
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
			$reservation->setSeat($this);
		}
	}

	public function removeFlight(Reservation $reservation): void {
		if ($this->reservations->removeElement($reservation)) {
			if ($reservation->getSeat() === $this) {
				$reservation->setSeat(null);
			}
		}
	}
}
