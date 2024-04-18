<?php

namespace App\Entity;

use App\Repository\AvisRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AvisRepository::class)]
class Avis
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $Avis_id = null;

    #[ORM\Column(length: 255)]
    private ?string $Pseudo = null;

    #[ORM\Column(type: 'text')]
    private ?string $Avis = null;

    #[ORM\Column]
    private ?bool $validation = false; // Définir la valeur par défaut à false

    public function __construct()
    {
        // Vous pouvez initialiser d'autres valeurs par défaut ici si nécessaire
    }

    public function getAvisId(): ?int
    {
        return $this->Avis_id;
    }

    // Pas besoin de setAvisId avec génération automatique de l'ID

    public function getPseudo(): ?string
    {
        return $this->Pseudo;
    }

    public function setPseudo(string $Pseudo): static
    {
        $this->Pseudo = $Pseudo;

        return $this;
    }

    public function getAvis(): ?string
    {
        return $this->Avis;
    }

    public function setAvis(string $Avis): static
    {
        $this->Avis = $Avis;

        return $this;
    }

    public function isValidation(): ?bool
    {
        return $this->validation;
    }

    public function setValidation(bool $validation): static
    {
        $this->validation = $validation;

        return $this;
    }
}
