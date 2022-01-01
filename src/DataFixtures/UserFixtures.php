<?php


namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\PasswordHasherInterface;

class UserFixtures extends Fixture
{
    private $passwordHasher;

    public function __construct(PasswordHasherInterface $passwordHasher){
        $this->passwordHasher = $passwordHasher;
    }
    public function load(ObjectManager $manager): void{
        for ($user = 0; $user <= 15; $user++) {
            $user = new User();
            $user->setFirstname($this->generateRandomString(12));
            $user->setLastname($this->generateRandomString());
            $user->setEmail($this->generateEmailAddress());
            $user->setPassword($this->passwordHasher->hash($this->generateRandomString(20)));
            $manager->persist($user);
        }
        $manager->flush();
    }

    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function generateEmailAddress($maxLenLocal=64, $maxLenDomain=255){
        $numeric        =  '0123456789';
        $alphabetic     = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        $extras         = '.-_';
        $all            = $numeric . $alphabetic . $extras;
        $alphaNumeric   = $alphabetic . $numeric;
        $alphaNumericP  = $alphabetic . $numeric . "-";
        $randomString   = '';

        // GENERATE 1ST 4 CHARACTERS OF THE LOCAL-PART
        for ($i = 0; $i < 4; $i++) {
            $randomString .= $alphabetic[rand(0, strlen($alphabetic) - 1)];
        }
        // GENERATE A NUMBER BETWEEN 20 & 60
        $rndNum         = rand(20, $maxLenLocal-4);

        for ($i = 0; $i < $rndNum; $i++) {
            $randomString .= $all[rand(0, strlen($all) - 1)];
        }

        // ADD AN @ SYMBOL...
        $randomString .= "@";

        // GENERATE DOMAIN NAME - INITIAL 3 CHARS:
        for ($i = 0; $i < 3; $i++) {
            $randomString .= $alphabetic[rand(0, strlen($alphabetic) - 1)];
        }

        // GENERATE A NUMBER BETWEEN 15 & $maxLenDomain-7
        $rndNum2        = rand(15, $maxLenDomain-7);
        for ($i = 0; $i < $rndNum2; $i++) {
            $randomString .= $all[rand(0, strlen($all) - 1)];
        }
        // ADD AN DOT . SYMBOL...
        $randomString .= ".";

        // GENERATE TLD: 4
        for ($i = 0; $i < 4; $i++) {
            $randomString .= $alphaNumeric[rand(0, strlen($alphaNumeric) - 1)];
        }

        return $randomString;
    }
}