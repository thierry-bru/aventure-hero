<?php

namespace App\Entity;

use App\Repository\PersonnageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PersonnageRepository::class)]
class Personnage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\ManyToOne(inversedBy: 'personnages')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Race $race = null;

    #[ORM\ManyToMany(targetEntity: Aventure::class, inversedBy: 'personnages')]
    private Collection $aventures;

    #[ORM\OneToMany(mappedBy: 'personnage', targetEntity: Partie::class)]
    private Collection $parties;

    public function __construct()
    {
        $this->aventures = new ArrayCollection();
        $this->parties = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getRace(): ?Race
    {
        return $this->race;
    }

    public function setRace(?Race $race): self
    {
        $this->race = $race;

        return $this;
    }

    /**
     * @return Collection<int, Aventure>
     */
    public function getAventures(): Collection
    {
        return $this->aventures;
    }

    public function addAventure(Aventure $aventure): self
    {
        if (!$this->aventures->contains($aventure)) {
            $this->aventures->add($aventure);
        }

        return $this;
    }

    public function removeAventure(Aventure $aventure): self
    {
        $this->aventures->removeElement($aventure);

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
            $party->setPersonnage($this);
        }

        return $this;
    }

    public function removeParty(Partie $party): self
    {
        if ($this->parties->removeElement($party)) {
            // set the owning side to null (unless already changed)
            if ($party->getPersonnage() === $this) {
                $party->setPersonnage(null);
            }
        }

        return $this;
    }
    public function __toString(){
        return "aventurier:".$this->prenom." ".$this->nom; 
    }
}
