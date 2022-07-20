<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class CategoryFixtures extends Fixture
{
    public const VALUE = 2;
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        for ($i = 0; $i < self::VALUE; $i++) {
            $category = new Category();
            $category->setName($faker->words(2, true));
            $category->setCatchPhrase($faker->words(5, true));
            $manager->persist($category);
        }
        $manager->flush();
    }
}
