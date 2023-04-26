<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Serializable;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`User`')]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
#[Vich\Uploadable]
class User implements UserInterface, PasswordAuthenticatedUserInterface, \Serializable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true, name: 'Email')]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    #[Vich\UploadableField(mapping: 'user_images', fileNameProperty: 'imageName')]
    private ?File $imageFile = null;

    #[ORM\Column(nullable: true)]
    private ?string $imageName = null;

    #[ORM\Column(type: 'datetime_immutable' ,nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;


    /**
     * @var string The hashed password
     */
    #[ORM\Column(name: 'Password')]
    private ?string $password = null;

    #[ORM\Column(type: 'boolean')]
    private $isVerified = false;

    #[ORM\Column(length: 255, name:"FirstName")]
    private ?string $firstName = null;

    #[ORM\Column(length: 255, name:"LastName")]
    private ?string $lastName = null;

    #[ORM\Column(length: 255, name:"Phone")]
    private ?string $phone = null;

    #[ORM\Column(length: 255, name:"Country")]
    private ?string $country = null;

    #[ORM\Column(length: 255, name:"City")]
    private ?string $city = null;

    #[ORM\Column(length: 255, name:"Address")]
    private ?string $address = null;

    #[ORM\Column(length: 255 , name:"AddressZipCode")]
    private ?string $addressZipCode = null;

    #[ORM\JoinTable(name: 'UserOffer')]
    #[ORM\JoinColumn(name: 'IdentifierOffer', referencedColumnName: 'id')]
    #[ORM\InverseJoinColumn(name: 'IdentifierUser', referencedColumnName: 'Identifier')]
    #[ORM\ManyToMany(targetEntity: Offers::class, inversedBy: 'users')]
    private Collection $apply;

    #[ORM\Column(nullable: true)]
    private ?int $profesionalLevel = null;

    public function __construct()
    {
        $this->apply = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile|null $imageFile
     */
    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageName(?string $imageName): void
    {
        $this->imageName = $imageName;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }


    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): self
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getAddressZipCode(): ?string
    {
        return $this->addressZipCode;
    }

    public function setAddressZipCode(string $addressZipCode): self
    {
        $this->addressZipCode = $addressZipCode;

        return $this;
    }

    /**
     * @return Collection<int, Offers>
     */
    public function getApply(): Collection
    {
        return $this->apply;
    }

    public function addApply(Offers $apply): self
    {
        if (!$this->apply->contains($apply)) {
            $this->apply->add($apply);
        }

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function removeApply(Offers $apply): self
    {
        $this->apply->removeElement($apply);

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


    public function serialize()
    {
        // TODO: Implement serialize() method.
    }

    public function unserialize(string $data)
    {
        // TODO: Implement unserialize() method.
    }

    public function __serialize(): array
    {

            return [
                'id' => $this->id,
                'email' => $this->email,
                'roles' => $this->roles,
                'imageName' => $this->imageName,
                'updatedAt' => $this->updatedAt,
                'password' => $this->password,
                'isVerified' => $this->isVerified,
                'firstName' => $this->firstName,
                'lastName' => $this->lastName,
                'phone' => $this->phone,
                'country' => $this->country,
                'city' => $this->city,
                'address' => $this->address,
                'addressZipCode' => $this->addressZipCode,
                'apply' => $this->apply,
                'profesionalLevel' => $this->profesionalLevel
            ];
    }

    public function __unserialize(array $data): void
    {
        $this->id = $data['id'] ?? null;
        $this->email = $data['email'] ?? null;
        $this->roles = $data['roles'] ?? [];
        $this->imageName = $data['imageName'] ?? null;
        $this->updatedAt = $data['updatedAt'] ?? null;
        $this->password = $data['password'] ?? null;
        $this->isVerified = $data['isVerified'] ?? false;
        $this->firstName = $data['firstName'] ?? null;
        $this->lastName = $data['lastName'] ?? null;
        $this->phone = $data['phone'] ?? null;
        $this->country = $data['country'] ?? null;
        $this->city = $data['city'] ?? null;
        $this->address = $data['address'] ?? null;
        $this->addressZipCode = $data['addressZipCode'] ?? null;
        $this->apply = $data['apply'] ?? new ArrayCollection();
        $this->profesionalLevel = $data['profesionalLevel'] ?? null;
    }

}
