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

    #[ORM\OneToMany(mappedBy: 'Recette', targetEntity: IngredientRecette::class, orphanRemoval: true)]
    private Collection $ingredientRecettes;

    #[ORM\OneToMany(mappedBy: 'recette', targetEntity: Etape::class)]
    private Collection $Etapes;

    #[ORM\Column(nullable: true)]
    private ?bool $RecettePublic = null;


    public function __construct()
    {
        $this->IdRegime = new ArrayCollection();
        $this->ingredientRecettes = new ArrayCollection();
        $this->Etapes = new ArrayCollection();
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

    public function __toString()
    {
        return $this->getTitle();
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
            $ingredientRecette->setRecette($this);
        }

        return $this;
    }

    public function removeIngredientRecette(IngredientRecette $ingredientRecette): self
    {
        if ($this->ingredientRecettes->removeElement($ingredientRecette)) {
            // set the owning side to null (unless already changed)
            if ($ingredientRecette->getRecette() === $this) {
                $ingredientRecette->setRecette(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Etape>
     */
    public function getEtapes(): Collection
    {
        return $this->Etapes;
    }

    public function addEtape(Etape $etape): self
    {
        if (!$this->Etapes->contains($etape)) {
            $this->Etapes->add($etape);
            $etape->setRecette($this);
        }

        return $this;
    }

    public function removeEtape(Etape $etape): self
    {
        if ($this->Etapes->removeElement($etape)) {
            // set the owning side to null (unless already changed)
            if ($etape->getRecette() === $this) {
                $etape->setRecette(null);
            }
        }

        return $this;
    }

    public function isRecettePublic(): ?bool
    {
        return $this->RecettePublic;
    }

    public function setRecettePublic(?bool $RecettePublic): self
    {
        $this->RecettePublic = $RecettePublic;

        return $this;
    }
}
