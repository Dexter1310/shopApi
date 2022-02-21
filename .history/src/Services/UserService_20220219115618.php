<?php

namespace App\Services;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class UserService
{
    private $passwordHasher;

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager,UserPasswordHasherInterface $passwordHasher)
    {
        $this->entityManager = $entityManager;
        $this->passwordHasher = $passwordHasher;
    }


    // function addUser($parameters)
    // {
    //     $user = new User;
    //     $user->setEmail($parameters['email']);
    //     $user->setName($parameters['nom']);
    //     $user->setLastname($parameters['lastName']);
    //     $user->setPassword($this->passwordHasher->hashPassword(
    //         $user,
    //         'dexter1310'
    //     ));
    //     $user->setRoles(User::R_USER);

    //     $this->entityManager->persist($user);
    //     $this->entityManager->flush();
    // }

    function actionUser($parameters)
    {

        if($parameters['id']){
            $user=$this->entityManager->getRepository(User::class)->findBy(['id'=>$parameters['id']]);
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

        // dump($parameters);die();
       
        // $user->setEmail($parameters['email']);

    }



    function findUser($user)
    {
        return  $this->entityManager->getRepository(User::class)->find($user);
    
    }
}
