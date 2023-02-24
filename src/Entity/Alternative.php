<?php

namespace App\Entity;

use App\Repository\AlternativeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AlternativeRepository::class)]
class Alternative
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $texteAmbiance = null;

    #[ORM\ManyToMany(targetEntity: Etape::class, inversedBy: 'alternatives')]
    private Collection $etapesPrecedantes;

    #[ORM\ManyToOne]
    private ?Etape $etapeSuivante = null;

    public function __construct()
    {
        $this->etapesPrecedantes = new ArrayCollection();
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

    /**
     * @return Collection<int, Etape>
     */
    public function getEtapesPrecedantes(): Collection
    {
        return $this->etapesPrecedantes;
    }

    public function addEtapesPrecedante(Etape $etapesPrecedante): self
    {
        if (!$this->etapesPrecedantes->contains($etapesPrecedante)) {
            $this->etapesPrecedantes->add($etapesPrecedante);
        }

        return $this;
    }

    public function removeEtapesPrecedante(Etape $etapesPrecedante): self
    {
        $this->etapesPrecedantes->removeElement($etapesPrecedante);

        return $this;
    }

    public function getEtapeSuivante(): ?Etape
    {
        return $this->etapeSuivante;
    }

    public function setEtapeSuivante(?Etape $etapeSuivante): self
    {
        $this->etapeSuivante = $etapeSuivante;

        return $this;
    }


}
