<?php

namespace App\DataFixtures;

use App\Entity\Reservation;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ReservationFixtures extends Fixture implements DependentFixtureInterface {
	public const PREFIX = 'reservation_';

	public function load(ObjectManager $manager) {
		$faker = Factory::create();

		for ($i = 0; $i <= 4000; $i++) {
			$reservation = new Reservation();
			$reservation->setFlight($this->getReference(FlightFixtures::PREFIX . random_int(0, 1000)));
			$reservation->setSeat($this->getReference(SeatFixtures::PREFIX . random_int(0, 20) . '|' . random_int(0, 9)));
			$reservation->setDatetime($faker->dateTimeBetween('-1 month'));
			$reservation->setStatus($faker->randomElement([
				Reservation::STATUS_CANCELED,
				Reservation::STATUS_EXPIRED,
				Reservation::STATUS_VALID,
			]));
			$reservation->setUser($faker->userName()); // FIXME: Temporary usage. Use User entity.

			$manager->persist($reservation);
			$this->setReference(self::PREFIX . $i, $reservation);
		}

		$manager->flush();
	}

	public function getDependencies(): array {
		return [
			FlightFixtures::class,
			SeatFixtures::class,
		];
	}
}