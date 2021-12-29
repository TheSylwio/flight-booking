<?php

namespace App\Entity;

use DateTimeInterface;

class Reservation {
	private ?int $id;
	private ?string $user;
	private ?Flight $flight;
	private ?DateTimeInterface $datetime;

	public function getId(): ?int {
		return $this->id;
	}

	public function getUser(): ?string {
		return $this->user;
	}

	public function setUser(string $user): void {
		$this->user = $user;
	}
	
	public function getFlight(): ?Flight {
		return $this->flight;
	}

	public function setFlight(?Flight $flight): void {
		$this->flight = $flight;
	}

	public function getDatetime(): ?DateTimeInterface {
		return $this->datetime;
	}

	public function setDatetime(?DateTimeInterface $datetime): void {
		$this->datetime = $datetime;
	}
}
