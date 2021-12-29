<?php

namespace App\DataFixtures;

use App\Entity\Plane;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PlaneFixtures extends Fixture {
	public const PREFIX = 'plane_';

	public function load(ObjectManager $manager): void {
		for ($i = 0; $i <= 20; $i++) {
			$plane = new Plane();
			$plane->setName(self::PREFIX . $i);

			$manager->persist($plane);
			$this->setReference(self::PREFIX . $i, $plane);
		}

		$manager->flush();
	}
}
