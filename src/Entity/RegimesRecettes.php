<?php

namespace App\Entity;

use App\Repository\RegimesRecettesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RegimesRecettesRepository::class)]
class RegimesRecettes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToMany(targetEntity: Regimes::class, inversedBy: 'regimesRecettes')]
    private Collection $Regimes;

    #[ORM\ManyToMany(targetEntity: Recette::class, inversedBy: 'regimesRecettes')]
    private Collection $Recette;

    public function __construct()
    {
        $this->Regimes = new ArrayCollection();
        $this->Recette = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Regimes>
     */
    public function getRegimes(): Collection
    {
        return $this->Regimes;
    }

    public function addRegime(Regimes $regime): self
    {
        if (!$this->Regimes->contains($regime)) {
            $this->Regimes->add($regime);
        }

        return $this;
    }

    public function removeRegime(Regimes $regime): self
    {
        $this->Regimes->removeElement($regime);

        return $this;
    }

    /**
     * @return Collection<int, Recette>
     */
    public function getRecette(): Collection
    {
        return $this->Recette;
    }

    public function addRecette(Recette $recette): self
    {
        if (!$this->Recette->contains($recette)) {
            $this->Recette->add($recette);
        }

        return $this;
    }

    public function removeRecette(Recette $recette): self
    {
        $this->Recette->removeElement($recette);

        return $this;
    }
}
