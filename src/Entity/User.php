<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
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
    private ?int $telephone = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    #[ORM\ManyToMany(targetEntity: Regime::class, inversedBy: 'users')]
    private Collection $IdRegime;

    #[ORM\ManyToMany(targetEntity: Ingredient::class, inversedBy: 'users')]
    private Collection $IdIngredient;

    public function __construct()
    {
        $this->IdRegime = new ArrayCollection();
        $this->IdIngredient = new ArrayCollection();
    }

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

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


    public function getTelephone(): ?int
    {
        return $this->telephone;
    }

    public function setTelephone(?int $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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
