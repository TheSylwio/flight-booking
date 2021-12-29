<?php

namespace App\DataFixtures;

use App\Entity\Plane;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PlaneFixtures extends Fixture {
	public function load(ObjectManager $manager): void {
		for ($i = 0; $i < 20; $i++) {
			$plane = new Plane();
			$plane->setName(sprintf('Plane_%d', $i));
			$manager->persist($plane);
			$this->setReference(sprintf('plane_%d', $i), $plane);
		}

		$manager->flush();
	}
}
