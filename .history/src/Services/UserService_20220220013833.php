<?php

namespace App\Services;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;


class UserService
{
    private $passwordHasher;

    private $entityManager;

    private $encoder;

    public function __construct(EntityManagerInterface $entityManager,
     UserPasswordHasherInterface $passwordHasher,UserPasswordEncoderInterface)
    {
        $this->entityManager = $entityManager;
        $this->passwordHasher = $passwordHasher;
        $this->encoder= $encoder;
    }


    function actionUser($parameters)
    {
      
        $user = new User;
        if ($parameters['id']) { //if EDIT user
            $user = $this->entityManager->getRepository(User::class)->findOneBy(['id' => $parameters['id']]);
        }

        $user->setEmail($parameters['email']);
        $user->setName($parameters['nom']);
        $user->setLastname($parameters['lastName']);
        // $user->setToken($data->get('user')['_token']);
        $user->setToken('xxx');
        $user->setPassword($this->passwordHasher->hashPassword(
            $user,
            'dexter1310'
        ));
        $user->setRoles(User::R_USER);

        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }



    function findUser($user)
    {

        $us = $this->entityManager->getRepository(User::class)->find($user);

        return  $us;
    }
}
