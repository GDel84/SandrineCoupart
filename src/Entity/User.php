<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Nom = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Prenom = null;

    #[ORM\Column(nullable: true)]
    private ?int $Email = null;

    #[ORM\Column(nullable: true)]
    private ?int $telephone = null;

    #[ORM\Column(nullable: true)]
    private ?int $PassWord = null;

    #[ORM\Column(nullable: true)]
    private ?int $Role = null;

    #[ORM\ManyToMany(targetEntity: Regime::class, inversedBy: 'users')]
    private Collection $IdRegime;

    #[ORM\ManyToMany(targetEntity: Ingredient::class, inversedBy: 'users')]
    private Collection $IdIngredient;

    public function __construct()
    {
        $this->IdRegime = new ArrayCollection();
        $this->IdIngredient = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(?string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->Prenom;
    }

    public function setPrenom(?string $Prenom): self
    {
        $this->Prenom = $Prenom;

        return $this;
    }

    public function getEmail(): ?int
    {
        return $this->Email;
    }

    public function setEmail(?int $Email): self
    {
        $this->Email = $Email;

        return $this;
    }

    public function getTelephone(): ?int
    {
        return $this->telephone;
    }

    public function setTelephone(?int $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getPassWord(): ?int
    {
        return $this->PassWord;
    }

    public function setPassWord(?int $PassWord): self
    {
        $this->PassWord = $PassWord;

        return $this;
    }

    public function getRole(): ?int
    {
        return $this->Role;
    }

    public function setRole(?int $Role): self
    {
        $this->Role = $Role;

        return $this;
    }

    /**
     * @return Collection<int, Regime>
     */
    public function getIdRegime(): Collection
    {
        return $this->IdRegime;
    }

    public function addIdRegime(Regime $idRegime): self
    {
        if (!$this->IdRegime->contains($idRegime)) {
            $this->IdRegime->add($idRegime);
        }

        return $this;
    }

    public function removeIdRegime(Regime $idRegime): self
    {
        $this->IdRegime->removeElement($idRegime);

        return $this;
    }

    /**
     * @return Collection<int, Ingredient>
     */
    public function getIdIngredient(): Collection
    {
        return $this->IdIngredient;
    }

    public function addIdIngredient(Ingredient $idIngredient): self
    {
        if (!$this->IdIngredient->contains($idIngredient)) {
            $this->IdIngredient->add($idIngredient);
        }

        return $this;
    }

    public function removeIdIngredient(Ingredient $idIngredient): self
    {
        $this->IdIngredient->removeElement($idIngredient);

        return $this;
    }
}
