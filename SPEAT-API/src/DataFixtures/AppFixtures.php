<?php

namespace App\DataFixtures;

use App\Entity\Adresse;
use App\Entity\Restaurant;
use App\Entity\Utilisateur;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private $hash;
    public function __construct(UserPasswordHasherInterface $hash)
    {
        $this->hash = $hash;
    }
    
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        $user1 = new Utilisateur();
        $user2 = new Utilisateur();
        $user3 = new Utilisateur();
        $user1
            ->setEmail('admin')
            ->setNom('admin')
            ->setPrenom('admin')
            ->setRoles(['ROLE_ADMIN'])
            ->setPassword($this->hash->hashPassword($user1, 'admin'));
        
        $manager->persist($user1);

        $user2
            ->setEmail('restaurateur')
            ->setNom('restaurateur')
            ->setPrenom('restaurateur')
            ->setRoles(['ROLE_USER'])
            ->setPassword($this->hash->hashPassword($user2, 'restaurateur'));
        
        $manager->persist($user2);

        $user3
            ->setEmail('john')
            ->setNom('john')
            ->setPrenom('john')
            ->setRoles(['ROLE_USER'])
            ->setPassword($this->hash->hashPassword($user3, 'john'));
        
        $manager->persist($user3);

        $restaurant1 = new Restaurant();
        $restaurant2 = new Restaurant();
        $adresse = new Adresse();
        $adresse
            ->setNom('10 rue de la Brasserie')
            ->setVille('Nancy')
            ->setCodePostal(45000);
        $manager->persist($adresse);

        $restaurant1
            ->setAdresse($adresse)
            ->setNom('McDonalds')
            ->setDescription('Macdo de Brasserie')
            ->addPersonnel($user2);
        
        $manager->persist($restaurant1);

        $restaurant2
            ->setAdresse($adresse)
            ->setNom('BurgerKing')
            ->setDescription('King de paris')
            ->addPersonnel($user3);
        
        $manager->persist($restaurant2);

        $manager->flush();
    }
}
