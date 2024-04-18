<?php

namespace App\Entity;

use App\Repository\AvisHabitatsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AvisHabitatsRepository::class)]
class AvisHabitats
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nomveterinaire = null;

    #[ORM\Column(length: 255)]
    private ?string $nomhabitat = null;

    #[ORM\Column(length: 255)]
    private ?string $avis = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomveterinaire(): ?string
    {
        return $this->nomveterinaire;
    }

    public function setNomveterinaire(string $nomveterinaire): static
    {
        $this->nomveterinaire = $nomveterinaire;

        return $this;
    }

    public function getNomhabitat(): ?string
    {
        return $this->nomhabitat;
    }

    public function setNomhabitat(string $nomhabitat): static
    {
        $this->nomhabitat = $nomhabitat;

        return $this;
    }

    public function getAvis(): ?string
    {
        return $this->avis;
    }

    public function setAvis(string $avis): static
    {
        $this->avis = $avis;

        return $this;
    }
}
