<?php

namespace App\Entity;

use App\Repository\IngredientRecetteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: IngredientRecetteRepository::class)]
class IngredientRecette
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?int $quantité = null;

    #[ORM\Column(nullable: true)]
    private ?int $Unité = null;

    #[ORM\OneToMany(mappedBy: 'ingredientRecette', targetEntity: recette::class)]
    private Collection $IdRecette;

    #[ORM\OneToMany(mappedBy: 'ingredientRecette', targetEntity: ingredient::class)]
    private Collection $IdIngredient;

    public function __construct()
    {
        $this->IdRecette = new ArrayCollection();
        $this->IdIngredient = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantité(): ?int
    {
        return $this->quantité;
    }

    public function setQuantité(?int $quantité): self
    {
        $this->quantité = $quantité;

        return $this;
    }

    public function getUnité(): ?int
    {
        return $this->Unité;
    }

    public function setUnité(?int $Unité): self
    {
        $this->Unité = $Unité;

        return $this;
    }

    /**
     * @return Collection<int, recette>
     */
    public function getIdRecette(): Collection
    {
        return $this->IdRecette;
    }

    public function addIdRecette(recette $idRecette): self
    {
        if (!$this->IdRecette->contains($idRecette)) {
            $this->IdRecette->add($idRecette);
            $idRecette->setIngredientRecette($this);
        }

        return $this;
    }

    public function removeIdRecette(recette $idRecette): self
    {
        if ($this->IdRecette->removeElement($idRecette)) {
            // set the owning side to null (unless already changed)
            if ($idRecette->getIngredientRecette() === $this) {
                $idRecette->setIngredientRecette(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ingredient>
     */
    public function getIdIngredient(): Collection
    {
        return $this->IdIngredient;
    }

    public function addIdIngredient(ingredient $idIngredient): self
    {
        if (!$this->IdIngredient->contains($idIngredient)) {
            $this->IdIngredient->add($idIngredient);
            $idIngredient->setIngredientRecette($this);
        }

        return $this;
    }

    public function removeIdIngredient(ingredient $idIngredient): self
    {
        if ($this->IdIngredient->removeElement($idIngredient)) {
            // set the owning side to null (unless already changed)
            if ($idIngredient->getIngredientRecette() === $this) {
                $idIngredient->setIngredientRecette(null);
            }
        }

        return $this;
    }
}
