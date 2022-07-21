<?php

namespace App\DataFixtures;

use DateTime;
use Faker\Factory;
use App\Entity\Project;
use App\Services\Slugify;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ProjectFixtures extends Fixture
{
    private Slugify $slugify;
    public function __construct(Slugify $slugify)
    {
        $this->slugify = $slugify;
    }

    public const VALUE = 6;
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i = 0; $i <= self::VALUE; $i++) {
            $project = new Project();
            $project->setTitle($faker->words(2, true));
            $project->setDate($faker->dateTime());
            // $project->setImage('clash-royale-esport-min.jpg');
            $project->setDescription($faker->sentence(50));
            $project->setSlug($this->slugify->generate($project->getTitle()));
            // $imageName = 'project' . $i . '.jpg';
            // copy('src/DataFixtures/project.jpg', 'public/uploads/project/' . $imageName);
            // $project->setImage($imageName);
            // $this->addReference('project' . $i, $project);
            $manager->persist($project);
        }
        $manager->flush();
    }
}
