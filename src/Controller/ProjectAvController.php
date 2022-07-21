<?php

namespace App\Controller;

use App\Entity\Project;
use App\Repository\ProjectRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProjectAvController extends AbstractController
{
    #[Route('/projectAv', name: 'projectAv_')]
    public function index(ProjectRepository $projectRepository, DateTime $dateTime): Response
    {
        $projects = $projectRepository->findAllPastEvents($dateTime);
        return $this->render('projectAv/index.html.twig', [
           'projects' => $projects,
        ]);
    }

    #[Route('/{slug}', methods: ['GET'], name: 'show')]
    public function show(Project $project): Response
    {
        return $this->render('projectAv/show.html.twig', [
            'project' => $project,
        ]);
    }
}
