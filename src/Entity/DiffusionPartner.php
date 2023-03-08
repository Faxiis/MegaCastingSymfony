<?php

namespace App\Entity;

use App\Repository\DiffusionPartnerRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DiffusionPartnerRepository::class)]
#[ORM\Table(name: "DiffusionPartner")]
class DiffusionPartner
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'Identifier')]
    private ?int $id = null;

    #[ORM\Column(length: 255, name:"Name")]
    private ?string $name = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
