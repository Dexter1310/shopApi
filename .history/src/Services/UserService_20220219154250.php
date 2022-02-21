<?php

namespace App\Services;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;


class UserService
{
    private $passwordHasher;

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager,UserPasswordHasherInterface $passwordHasher)
    {
        $this->entityManager = $entityManager;
        $this->passwordHasher = $passwordHasher;
    }


    function actionUser($parameters)
    {
        $user = new User;
        if($parameters['id']){ //if EDIT user
            $user=$this->entityManager->getRepository(User::class)->findOneBy(['id'=>$parameters['id']]);
        }
       
        $user->setEmail($parameters['email']);
        $user->setName($parameters['nom']);
        $user->setLastname($parameters['lastName']);
        $user->setPassword($this->passwordHasher->hashPassword(
            $user,
            'dexter1310'
        ));
        $user->setRoles(User::R_USER);

        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }



    function findUser($user){

    $user=$this->entityManager->getRepository(User::class)->find($user);
        $token = new UsernamePasswordToken($user, $user->getEmail(), "main", $user->getRoles());
        dump($token);die();
        return  $user;

    
    }
}
