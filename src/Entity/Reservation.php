<?php

namespace App\Entity;

use DateTimeInterface;

class Reservation {
	public const STATUS_VALID = 'VALID';
	public const STATUS_CANCELED = 'CANCELED';
	public const STATUS_EXPIRED = 'EXPIRED';

	private ?int $id;
	private string $user;
	private string $status;
	private Flight $flight;
	private Seat $seat;
	private DateTimeInterface $datetime;

	public function getId(): ?int {
		return $this->id;
	}

	public function getUser(): string {
		return $this->user;
	}

	public function setUser(string $user): void {
		$this->user = $user;
	}

	public function getStatus(): string {
		return $this->status;
	}

	public function setStatus(string $status): void {
		$this->status = $status;
	}

	public function getFlight(): Flight {
		return $this->flight;
	}

	public function setFlight(Flight $flight): void {
		$this->flight = $flight;
	}

	public function getSeat(): Seat {
		return $this->seat;
	}

	public function setSeat(Seat $seat): void {
		$this->seat = $seat;
	}

	public function getDatetime(): DateTimeInterface {
		return $this->datetime;
	}

	public function setDatetime(DateTimeInterface $datetime): void {
		$this->datetime = $datetime;
	}
}
