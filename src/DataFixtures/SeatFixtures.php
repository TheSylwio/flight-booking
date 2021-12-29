<?php

namespace App\DataFixtures;

use App\Entity\Seat;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class SeatFixtures extends Fixture implements DependentFixtureInterface {
	public function load(ObjectManager $manager): void {
		for ($plane = 0; $plane < 20; $plane++) {
			for ($j = 0; $j < random_int(0, 179); $j++) {
				$seat = new Seat();
				$seat->setPlane($this->getReference(sprintf('plane_%d', $plane)));
				$seat->setOrderNumber($j);
				$manager->persist($seat);
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
