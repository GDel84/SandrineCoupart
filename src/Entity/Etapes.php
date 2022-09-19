<?php

namespace App\Entity;

use App\Repository\EtapesRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EtapesRepository::class)]
class Etapes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?int $Ordes = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $Instruction = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrdes(): ?int
    {
        return $this->Ordes;
    }

    public function setOrdes(?int $Ordes): self
    {
        $this->Ordes = $Ordes;

        return $this;
    }

    public function getInstruction(): ?string
    {
        return $this->Instruction;
    }

    public function setInstruction(?string $Instruction): self
    {
        $this->Instruction = $Instruction;

        return $this;
    }
}
