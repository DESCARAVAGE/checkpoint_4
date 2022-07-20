<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
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

    #[ORM\ManyToOne(targetEntity: Projects::class, inversedBy: 'category')]
    private Projects $projects;

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

    public function getProjects(): ?Projects
    {
        return $this->projects;
    }

    public function setProjects(?Projects $projects): self
    {
        $this->projects = $projects;

        return $this;
    }
}
