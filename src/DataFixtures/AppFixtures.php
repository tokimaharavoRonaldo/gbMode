<?php

namespace App\DataFixtures;

use App\Entity\Apropos;
use App\Entity\Categorie;
use App\Entity\Vetement;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        //utilisation de faker
        $faker=Factory::create('fr_FR');


        $apropos= new Apropos();
        $apropos->setTitre($faker->words(3,true))
        ->setDescription($faker->words(3,true))
        ->setContact('03456869')
        ->setEmail('gb@yahoo.com')
        ->setFile('/image/bg-banner.jpg')
        ->setLogo('/image/bg-banner.jpg')
        ->setFacebook('https://facebook.com');
        $manager->persist($apropos);

        // $product = new Product();
        // $manager->persist($product);
        for ($k=0;$k<5;$k++){
        $categories= new Categorie();
        $categories->setNom($faker->words(3,true))
        ->setDescription($faker->words(3,true))
        ->setSlug($faker->slug());
        $manager->persist($categories);

        for ($i=0;$i<10;$i++){
        $produits= new Vetement();
        $produits->setNom($faker->words(3,true))
        ->setDescription($faker->words(3,true))
        ->setPrix($faker->randomFloat(2,20,60))
        ->setTaille($faker->words(3,true))
        ->setFile('bg-banner.jpg')
        ->setSlug($faker->slug())
        ->setCategorie($categories)
        ->setDispo($faker->randomElement([true,false]));
        $manager->persist($produits);
        }

       
    }
    //categorie de test
    $categories= new Categorie();
    $categories->setNom($faker->words(3,true))
    ->setDescription($faker->words(3,true))
    ->setSlug($faker->slug());
    $manager->persist($categories);

     //produit de test
     $produits= new Vetement();
     $produits->setNom('Vetement test')
     ->setDescription($faker->words(3,true))
     ->setPrix($faker->randomFloat(2,20,60))
     ->setTaille($faker->words(3,true))
     ->setFile('bg-banner.jpg')
     ->setSlug('vetement_test')
     ->setCategorie($categories)
     ->setDispo($faker->randomElement([true,false]));
     $manager->persist($produits);

        $manager->flush();
    }
}
