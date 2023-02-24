<?php

namespace App\Entity;

use App\Repository\AventureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AventureRepository::class)]
class Aventure
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $difficultee = null;

    #[ORM\OneToOne(inversedBy: 'aventure', cascade: ['persist', 'remove'])]
    private ?Etape $premiereEtape = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $introduction = null;

    #[ORM\ManyToMany(targetEntity: Personnage::class, mappedBy: 'aventures')]
    private Collection $personnages;

    #[ORM\OneToMany(mappedBy: 'aventure', targetEntity: Partie::class)]
    private Collection $parties;

    #[ORM\ManyToOne]
    private ?Etape $etapeFinale = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $conclusion = null;

    public function __construct()
    {
        $this->personnages = new ArrayCollection();
        $this->parties = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDifficultee(): ?int
    {
        return $this->difficultee;
    }

    public function setDifficultee(int $difficultee): self
    {
        $this->difficultee = $difficultee;

        return $this;
    }

    public function getPremiereEtape(): ?Etape
    {
        return $this->premiereEtape;
    }

    public function setPremiereEtape(?Etape $premiereEtape): self
    {
        $this->premiereEtape = $premiereEtape;

        return $this;
    }
    public function __toString(){
        return $this->titre; 
    }

    public function getIntroduction(): ?string
    {
        return $this->introduction;
    }

    public function setIntroduction(string $introduction): self
    {
        $this->introduction = $introduction;

        return $this;
    }

    /**
     * @return Collection<int, Personnage>
     */
    public function getPersonnages(): Collection
    {
        return $this->personnages;
    }

    public function addPersonnage(Personnage $personnage): self
    {
        if (!$this->personnages->contains($personnage)) {
            $this->personnages->add($personnage);
            $personnage->addAventure($this);
        }

        return $this;
    }

    public function removePersonnage(Personnage $personnage): self
    {
        if ($this->personnages->removeElement($personnage)) {
            $personnage->removeAventure($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Partie>
     */
    public function getParties(): Collection
    {
        return $this->parties;
    }

    public function addParty(Partie $party): self
    {
        if (!$this->parties->contains($party)) {
            $this->parties->add($party);
            $party->setAventure($this);
        }

        return $this;
    }

    public function removeParty(Partie $party): self
    {
        if ($this->parties->removeElement($party)) {
            // set the owning side to null (unless already changed)
            if ($party->getAventure() === $this) {
                $party->setAventure(null);
            }
        }

        return $this;
    }

    public function getEtapeFinale(): ?Etape
    {
        return $this->etapeFinale;
    }

    public function setEtapeFinale(?Etape $etapeFinale): self
    {
        $this->etapeFinale = $etapeFinale;

        return $this;
    }

    public function getConclusion(): ?string
    {
        return $this->conclusion;
    }

    public function setConclusion(string $conclusion): self
    {
        $this->conclusion = $conclusion;

        return $this;
    }
}
