<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Status;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {
        // Catégories
        $categories = ['Incident', 'Panne', 'Évolution', 'Anomalie', 'Information'];
        foreach ($categories as $name) {
            $category = new Category();
            $category->setName($name);
            $manager->persist($category);
        }

        // Statuts
        $statuses = ['Nouveau', 'Ouvert', 'Résolu', 'Fermé'];
        foreach ($statuses as $name) {
            $status = new Status();
            $status->setName($name);
            $manager->persist($status);
        }

        // Administrateur
        $admin = new User();
        $admin->setEmail('admin@agence.com');
        $admin->setRoles(['ROLE_ADMIN']);
        $password = $this->hasher->hashPassword($admin, 'admin123');
        $admin->setPassword($password);
        $manager->persist($admin);

        $manager->flush();
    }
}
