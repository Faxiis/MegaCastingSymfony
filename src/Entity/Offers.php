<?php

namespace App\Entity;

use App\Repository\OffersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OffersRepository::class)]
#[ORM\Table(name: "Offers")]
class Offers
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'Identifier')]
    private ?int $id = null;

    #[ORM\Column(length: 255, name:"Label")]
    private ?string $label = null;

    #[ORM\Column(length: 255, name:"Reference")]
    private ?string $reference = null;

    #[ORM\Column(length: 3000, name:"Description")]
    private ?string $description = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, name: "ParutionDateTime")]
    private ?\DateTimeInterface $parutionDateTime = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, name: "OfferStartDate")]
    private ?\DateTimeInterface $offerStartDate = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, name: "OfferEndDate")]
    private ?\DateTimeInterface $offerEndDate = null;

    #[ORM\Column(length: 255, name:"Localisation")]
    private ?string $localisation = null;


    #[ORM\ManyToMany(targetEntity: Civility::class, mappedBy: 'offers')]
    private Collection $civilities;

    #[ORM\ManyToOne(inversedBy: 'offers')]
    #[ORM\JoinColumn(name: 'IdentifierContractType', referencedColumnName: 'Identifier', nullable: false)]
    private ?ContractType $contractTypes = null;

    #[ORM\ManyToOne(inversedBy: 'offers')]
    #[ORM\JoinColumn(name: 'IdentifierClient', referencedColumnName: 'Identifier', nullable: false)]
    private ?Client $clients = null;

    #[ORM\ManyToMany(targetEntity: Activity::class, mappedBy: 'offers')]
    private Collection $activities;

    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'apply')]
    private Collection $users;

    #[ORM\Column(nullable: true)]
    private ?int $profesionalLevel = null;


    #[ORM\Column(nullable: true)]
    private ?bool $sponsor = null;

    #[ORM\Column(nullable: true)]
    private ?int $status = null;



    public function __construct()
    {
        $this->civilities = new ArrayCollection();
        $this->activities = new ArrayCollection();
        $this->users = new ArrayCollection();
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

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): self
    {
        $this->reference = $reference;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getParutionDateTime(): ?\DateTimeInterface
    {
        return $this->parutionDateTime;
    }

    public function setParutionDateTime(\DateTimeInterface $parutionDateTime): self
    {
        $this->parutionDateTime = $parutionDateTime;

        return $this;
    }

    public function getOfferStartDate(): ?\DateTimeInterface
    {
        return $this->offerStartDate;
    }

    public function setOfferStartDate(\DateTimeInterface $offerStartDate): self
    {
        $this->offerStartDate = $offerStartDate;

        return $this;
    }

    public function getOfferEndDate(): ?\DateTimeInterface
    {
        return $this->offerEndDate;
    }

    public function setOfferEndDate(\DateTimeInterface $offerEndDate): self
    {
        $this->offerEndDate = $offerEndDate;

        return $this;
    }

    public function getLocalisation(): ?string
    {
        return $this->localisation;
    }

    public function setLocalisation(string $localisation): self
    {
        $this->localisation = $localisation;

        return $this;
    }

    /**
     * @return Collection<int, Civility>
     */
    public function getCivilities(): Collection
    {
        return $this->civilities;
    }

    public function addCivility(Civility $civility): self
    {
        if (!$this->civilities->contains($civility)) {
            $this->civilities->add($civility);
            $civility->addOffer($this);
        }

        return $this;
    }

    public function removeCivility(Civility $civility): self
    {
        if ($this->civilities->removeElement($civility)) {
            $civility->removeOffer($this);
        }

        return $this;
    }

    public function getContractTypes(): ?ContractType
    {
        return $this->contractTypes;
    }

    public function setContractTypes(?ContractType $contractTypes): self
    {
        $this->contractTypes = $contractTypes;

        return $this;
    }

    public function getClients(): ?Client
    {
        return $this->clients;
    }

    public function setClients(?Client $clients): self
    {
        $this->clients = $clients;

        return $this;
    }

    /**
     * @return Collection<int, Activity>
     */
    public function getActivities(): Collection
    {
        return $this->activities;
    }

    public function addActivity(Activity $activity): self
    {
        if (!$this->activities->contains($activity)) {
            $this->activities->add($activity);
            $activity->addOffer($this);
        }

        return $this;
    }

    public function removeActivity(Activity $activity): self
    {
        if ($this->activities->removeElement($activity)) {
            $activity->removeOffer($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->addApply($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            $user->removeApply($this);
        }

        return $this;
    }

    public function getProfesionalLevel(): ?int
    {
        return $this->profesionalLevel;
    }

    public function setProfesionalLevel(?int $profesionalLevel): self
    {
        $this->profesionalLevel = $profesionalLevel;

        return $this;
    }

    public function isSponsor(): ?bool
    {
        return $this->sponsor;
    }

    public function setSponsor(?bool $sponsor): self
    {
        $this->sponsor = $sponsor;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(?int $status): self
    {
        $this->status = $status;

        return $this;
    }




}
