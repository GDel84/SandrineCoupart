<?php

namespace App\Entity;

use App\Repository\IngredientsRecetteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: IngredientsRecetteRepository::class)]
class IngredientsRecette
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToMany(targetEntity: Recette::class, inversedBy: 'ingredientsRecettes')]
    private Collection $Recette;

    #[ORM\ManyToMany(targetEntity: Ingredients::class, inversedBy: 'ingredientsRecettes')]
    private Collection $Ingredients;

    #[ORM\Column(nullable: true)]
    private ?int $Quantité = null;

    #[ORM\Column(nullable: true)]
    private ?int $unite = null;

    public function __construct()
    {
        $this->Recette = new ArrayCollection();
        $this->Ingredients = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection<int, Ingredients>
     */
    public function getIngredients(): Collection
    {
        return $this->Ingredients;
    }

    public function addIngredient(Ingredients $ingredient): self
    {
        if (!$this->Ingredients->contains($ingredient)) {
            $this->Ingredients->add($ingredient);
        }

        return $this;
    }

    public function removeIngredient(Ingredients $ingredient): self
    {
        $this->Ingredients->removeElement($ingredient);

        return $this;
    }

    public function getQuantité(): ?int
    {
        return $this->Quantité;
    }

    public function setQuantité(?int $Quantité): self
    {
        $this->Quantité = $Quantité;

        return $this;
    }

    public function getUnite(): ?int
    {
        return $this->unite;
    }

    public function setUnite(?int $unite): self
    {
        $this->unite = $unite;

        return $this;
    }
}
