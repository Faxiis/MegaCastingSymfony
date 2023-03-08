<?php

namespace App\Entity;

use App\Repository\ActivityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ActivityRepository::class)]
#[ORM\Table(name: "Activity")]
class Activity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'Identifier')]
    private ?int $id = null;

    #[ORM\Column(length: 255, name:"Name")]
    private ?string $name = null;

    #[ORM\JoinTable(name: 'ActivityOffer')]
    #[ORM\JoinColumn(name: 'IdentifierOffer', referencedColumnName: 'Identifier')]
    #[ORM\InverseJoinColumn(name: 'IdentifierActivity', referencedColumnName: 'Identifier')]
    #[ORM\ManyToMany(targetEntity: Offers::class, inversedBy: 'activities')]
    private Collection $offers;

    #[ORM\ManyToOne(inversedBy: 'activities')]
    #[ORM\JoinColumn(name: 'IdentifierActivityDomain', referencedColumnName: 'Identifier', nullable: false)]
    private ?ActivityDomain $activityDomains = null;

    public function __construct()
    {
        $this->offers = new ArrayCollection();
    }

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

    public function getActivityDomains(): ?ActivityDomain
    {
        return $this->activityDomains;
    }

    public function setActivityDomains(?ActivityDomain $activityDomains): self
    {
        $this->activityDomains = $activityDomains;

        return $this;
    }
}
