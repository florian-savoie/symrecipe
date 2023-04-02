<?php

namespace App\DataFixtures;
use Faker\Factory;
use Faker\Generator;
use App\Entity\Ingredient;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    /**
     * @var Generator
     */
    private Generator $faker ;

    public function __construct(){
        $this->faker = Factory::create('fr_FR');
    }

    public function load(ObjectManager $manager): void
    {
        
        for($i = 0; $i < 50 ; $i++){
               $ingredient = new Ingredient();
         $ingredient->SetName($this->faker->word())
         ->SetPrice(mt_rand(0, 100));
         $manager->persist($ingredient); 

        }
      
        $manager->persist($ingredient); 
        $manager->flush();
    }
}