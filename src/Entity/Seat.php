<?php

namespace App\Entity;

class Seat {
	private ?int $id;
	private ?int $orderNumber;
	private ?Plane $plane;

	public function getId(): ?int {
		return $this->id;
	}

	public function getOrderNumber(): ?int {
		return $this->orderNumber;
	}

	public function setOrderNumber(int $orderNumber): self {
		$this->orderNumber = $orderNumber;

		return $this;
	}

	public function getPlane(): ?Plane {
		return $this->plane;
	}

	public function setPlane(?Plane $plane): self {
		$this->plane = $plane;

		return $this;
	}
}
