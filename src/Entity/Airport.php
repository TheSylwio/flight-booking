<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Airport {
	private ?int $id;
	private ?string $country;
	private ?string $name;
	private ?float $latitude;
	private ?float $longitude;
	private ArrayCollection $departureReservations;
	private ArrayCollection $arrivalReservations;

	public function __construct() {
		$this->departureReservations = new ArrayCollection();
		$this->arrivalReservations = new ArrayCollection();
	}

	public function getId(): ?int {
		return $this->id;
	}

	public function getCountry(): ?string {
		return $this->country;
	}

	public function setCountry(string $country): self {
		$this->country = $country;

		return $this;
	}

	public function getName(): ?string {
		return $this->name;
	}

	public function setName(string $name): self {
		$this->name = $name;

		return $this;
	}

	public function getLatitude(): ?float {
		return $this->latitude;
	}

	public function setLatitude(float $latitude): self {
		$this->latitude = $latitude;

		return $this;
	}

	public function getLongitude(): ?float {
		return $this->longitude;
	}

	public function setLongitude(float $longitude): self {
		$this->longitude = $longitude;

		return $this;
	}

	/**
	 * @return Collection|Reservation[]
	 */
	public function getDepartureReservations(): Collection {
		return $this->departureReservations;
	}

	public function addDepartureReservation(Reservation $departureReservation): self {
		if (!$this->departureReservations->contains($departureReservation)) {
			$this->departureReservations[] = $departureReservation;
			$departureReservation->setDepartureAirport($this);
		}

		return $this;
	}

	public function removeDepartureReservation(Reservation $departureReservation): self {
		if ($this->departureReservations->removeElement($departureReservation)) {
			// set the owning side to null (unless already changed)
			if ($departureReservation->getDepartureAirport() === $this) {
				$departureReservation->setDepartureAirport(null);
			}
		}

		return $this;
	}

	/**
	 * @return Collection|Reservation[]
	 */
	public function getArrivalReservations(): Collection {
		return $this->arrivalReservations;
	}

	public function addArrivalReservation(Reservation $arrivalReservation): self {
		if (!$this->arrivalReservations->contains($arrivalReservation)) {
			$this->arrivalReservations[] = $arrivalReservation;
			$arrivalReservation->setArrivalAirport($this);
		}

		return $this;
	}

	public function removeArrivalReservation(Reservation $arrivalReservation): self {
		if ($this->arrivalReservations->removeElement($arrivalReservation)) {
			// set the owning side to null (unless already changed)
			if ($arrivalReservation->getArrivalAirport() === $this) {
				$arrivalReservation->setArrivalAirport(null);
			}
		}

		return $this;
	}
}
