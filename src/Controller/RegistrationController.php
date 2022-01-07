<?php


namespace App\Controller;


use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[AsController]
class RegistrationController extends AbstractController
{
    public function __invoke($data, UserPasswordHasherInterface $passwordHasher)
    {
        $user = $data;
        $em = $this->container->get('doctrine')->getManager();
        $hashedPassword = $passwordHasher->hashPassword(
            $user,
            $data
        );
        $user->setPassword($hashedPassword);
        $em->persist($user);
        $validator = $this->container->get('validator');
        $errors = $validator->validate($user);
        if (count($errors) > 0) {
            return $data;
        } else {
            $em->flush();
            $jwtManager = $this->container->get('lexik_jwt_authentication.jwt_manager');
            return new JsonResponse(['token' => $jwtManager->create($user)]);
        }
    }

}