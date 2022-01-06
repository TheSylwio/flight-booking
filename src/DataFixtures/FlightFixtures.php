<?php

namespace App\DataFixtures;

use App\Entity\Flight;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class FlightFixtures extends Fixture implements DependentFixtureInterface {
	public const PREFIX = 'flight_';

	public function load(ObjectManager $manager) {
		$faker = Factory::create();

		for ($i = 0; $i <= 1000; $i++) {
			$flight = new Flight();
			$flight->setDepartureAirport($this->getReference(AirportFixtures::PREFIX . random_int(0, 4)));
			$flight->setArrivalAirport($this->getReference(AirportFixtures::PREFIX . random_int(0, 4)));
			$flight->setPlane($this->getReference(PlaneFixtures::PREFIX . random_int(0, 20)));
			$flight->setDepartureDatetime($faker->dateTimeBetween('+1 week', $endDate = '+3 months'));

			$manager->persist($flight);
			$this->setReference(self::PREFIX . $i, $flight);
		}

		$manager->flush();
	}

	public function getDependencies(): array {
		return [
			AirportFixtures::class,
			PlaneFixtures::class,
		];
	}
}