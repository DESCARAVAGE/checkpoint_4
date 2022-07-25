<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank(
        message: 'Ce champ ne peut pas être vide',
        groups: ['add', 'default'],
    )]
    #[Assert\Length(
        max: 255,
        maxMessage: 'Le titre ne doit pas dépasser {{ limit }} caractères',
        groups: ['add', 'default'],
    )]
    private string $name;

    #[ORM\Column(
        type: 'string',
        length: 80,
    )]
    #[Assert\Length(
        max: 80,
        maxMessage: 'La phrase d\'accroche ne doit pas dépasser {{ limit }} caractères',
        groups: ['add', 'default'],
    )]
    private string $catchPhrase;

    #[ORM\OneToMany(targetEntity: Project::class, mappedBy: 'project')]
    private Collection $project;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private string $link;

    public function __construct()
    {
        $this->project = new ArrayCollection();
    }
    public function getProjects(): Collection
    {
        return $this->project;
    }
    public function addProject(Project $project): self
    {
        if (!$this->project->contains($project)) {
            $this->project[] = $project;
            $project->setCategory($this);
        }
        return $this;
    }
    public function removeProgram(Project $project): self
    {
        if ($this->projects->removeElement($project)) {
            // set the owning side to null (unless already changed)
            if ($project->getCategory() === $this) {
                $project->setCategory(null);
            }
        }
        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCatchPhrase(): ?string
    {
        return $this->catchPhrase;
    }

    public function setCatchPhrase(string $catchPhrase): self
    {
        $this->catchPhrase = $catchPhrase;

        return $this;
    }

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(string $link): self
    {
        $this->link = $link;

        return $this;
    }
}
