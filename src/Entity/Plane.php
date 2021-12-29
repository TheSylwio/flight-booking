<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Plane {
	private ?int $id;
	private ?string $name;
	private Collection $seats;
	private Collection $reservations;

	public function __construct() {
		$this->seats = new ArrayCollection();
	}

	public function getId(): ?int {
		return $this->id;
	}

	public function getName(): ?string {
		return $this->name;
	}

	public function setName(string $name): self {
		$this->name = $name;

		return $this;
	}

	/**
	 * @return Collection|Seat[]
	 */
	public function getSeats(): Collection {
		return $this->seats;
	}

	public function addSeat(Seat $seat): self {
		if (!$this->seats->contains($seat)) {
			$this->seats[] = $seat;
			$seat->setPlane($this);
		}

		return $this;
	}

	public function removeSeat(Seat $seat): self {
		if ($this->seats->removeElement($seat)) {
			// set the owning side to null (unless already changed)
			if ($seat->getPlane() === $this) {
				$seat->setPlane(null);
			}
		}

		return $this;
	}

	/**
	 * @return Collection|Reservation[]
	 */
	public function getReservations(): Collection {
		return $this->reservations;
	}

	public function addReservation(Reservation $reservation): self {
		if (!$this->seats->contains($reservation)) {
			$this->reservations[] = $reservation;
			$reservation->setPlane($this);
		}

		return $this;
	}

	public function removeReservation(Reservation $reservation): self {
		if ($this->seats->removeElement($reservation)) {
			// set the owning side to null (unless already changed)
			if ($reservation->getPlane() === $this) {
				$reservation->setPlane(null);
			}
		}

		return $this;
	}
}
