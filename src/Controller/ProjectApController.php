<?php

namespace App\Controller;

use App\Entity\Project;
use App\Repository\ProjectRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/projectAp', name: 'projectAp_')]
class ProjectApController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(ProjectRepository $projectRepository): Response
    {
        $projects = $projectRepository->findAllUpcomingProjects();
        return $this->render('projectAp/index.html.twig', [
            'projects' => $projects,
        ]);
    }

    #[Route('/{slug}', methods: ['GET'], name: 'show')]
    public function show(Project $project): Response
    {
        return $this->render('projectAp/show.html.twig', [
            'project' => $project,
        ]);
    }
}
