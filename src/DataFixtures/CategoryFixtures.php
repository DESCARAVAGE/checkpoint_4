<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public const CATEGORIES = [
        [
            'name' => 'Avant La WCS',
            'catchPhrase' => 'Découvrir mes projets avant la Wild',
            'link' => '/projectAv'
        ],
        [
            'name' => 'Après la WCS',
            'catchPhrase' => 'Mes projets en tant de développeur',
            'link' => '/projectAp'
        ],
        ];
        
    public function load(ObjectManager $manager): void
    {
        foreach (self::CATEGORIES as $categoryItems) {
            $category = new Category();
            $category->setName($categoryItems['name']);
            $category->setCatchPhrase($categoryItems['catchPhrase']);
            $category->setLink($categoryItems['link']);
            $manager->persist($category);
        }
        $manager->flush();
    }
}
