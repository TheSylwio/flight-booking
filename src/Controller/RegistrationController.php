<?php


namespace App\Controller;


use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RegistrationController extends AbstractController
{
    public function create(Request $request, UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $em, UserRepository $userRepository): JsonResponse
    {
        $data = json_decode($request->getContent());

        try{
            $user = new User();

            $userWithEmail = $userRepository->findBy(['email' => $data->email]);
            if ($userWithEmail) {
                return $this->json('User with this email already exists!', Response::HTTP_BAD_REQUEST);
            }
            $user->setEmail($data->email);
            $user->setFirstname($data->firstname);
            $user->setLastname($data->lastname);
            $user->setRoles('');
            $hashedPassword = $passwordHasher->hashPassword(
                $user,
                $data->password
            );
            $user->setPassword($hashedPassword);

            $em->persist($user);
            $em->flush();
        }catch(\Exception $e){
            return $this->json('Couldnt create user', Response::HTTP_BAD_REQUEST);
        }

        return $this->json('Created user successfully', Response::HTTP_CREATED);
    }
}