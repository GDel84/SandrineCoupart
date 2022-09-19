<?php

namespace App\Entity;

use App\Repository\RegimesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RegimesRepository::class)]
class Regimes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Libeller = null;

    #[ORM\ManyToMany(targetEntity: RegimesUsers::class, mappedBy: 'Regimes')]
    private Collection $regimesUsers;

    #[ORM\ManyToMany(targetEntity: RegimesRecettes::class, mappedBy: 'Regimes')]
    private Collection $regimesRecettes;

    public function __construct()
    {
        $this->regimesUsers = new ArrayCollection();
        $this->regimesRecettes = new ArrayCollection();
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
            $regimesUser->addRegime($this);
        }

        return $this;
    }

    public function removeRegimesUser(RegimesUsers $regimesUser): self
    {
        if ($this->regimesUsers->removeElement($regimesUser)) {
            $regimesUser->removeRegime($this);
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
            $regimesRecette->addRegime($this);
        }

        return $this;
    }

    public function removeRegimesRecette(RegimesRecettes $regimesRecette): self
    {
        if ($this->regimesRecettes->removeElement($regimesRecette)) {
            $regimesRecette->removeRegime($this);
        }

        return $this;
    }
}
