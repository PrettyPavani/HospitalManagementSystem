<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setEmail('admin@gmail.com');
        $user->setFirstname('admin');
        $user->setLastname('admin');
        $user->setBloodgroup('O+');
        $user->setPhone(9878653421);
        $user->setAge(23);
        $password = $this->hasher->hashPassword($user, 'adminadmin');
        $user->setPassword($password);
        $user->setRoles(array('ROLE_ADMIN'));
        $manager->persist($user);

        $user2 = new User();
        $user2->setEmail('pavani@gmail.com');
        $user2->setFirstname('pavani');
        $user2->setLastname('pavani');
        $user2->setBloodgroup('A+');
        $user2->setPhone(9842178653);
        $user2->setAge(23);
        $password = $this->hasher->hashPassword($user2, 'pavani');
        $user2->setPassword($password);
        $user2->setRoles(array('ROLE_USER'));
        $manager->persist($user2);
        $manager->flush();
    }
}

  
