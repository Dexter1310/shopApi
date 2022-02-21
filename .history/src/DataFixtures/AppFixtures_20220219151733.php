<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }
    public function load(ObjectManager $manager): void
    {

        //Added SUPER_ADMIN User FOR ALL CONTROL
        $userSuperAdmin = new User();
        // $userSuperAdmin->setName("Javier");
        $userSuperAdmin->setRoles(User::R_USER);
        $userSuperAdmin->setName('Iris');
        $userSuperAdmin->setLastname('Ortí');
        $user->setToken('xxx');
        // $userSuperAdmin->setActive(1);
        // $userSuperAdmin->setToken('xxx');
        // $userSuperAdmin->setType("super");
        $userSuperAdmin->setEmail("insorti@gmail.com");
        $userSuperAdmin->setPassword($this->passwordHasher->hashPassword(
            $userSuperAdmin,
            'dexter1310'
        ));


        //Added SUPER_ADMIN User FOR ALL CONTROL
        $user = new User();
        // $userSuperAdmin->setName("Javier");
        $user->setRoles(User::R_USER);
        $user->setName('javier');
        $user->setLastname('Perez');
        // $userSuperAdmin->setActive(1);
        // $userSuperAdmin->setToken('xxx');
        // $userSuperAdmin->setType("super");
        $user->setEmail("javier@gmail.com");
        $user->setPassword($this->passwordHasher->hashPassword(
            $user,
            'dexter1310'
        ));
        $manager->persist($user);
        $manager->persist($userSuperAdmin);
        $manager->flush();
    }
}
