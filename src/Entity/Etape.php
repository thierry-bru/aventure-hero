<?php

namespace App\Entity;

use App\Repository\EtapeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EtapeRepository::class)]
class Etape
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $texteAmbiance = null;

    #[ORM\OneToOne(mappedBy: 'premiereEtape', cascade: ['persist', 'remove'])]
    private ?Aventure $aventure = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    #[ORM\OneToMany(mappedBy: 'etape', targetEntity: Partie::class)]
    private Collection $parties;

    #[ORM\ManyToMany(targetEntity: Alternative::class, mappedBy: 'etapesPrecedantes')]
    private Collection $alternatives;



    public function __construct()
    {
        $this->parties = new ArrayCollection();
        $this->alternatives = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTexteAmbiance(): ?string
    {
        return $this->texteAmbiance;
    }

    public function setTexteAmbiance(string $texteAmbiance): self
    {
        $this->texteAmbiance = $texteAmbiance;

        return $this;
    }

    public function getAventure(): ?Aventure
    {
        return $this->aventure;
    }

    public function setAventure(?Aventure $aventure): self
    {
        // unset the owning side of the relation if necessary
        if ($aventure === null && $this->aventure !== null) {
            $this->aventure->setPremiereEtape(null);
        }

        // set the owning side of the relation if necessary
        if ($aventure !== null && $aventure->getPremiereEtape() !== $this) {
            $aventure->setPremiereEtape($this);
        }

        $this->aventure = $aventure;

        return $this;
    }
    public function __toString(){
        return $this->texteAmbiance; 
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
            $party->setEtape($this);
        }

        return $this;
    }

    public function removeParty(Partie $party): self
    {
        if ($this->parties->removeElement($party)) {
            // set the owning side to null (unless already changed)
            if ($party->getEtape() === $this) {
                $party->setEtape(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Alternative>
     */
    public function getAlternatives(): Collection
    {
        return $this->alternatives;
    }

    public function addAlternative(Alternative $alternative): self
    {
        if (!$this->alternatives->contains($alternative)) {
            $this->alternatives->add($alternative);
            $alternative->addEtapesPrecedante($this);
        }

        return $this;
    }

    public function removeAlternative(Alternative $alternative): self
    {
        if ($this->alternatives->removeElement($alternative)) {
            $alternative->removeEtapesPrecedante($this);
        }

        return $this;
    }

    

    
}
