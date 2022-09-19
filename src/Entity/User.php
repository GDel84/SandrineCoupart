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

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $telephone = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $PassWord = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Role = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Regimes = null;

    #[ORM\ManyToMany(targetEntity: RegimesUsers::class, mappedBy: 'User')]
    private Collection $regimesUsers;

    #[ORM\ManyToMany(targetEntity: UserIngredients::class, mappedBy: 'User')]
    private Collection $userIngredients;

    public function __construct()
    {
        $this->regimesUsers = new ArrayCollection();
        $this->userIngredients = new ArrayCollection();
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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getPassWord(): ?string
    {
        return $this->PassWord;
    }

    public function setPassWord(?string $PassWord): self
    {
        $this->PassWord = $PassWord;

        return $this;
    }

    public function getRole(): ?string
    {
        return $this->Role;
    }

    public function setRole(?string $Role): self
    {
        $this->Role = $Role;

        return $this;
    }

    public function getRegimes(): ?string
    {
        return $this->Regimes;
    }

    public function setRegimes(?string $Regimes): self
    {
        $this->Regimes = $Regimes;

        return $this;
    }

    /**
     * @return Collection<int, RegimesUsers>
     */
    public function getRegimesUsers(): Collection
    {
        return $this->regimesUsers;
    }

    public function addRegimesUser(RegimesUsers $regimesUser): self
    {
        if (!$this->regimesUsers->contains($regimesUser)) {
            $this->regimesUsers->add($regimesUser);
            $regimesUser->addUser($this);
        }

        return $this;
    }

    public function removeRegimesUser(RegimesUsers $regimesUser): self
    {
        if ($this->regimesUsers->removeElement($regimesUser)) {
            $regimesUser->removeUser($this);
        }

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
            $userIngredient->addUser($this);
        }

        return $this;
    }

    public function removeUserIngredient(UserIngredients $userIngredient): self
    {
        if ($this->userIngredients->removeElement($userIngredient)) {
            $userIngredient->removeUser($this);
        }

        return $this;
    }
}
