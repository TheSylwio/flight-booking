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
	private Collection $departureFlights;
	private Collection $arrivalFlights;

	public function __construct() {
		$this->departureFlights = new ArrayCollection();
		$this->arrivalFlights = new ArrayCollection();
	}

	public function getId(): ?int {
		return $this->id;
	}

	public function getCountry(): ?string {
		return $this->country;
	}

	public function setCountry(string $country): void {
		$this->country = $country;
	}

	public function getName(): ?string {
		return $this->name;
	}

	public function setName(string $name): void {
		$this->name = $name;
	}

	public function getLatitude(): ?float {
		return $this->latitude;
	}

	public function setLatitude(float $latitude): void {
		$this->latitude = $latitude;
	}

	public function getLongitude(): ?float {
		return $this->longitude;
	}

	public function setLongitude(float $longitude): void {
		$this->longitude = $longitude;
	}

	/** @return Collection|Flight[] */
	public function getDepartureFlights(): Collection {
		return $this->departureFlights;
	}

	public function addDepartureFlight(Flight $departureFlight): void {
		if (!$this->departureFlights->contains($departureFlight)) {
			$this->departureFlights[] = $departureFlight;
			$departureFlight->setDepartureAirport($this);
		}
	}

	public function removeDepartureFlight(Flight $departureFlight): void {
		if ($this->departureFlights->removeElement($departureFlight)) {
			if ($departureFlight->getDepartureAirport() === $this) {
				$departureFlight->setDepartureAirport(null);
			}
		}
	}

	/** @return Collection|Flight[] */
	public function getArrivalFlights(): Collection {
		return $this->arrivalFlights;
	}

	public function addArrivalFlight(Flight $arrivalFlight): void {
		if (!$this->arrivalFlights->contains($arrivalFlight)) {
			$this->arrivalFlights[] = $arrivalFlight;
			$arrivalFlight->setArrivalAirport($this);
		}
	}

	public function removeArrivalReservation(Flight $arrivalFlight): void {
		if ($this->arrivalFlights->removeElement($arrivalFlight)) {
			if ($arrivalFlight->getArrivalAirport() === $this) {
				$arrivalFlight->setArrivalAirport(null);
			}
		}
	}
}
