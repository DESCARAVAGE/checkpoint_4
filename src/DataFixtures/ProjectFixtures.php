<?php

namespace App\DataFixtures;

use App\Entity\Category;
use DateTime;
use Faker\Factory;
use App\Entity\Project;
use App\Service\Slugify;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ProjectFixtures extends Fixture implements DependentFixtureInterface
{
    public const PROJECTS = [
        [
            'category' => 1,
            'title' => 'Recherches',
            'description' => 'Après avoir démissionné je ne savais pas quel métier je voulais effectuer, je me suis mis à faire mes recherches sur ma future voix',
            'url' => 'Pas d\'url disponible',
            'catchPhrase' => 'L\'après restauration',
        ],
        [
            'category' => 1,
            'title' => 'WordPress',
            'description' => 'Je suis un créatif, partir de zéro pour arriver à quelque chose me motive et faire des sites est essentiel pour les entreprises aujourd\'hui mais la programmation me fait peur ...',
            'url' => 'https://www.coach1rocketeur.com/',
            'catchPhrase' => 'Réaliser sans coder ?',
        ],
        [
            'category' => 1,
            'title' => 'Basics HTML et CSS',
            'description' => 'Suite à ma formation je n\ai pas apprécier le fait de créer un site avec wordpress on est assez vite limité, je décide donc d\'apprendre les bases de la programmation',
            'url' => 'https://www.codecademy.com/',
            'catchPhrase' => 'Les bases des bases',
        ],
        [
            'category' => 1,
            'title' => 'Formation',
            'description' => 'J\'ai trouver le domaine !!! Il ne me reste plus de trouver une formation diplomante et c\'est parti !!!',
            'url' => 'Pas d\'url disponible',
            'catchPhrase' => 'Découverte de la WCS',
        ],
        [
            'category' => 2,
            'title' => 'Monkey D Luffy',
            'description' => 'Mise en application des bases HMTL et CSS sur un projet fictif pour le future roi des pirates',
            'url' => 'https://github.com/VanTej/fcvd-project',
            'catchPhrase' => 'Le roi des pirates recrute',
        ],
        [
            'category' => 2,
            'title' => 'Tissus JAurès',
            'description' => '2 ème project fictif et commence à rentrer dans le dure, manipulation de base de donnée',
            'url' => 'https://github.com/WildCodeSchool/2022-03-php-orleans-project-tissusjaures',
            'catchPhrase' => 'Des tissus et encore des tissus',
        ],
        [
            'category' => 2,
            'title' => 'Hackthon 1',
            'description' => 'Il faut aller vite et bien, place au hackathon !!!',
            'url' => 'https://github.com/DangirasH/HacathonBomb',
            'catchPhrase' => '24h ?!',
        ],
        [
            'category' => 2,
            'title' => 'Splite Screen',
            'description' => 'Premier projet client pour une association de jeu vidéo orléannaise, ça commence à devenir sérieux. Découverte de Symphony',
            'url' => 'https://github.com/WildCodeSchool/2022-03-php-orleans-project-splitscreen',
            'catchPhrase' => 'Symphony ',
        ],
        [
            'category' => 2,
            'title' => 'Hackathon 2',
            'description' => 'Deuxième hackathon mais cest européen cette fois !!!',
            'url' => 'https://github.com/DESCARAVAGE/devinity',
            'catchPhrase' => '48h ?!?!',
        ],
        ];


    private Slugify $slugify;
    public function __construct(Slugify $slugify)
    {
        $this->slugify = $slugify;
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        foreach (self::PROJECTS as $projectsItems) {
            $project = new Project();
            $categoryName = array_rand(CategoryFixtures::CATEGORIES); 
            $project->setCategory($this->getReference('category_' . $categoryName));
            $project->setTitle($projectsItems['title']);
            $project->setDescription($projectsItems['description']);
            $project->setCatchPhrase($projectsItems['catchPhrase']);
            $project->setUrl($projectsItems['url']);
            $project->setDate($faker->dateTime());
            $project->setSlug($this->slugify->generate($project->getTitle()));
            // $imageName = 'project' . $i . '.jpg';
            // copy('src/DataFixtures/project.jpg', 'public/uploads/project/' . $imageName);
            // $project->setImage($imageName);
            // $this->addReference('project' . $i, $project);
            $manager->persist($project);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            CategoryFixtures::class,
        ];
    }
}
