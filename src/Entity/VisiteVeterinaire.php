<?php

namespace App\Entity;

use App\Repository\VisiteVeterinaireRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VisiteVeterinaireRepository::class)]
class VisiteVeterinaire
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "AUTO")]
    #[ORM\Column]
    private ?int $visite_id = null;

    #[ORM\ManyToOne(targetEntity: Animal::class)]
    #[ORM\JoinColumn(name: "animal_id", referencedColumnName: "animal_id")]
    private ?Animal $animal = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $etat_animal = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nourriture_proposee = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $grammage_nourriture = null;

    #[ORM\Column(type: 'date', nullable: true)]
    private ?\DateTimeInterface $date_passage = null;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $detail_etat_animal = null;

    #[ORM\Column(length: 255)]
    private ?string $Nom_veterinaire = null;

    public function getVisiteId(): ?int
    {
        return $this->visite_id;
    }

    public function getNomVeterinaire(): ?string
    {
        return $this->Nom_veterinaire;
    }

    public function setNomVeterinaire(string $Nom_veterinaire): static
    {
        $this->Nom_veterinaire = $Nom_veterinaire;

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

    public function getEtatAnimal(): ?string
    {
        return $this->etat_animal;
    }

    public function setEtatAnimal(?string $etat_animal): static
    {
        $this->etat_animal = $etat_animal;

        return $this;
    }

    public function getNourritureProposee(): ?string
    {
        return $this->nourriture_proposee;
    }

    public function setNourritureProposee(?string $nourriture_proposee): static
    {
        $this->nourriture_proposee = $nourriture_proposee;

        return $this;
    }

    public function getGrammageNourriture(): ?string
    {
        return $this->grammage_nourriture;
    }

    public function setGrammageNourriture(?string $grammage_nourriture): static
    {
        $this->grammage_nourriture = $grammage_nourriture;

        return $this;
    }

    public function getDatePassage(): ?\DateTimeInterface
    {
        return $this->date_passage;
    }

    public function setDatePassage(?\DateTimeInterface $date_passage): static
    {
        $this->date_passage = $date_passage;

        return $this;
    }

    public function getDetailEtatAnimal(): ?string
    {
        return $this->detail_etat_animal;
    }

    public function setDetailEtatAnimal(?string $detail_etat_animal): static
    {
        $this->detail_etat_animal = $detail_etat_animal;

        return $this;
    }
}
