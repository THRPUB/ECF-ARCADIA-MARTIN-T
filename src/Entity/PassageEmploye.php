<?php

namespace App\Entity;

use App\Repository\PassageEmployeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PassageEmployeRepository::class)]
class PassageEmploye
{
    #[ORM\Id]
    #[ORM\GeneratedValue]

    #[ORM\Column]
    private ?int $Passage_id = null;

    #[ORM\ManyToOne(targetEntity: Animal::class)]
    #[ORM\JoinColumn(name: "animal_id", referencedColumnName: "animal_id")]
    private ?Animal $animal = null;

    #[ORM\Column(length: 255)]
    private ?string $Nourriture_apportee = null;

    #[ORM\Column(length: 255)]
    private ?string $Grammage_de_la_nourriture = null;

    #[ORM\Column(length: 255)]
    private ?string $Date_de_passage = null;

    #[ORM\Column(length: 255)]
    private ?string $Heure_de_passage = null;

    public function getPassageId(): ?int
    {
        return $this->Passage_id;
    }

    public function setPassageId(int $Passage_id): static
    {
        $this->Passage_id = $Passage_id;

        return $this;
    }

    public function getNourritureApportee(): ?string
    {
        return $this->Nourriture_apportee;
    }

    public function setNourritureApportee(string $Nourriture_apportee): static
    {
        $this->Nourriture_apportee = $Nourriture_apportee;

        return $this;
    }

    public function getAnimal(): ?Animal
    {
        return $this->animal;
    }

    public function setAnimal(?Animal $animal): static
    {
        $this->animal = $animal;

        return $this;
    }

    public function getGrammageDeLaNourriture(): ?string
    {
        return $this->Grammage_de_la_nourriture;
    }

    public function setGrammageDeLaNourriture(string $Grammage_de_la_nourriture): static
    {
        $this->Grammage_de_la_nourriture = $Grammage_de_la_nourriture;

        return $this;
    }

    public function getDateDePassage(): ?string
    {
        return $this->Date_de_passage;
    }

    public function setDateDePassage(string $Date_de_passage): static
    {
        $this->Date_de_passage = $Date_de_passage;

        return $this;
    }

    public function getHeureDePassage(): ?string
    {
        return $this->Heure_de_passage;
    }

    public function setHeureDePassage(string $Heure_de_passage): static
    {
        $this->Heure_de_passage = $Heure_de_passage;

        return $this;
    }
}
