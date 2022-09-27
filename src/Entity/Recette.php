<?php

namespace App\Entity;

use App\Repository\RecetteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RecetteRepository::class)]
class Recette
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Title = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $photo = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $Description = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $TpsPrepa = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $TpsRepos = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $TpsCuisson = null;

    #[ORM\ManyToMany(targetEntity: Regime::class, inversedBy: 'recettes')]
    private Collection $IdRegime;

    #[ORM\ManyToMany(targetEntity: Etape::class, inversedBy: 'recettes')]
    private Collection $IdEtape;

    #[ORM\ManyToMany(targetEntity: Ingredient::class, inversedBy: 'recettes')]
    private Collection $IdIngredients;


    public function __construct()
    {
        $this->IdRegime = new ArrayCollection();
        $this->IdEtape = new ArrayCollection();
        $this->IdIngredients = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->Title;
    }

    public function setTitle(?string $Title): self
    {
        $this->Title = $Title;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(?string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getTpsPrepa(): ?\DateTimeInterface
    {
        return $this->TpsPrepa;
    }

    public function setTpsPrepa(?\DateTimeInterface $TpsPrepa): self
    {
        $this->TpsPrepa = $TpsPrepa;

        return $this;
    }

    public function getTpsRepos(): ?\DateTimeInterface
    {
        return $this->TpsRepos;
    }

    public function setTpsRepos(?\DateTimeInterface $TpsRepos): self
    {
        $this->TpsRepos = $TpsRepos;

        return $this;
    }

    public function getTpsCuisson(): ?\DateTimeInterface
    {
        return $this->TpsCuisson;
    }

    public function setTpsCuisson(?\DateTimeInterface $TpsCuisson): self
    {
        $this->TpsCuisson = $TpsCuisson;

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
     * @return Collection<int, Etape>
     */
    public function getIdEtape(): Collection
    {
        return $this->IdEtape;
    }

    public function addIdEtape(Etape $idEtape): self
    {
        if (!$this->IdEtape->contains($idEtape)) {
            $this->IdEtape->add($idEtape);
        }

        return $this;
    }

    public function removeIdEtape(Etape $idEtape): self
    {
        $this->IdEtape->removeElement($idEtape);

        return $this;
    }

    /**
     * @return Collection<int, Ingredient>
     */
    public function getIdIngredients(): Collection
    {
        return $this->IdIngredients;
    }

    public function addIdIngredient(Ingredient $idIngredient): self
    {
        if (!$this->IdIngredients->contains($idIngredient)) {
            $this->IdIngredients->add($idIngredient);
        }

        return $this;
    }

    public function removeIdIngredient(Ingredient $idIngredient): self
    {
        $this->IdIngredients->removeElement($idIngredient);

        return $this;
    }


}
