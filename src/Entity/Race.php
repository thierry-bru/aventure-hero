<?php

namespace App\Entity;

use App\Repository\RaceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RaceRepository::class)]
class Race
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    #[ORM\Column]
    private ?int $bonus_force = null;

    #[ORM\Column]
    private ?int $bonus_agilite = null;

    #[ORM\Column]
    private ?int $bonus_endurance = null;

    #[ORM\OneToMany(mappedBy: 'race', targetEntity: Personnage::class)]
    private Collection $personnages;

    public function __construct()
    {
        $this->personnages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getBonusForce(): ?int
    {
        return $this->bonus_force;
    }

    public function setBonusForce(int $bonus_force): self
    {
        $this->bonus_force = $bonus_force;

        return $this;
    }

    public function getBonusAgilite(): ?int
    {
        return $this->bonus_agilite;
    }

    public function setBonusAgilite(int $bonus_agilite): self
    {
        $this->bonus_agilite = $bonus_agilite;

        return $this;
    }

    public function getBonusEndurance(): ?int
    {
        return $this->bonus_endurance;
    }

    public function setBonusEndurance(int $bonus_endurance): self
    {
        $this->bonus_endurance = $bonus_endurance;

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
            $personnage->setRace($this);
        }

        return $this;
    }

    public function removePersonnage(Personnage $personnage): self
    {
        if ($this->personnages->removeElement($personnage)) {
            // set the owning side to null (unless already changed)
            if ($personnage->getRace() === $this) {
                $personnage->setRace(null);
            }
        }

        return $this;
    }
    public function __toString(){
        return $this->libelle; 
    }
}
