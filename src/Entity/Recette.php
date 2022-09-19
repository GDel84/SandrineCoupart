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
    private ?string $Titre = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $Description = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $Tpsprepa = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $TpsRepos = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $Tpscuisson = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Allergene = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Regime = null;

    #[ORM\Column(nullable: true)]
    private ?bool $abonne = null;

    #[ORM\ManyToMany(targetEntity: IngredientsRecette::class, mappedBy: 'Recette')]
    private Collection $ingredientsRecettes;

    #[ORM\ManyToMany(targetEntity: RegimesRecettes::class, mappedBy: 'Recette')]
    private Collection $regimesRecettes;

    public function __construct()
    {
        $this->ingredientsRecettes = new ArrayCollection();
        $this->regimesRecettes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->Titre;
    }

    public function setTitre(?string $Titre): self
    {
        $this->Titre = $Titre;

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

    public function getTpsprepa(): ?\DateTimeInterface
    {
        return $this->Tpsprepa;
    }

    public function setTpsprepa(?\DateTimeInterface $Tpsprepa): self
    {
        $this->Tpsprepa = $Tpsprepa;

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

    public function getTpscuisson(): ?\DateTimeInterface
    {
        return $this->Tpscuisson;
    }

    public function setTpscuisson(?\DateTimeInterface $Tpscuisson): self
    {
        $this->Tpscuisson = $Tpscuisson;

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

    public function getRegime(): ?string
    {
        return $this->Regime;
    }

    public function setRegime(?string $Regime): self
    {
        $this->Regime = $Regime;

        return $this;
    }

    public function isAbonne(): ?bool
    {
        return $this->abonne;
    }

    public function setAbonne(?bool $abonne): self
    {
        $this->abonne = $abonne;

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
            $ingredientsRecette->addRecette($this);
        }

        return $this;
    }

    public function removeIngredientsRecette(IngredientsRecette $ingredientsRecette): self
    {
        if ($this->ingredientsRecettes->removeElement($ingredientsRecette)) {
            $ingredientsRecette->removeRecette($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, RegimesRecettes>
     */
    public function getRegimesRecettes(): Collection
    {
        return $this->regimesRecettes;
    }

    public function addRegimesRecette(RegimesRecettes $regimesRecette): self
    {
        if (!$this->regimesRecettes->contains($regimesRecette)) {
            $this->regimesRecettes->add($regimesRecette);
            $regimesRecette->addRecette($this);
        }

        return $this;
    }

    public function removeRegimesRecette(RegimesRecettes $regimesRecette): self
    {
        if ($this->regimesRecettes->removeElement($regimesRecette)) {
            $regimesRecette->removeRecette($this);
        }

        return $this;
    }
}
