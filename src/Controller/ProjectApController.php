<?php

namespace App\Controller;

use App\Entity\Project;
use App\Repository\ProjectRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProjectApController extends AbstractController
{
    #[Route('/projectAp', name: 'projectAp_')]
    public function index(ProjectRepository $projectRepository): Response
    {
        $projects = $projectRepository->findAllUpcomingProjects();
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
