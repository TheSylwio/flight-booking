<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Plane {
	private ?int $id;
	private ?string $name;
	private Collection $seats;
	private Collection $flights;

	public function __construct() {
		$this->seats = new ArrayCollection();
		$this->flights = new ArrayCollection();
	}

	public function getId(): ?int {
		return $this->id;
	}

	public function getName(): ?string {
		return $this->name;
	}

	public function setName(string $name): void {
		$this->name = $name;
	}

	/** @return Collection|Seat[] */
	public function getSeats(): Collection {
		return $this->seats;
	}

	public function addSeat(Seat $seat): void {
		if (!$this->seats->contains($seat)) {
			$this->seats[] = $seat;
			$seat->setPlane($this);
		}
	}

	public function removeSeat(Seat $seat): void {
		if ($this->seats->removeElement($seat)) {
			if ($seat->getPlane() === $this) {
				$seat->setPlane(null);
			}
		}
	}

	/** @return Collection|Flight[] */
	public function getFlights(): Collection {
		return $this->flights;
	}

	public function addFlight(Flight $flight): void {
		if (!$this->flights->contains($flight)) {
			$this->flights[] = $flight;
			$flight->setPlane($this);
		}
	}

	public function removeFlight(Flight $flight): void {
		if ($this->flights->removeElement($flight)) {
			if ($flight->getPlane() === $this) {
				$flight->setPlane(null);
			}
		}
	}
}
