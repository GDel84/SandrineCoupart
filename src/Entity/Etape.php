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

    #[ORM\Column(nullable: true)]
    private ?int $Ordres = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $Instrcution = null;

    #[ORM\ManyToMany(targetEntity: Recette::class, mappedBy: 'IdEtape')]
    private Collection $recettes;

    #[ORM\ManyToOne(inversedBy: 'Etapes')]
    private ?Recette $recette = null;

    public function __construct()
    {
        $this->recettes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrdres(): ?int
    {
        return $this->Ordres;
    }

    public function setOrdres(?int $Ordres): self
    {
        $this->Ordres = $Ordres;

        return $this;
    }

    public function getInstrcution(): ?string
    {
        return $this->Instrcution;
    }

    public function setInstrcution(?string $Instrcution): self
    {
        $this->Instrcution = $Instrcution;

        return $this;
    }

    /**
     * @return Collection<int, Recette>
     */
    public function getRecettes(): Collection
    {
        return $this->recettes;
    }

    public function __toString()
    {
        return $this->getOrdres();
    }

    public function getRecette(): ?Recette
    {
        return $this->recette;
    }

    public function setRecette(?Recette $recette): self
    {
        $this->recette = $recette;

        return $this;
    }
}
