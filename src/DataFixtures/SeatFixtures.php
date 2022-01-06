<?php

namespace App\DataFixtures;

use App\Entity\Seat;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class SeatFixtures extends Fixture implements DependentFixtureInterface {
	public const PREFIX = 'seat_';

	public function load(ObjectManager $manager): void {
		for ($plane = 0; $plane <= 20; $plane++) {
			for ($j = 0; $j < random_int(10, 179); $j++) {
				$seat = new Seat();
				$seat->setPlane($this->getReference(PlaneFixtures::PREFIX . $plane));
				$seat->setOrderNumber($j);
				$manager->persist($seat);
				$this->setReference(self::PREFIX . $plane . '|' . $j, $seat);
			}
		}

		$manager->flush();
	}

	public function getDependencies(): array {
		return [
			PlaneFixtures::class,
		];
	}
}
