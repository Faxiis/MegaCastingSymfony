<?php

namespace App\Entity;

use App\Repository\CivilityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CivilityRepository::class)]
class Civility
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $shortLabel = null;

    #[ORM\Column(length: 255)]
    private ?string $longLabel = null;

    #[ORM\ManyToMany(targetEntity: Offers::class, inversedBy: 'civilities')]
    private Collection $offers;

    public function __construct()
    {
        $this->offers = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getShortLabel(): ?string
    {
        return $this->shortLabel;
    }

    public function setShortLabel(string $shortLabel): self
    {
        $this->shortLabel = $shortLabel;

        return $this;
    }

    public function getLongLabel(): ?string
    {
        return $this->longLabel;
    }

    public function setLongLabel(string $longLabel): self
    {
        $this->longLabel = $longLabel;

        return $this;
    }

    /**
     * @return Collection<int, Offers>
     */
    public function getOffers(): Collection
    {
        return $this->offers;
    }

    public function addOffer(Offers $offer): self
    {
        if (!$this->offers->contains($offer)) {
            $this->offers->add($offer);
        }

        return $this;
    }

    public function removeOffer(Offers $offer): self
    {
        $this->offers->removeElement($offer);

        return $this;
    }
}
