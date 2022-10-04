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
    private ?int $quantite = null;

    #[ORM\Column(nullable: true)]
    private ?string $Unite = null;

    #[ORM\ManyToOne(inversedBy: 'ingredientRecettes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Ingredient $Ingredient = null;

    #[ORM\ManyToOne(inversedBy: 'ingredientRecettes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Recette $Recette = null;

    public function __construct()
    {
        $this->IdRecette = new ArrayCollection();
        $this->IdIngredient = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(?int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getUnite(): ?string
    {
        return $this->Unite;
    }

    public function setUnite(?string $Unite): self
    {
        $this->Unite = $Unite;

        return $this;
    }

    public function getIngredient(): ?Ingredient
    {
        return $this->Ingredient;
    }

    public function setIngredient(?Ingredient $Ingredient): self
    {
        $this->Ingredient = $Ingredient;

        return $this;
    }

    public function getRecette(): ?Recette
    {
        return $this->Recette;
    }

    public function setRecette(?Recette $Recette): self
    {
        $this->Recette = $Recette;

        return $this;
    }
}
