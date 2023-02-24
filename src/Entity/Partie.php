<?php

namespace App\Entity;

use App\Repository\PartieRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PartieRepository::class)]
class Partie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\ManyToOne(inversedBy: 'parties')]
    private ?Etape $etape = null;

    #[ORM\Column]
    private ?int $endurance = null;

    #[ORM\ManyToOne(inversedBy: 'parties')]
    private ?Aventure $aventure = null;

    #[ORM\ManyToOne(inversedBy: 'parties')]
    private ?Personnage $personnage = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getEtape(): ?Etape
    {
        return $this->etape;
    }

    public function setEtape(?Etape $etape): self
    {
        $this->etape = $etape;

        return $this;
    }

    public function getEndurance(): ?int
    {
        return $this->endurance;
    }

    public function setEndurance(int $endurance): self
    {
        $this->endurance = $endurance;

        return $this;
    }

    public function getAventure(): ?Aventure
    {
        return $this->aventure;
    }

    public function setAventure(?Aventure $aventure): self
    {
        $this->aventure = $aventure;

        return $this;
    }

    public function getPersonnage(): ?Personnage
    {
        return $this->personnage;
    }

    public function setPersonnage(?Personnage $personnage): self
    {
        $this->personnage = $personnage;

        return $this;
    }
}
