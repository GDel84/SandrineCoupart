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
    private ?bool $Allergene = null;

    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'IdIngredient')]
    private Collection $users;

    #[ORM\OneToMany(mappedBy: 'Ingredient', targetEntity: IngredientRecette::class, orphanRemoval: true)]
    private Collection $ingredientRecettes;

    public function __construct()
    {
        $this->recettes = new ArrayCollection();
        $this->users = new ArrayCollection();
        $this->ingredientRecettes = new ArrayCollection();
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

    public function getAllergene(): ?bool
    {
        return $this->Allergene;
    }

    public function setAllergene(?bool $Allergene): self
    {
        $this->Allergene = $Allergene;

        return $this;
    }
    public function isAllergene(?bool $Allergene)
    {
        if($this->getAllergene()===true){
            return true;
        }
        return false;
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

    /**
     * @return Collection<int, IngredientRecette>
     */
    public function getIngredientRecettes(): Collection
    {
        return $this->ingredientRecettes;
    }

    public function addIngredientRecette(IngredientRecette $ingredientRecette): self
    {
        if (!$this->ingredientRecettes->contains($ingredientRecette)) {
            $this->ingredientRecettes->add($ingredientRecette);
            $ingredientRecette->setIngredient($this);
        }

        return $this;
    }

    public function removeIngredientRecette(IngredientRecette $ingredientRecette): self
    {
        if ($this->ingredientRecettes->removeElement($ingredientRecette)) {
            // set the owning side to null (unless already changed)
            if ($ingredientRecette->getIngredient() === $this) {
                $ingredientRecette->setIngredient(null);
            }
        }

        return $this;
    }
}
