<?php

namespace App\Entity;

use App\Repository\HorraireZooRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HorraireZooRepository::class)]
class HorraireZoo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private $id;

    #[ORM\Column(type: "string", length: 70)]
    private $jour;

    #[ORM\Column(type: "string", length: 70)]
    private $heureOuverture;

    #[ORM\Column(type: "string", length: 70)]
    private $heureFermeture;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getJour(): ?string
    {
        return $this->jour;
    }

    public function setJour(string $jour): self
    {
        $this->jour = $jour;

        return $this;
    }

    public function getHeureOuverture(): ?string
    {
        return $this->heureOuverture;
    }

    public function setHeureOuverture(string $heureOuverture): self
    {
        $this->heureOuverture = $heureOuverture;

        return $this;
    }

    public function getHeureFermeture(): ?string
    {
        return $this->heureFermeture;
    }

    public function setHeureFermeture(string $heureFermeture): self
    {
        $this->heureFermeture = $heureFermeture;

        return $this;
    }
}
