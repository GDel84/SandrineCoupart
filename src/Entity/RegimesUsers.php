<?php

namespace App\Entity;

use App\Repository\RegimesUsersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RegimesUsersRepository::class)]
class RegimesUsers
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToMany(targetEntity: Regimes::class, inversedBy: 'regimesUsers')]
    private Collection $Regimes;

    #[ORM\ManyToMany(targetEntity: user::class, inversedBy: 'regimesUsers')]
    private Collection $User;

    public function __construct()
    {
        $this->Regimes = new ArrayCollection();
        $this->User = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Regimes>
     */
    public function getRegimes(): Collection
    {
        return $this->Regimes;
    }

    public function addRegime(Regimes $regime): self
    {
        if (!$this->Regimes->contains($regime)) {
            $this->Regimes->add($regime);
        }

        return $this;
    }

    public function removeRegime(Regimes $regime): self
    {
        $this->Regimes->removeElement($regime);

        return $this;
    }

    /**
     * @return Collection<int, user>
     */
    public function getUser(): Collection
    {
        return $this->User;
    }

    public function addUser(user $user): self
    {
        if (!$this->User->contains($user)) {
            $this->User->add($user);
        }

        return $this;
    }

    public function removeUser(user $user): self
    {
        $this->User->removeElement($user);

        return $this;
    }

}
