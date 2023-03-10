<?php

namespace App\Entity;

use App\Repository\PackRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PackRepository::class)]
#[ORM\Table(name: "Pack")]
class Pack
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'Identifier')]
    private ?int $id = null;

    #[ORM\Column(length: 255, name:"Label")]
    private ?string $label = null;

    #[ORM\Column (name: "OffersNumber")]
    private ?int $offersNumber = null;

    #[ORM\Column (name:"Price")]
    private ?float $price = null;

    #[ORM\JoinTable(name: 'PackClient')]
    #[ORM\JoinColumn(name: 'IdentifierClient', referencedColumnName: 'Identifier')]
    #[ORM\InverseJoinColumn(name: 'IdentifierPack', referencedColumnName: 'Identifier')]
    #[ORM\ManyToMany(targetEntity: Client::class, inversedBy: 'packs')]
    private Collection $clients;

    public function __construct()
    {
        $this->clients = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function getOffersNumber(): ?int
    {
        return $this->offersNumber;
    }

    public function setOffersNumber(int $offersNumber): self
    {
        $this->offersNumber = $offersNumber;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return Collection<int, Client>
     */
    public function getClients(): Collection
    {
        return $this->clients;
    }

    public function addClient(Client $client): self
    {
        if (!$this->clients->contains($client)) {
            $this->clients->add($client);
        }

        return $this;
    }

    public function removeClient(Client $client): self
    {
        $this->clients->removeElement($client);

        return $this;
    }
}
