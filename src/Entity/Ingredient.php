<?php

namespace App\Entity;

use App\Repository\IngredientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: IngredientRepository::class)]
class Ingredient
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Libeller = null;

    #[ORM\Column(nullable: true)]
    private ?int $Allergene = null;

    #[ORM\ManyToMany(targetEntity: Recette::class, mappedBy: 'IdIngredients')]
    private Collection $recettes;

    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'IdIngredient')]
    private Collection $users;

    #[ORM\ManyToOne(inversedBy: 'IdIngredient')]
    private ?IngredientRecette $ingredientRecette = null;

    public function __construct()
    {
        $this->recettes = new ArrayCollection();
        $this->users = new ArrayCollection();
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

    public function getAllergene(): ?int
    {
        return $this->Allergene;
    }

    public function setAllergene(?int $Allergene): self
    {
        $this->Allergene = $Allergene;

        return $this;
    }

    /**
     * @return Collection<int, Recette>
     */
    public function getRecettes(): Collection
    {
        return $this->recettes;
    }

    public function addRecette(Recette $recette): self
    {
        if (!$this->recettes->contains($recette)) {
            $this->recettes->add($recette);
            $recette->addIdIngredient($this);
        }

        return $this;
    }

    public function removeRecette(Recette $recette): self
    {
        if ($this->recettes->removeElement($recette)) {
            $recette->removeIdIngredient($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->addIdIngredient($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            $user->removeIdIngredient($this);
        }

        return $this;
    }

    public function __toString()
    {
        return $this->getLibeller();
    }

    public function getIngredientRecette(): ?IngredientRecette
    {
        return $this->ingredientRecette;
    }

    public function setIngredientRecette(?IngredientRecette $ingredientRecette): self
    {
        $this->ingredientRecette = $ingredientRecette;

        return $this;
    }
}
