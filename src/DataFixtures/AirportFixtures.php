<?php

namespace App\DataFixtures;

use App\Entity\Airport;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AirportFixtures extends Fixture {
	public const PREFIX = 'airport_';

	public function load(ObjectManager $manager): void {
		$faker = Factory::create();

		for ($i = 0; $i <= 4; $i++) {
			$airport = new Airport();

			$airport->setName($faker->city());
			$airport->setCountry($faker->countryISOAlpha3());
			$airport->setLatitude($faker->latitude());
			$airport->setLongitude($faker->longitude());

			$manager->persist($airport);
			$this->setReference(self::PREFIX . $i, $airport);
		}

		$manager->flush();
	}
}
