<?php

namespace App\Entity;

use App\Repository\IngredientsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: IngredientsRepository::class)]
class Ingredients
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Libeller = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Allergene = null;

    #[ORM\ManyToMany(targetEntity: UserIngredients::class, mappedBy: 'Ingredients')]
    private Collection $userIngredients;

    #[ORM\ManyToMany(targetEntity: IngredientsRecette::class, mappedBy: 'Ingredients')]
    private Collection $ingredientsRecettes;

    public function __construct()
    {
        $this->userIngredients = new ArrayCollection();
        $this->ingredientsRecettes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibeller(): ?string
    {
        return $this->Libeller;
    }

    public function setLibeller(?string $Libeller): self
    {
        $this->Libeller = $Libeller;

        return $this;
    }

    public function getAllergene(): ?string
    {
        return $this->Allergene;
    }

    public function setAllergene(?string $Allergene): self
    {
        $this->Allergene = $Allergene;

        return $this;
    }

    /**
     * @return Collection<int, UserIngredients>
     */
    public function getUserIngredients(): Collection
    {
        return $this->userIngredients;
    }

    public function addUserIngredient(UserIngredients $userIngredient): self
    {
        if (!$this->userIngredients->contains($userIngredient)) {
            $this->userIngredients->add($userIngredient);
            $userIngredient->addIngredient($this);
        }

        return $this;
    }

    public function removeUserIngredient(UserIngredients $userIngredient): self
    {
        if ($this->userIngredients->removeElement($userIngredient)) {
            $userIngredient->removeIngredient($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, IngredientsRecette>
     */
    public function getIngredientsRecettes(): Collection
    {
        return $this->ingredientsRecettes;
    }

    public function addIngredientsRecette(IngredientsRecette $ingredientsRecette): self
    {
        if (!$this->ingredientsRecettes->contains($ingredientsRecette)) {
            $this->ingredientsRecettes->add($ingredientsRecette);
            $ingredientsRecette->addIngredient($this);
        }

        return $this;
    }

    public function removeIngredientsRecette(IngredientsRecette $ingredientsRecette): self
    {
        if ($this->ingredientsRecettes->removeElement($ingredientsRecette)) {
            $ingredientsRecette->removeIngredient($this);
        }

        return $this;
    }
}
