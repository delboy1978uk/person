<?php

namespace Del\Person\Entity;

use DateTime;
use Del\Entity\Country;
use Del\Factory\CountryFactory;
use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;

/**
 * @ORM\Entity(repositoryClass="\Del\Person\Repository\PersonRepository")
 */
class Person implements JsonSerializable
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private ?int $id = null;

    /** @ORM\Column(type="string",length=60,nullable=true) */
    private ?string $firstname = '';

    /** @ORM\Column(type="string",length=60,nullable=true) */
    private ?string $middlename = '';

    /** @ORM\Column(type="string",length=60,nullable=true) */
    private ?string $lastname = '';

    /** @ORM\Column(type="string",length=50,nullable=true) */
    private ?string $aka = '';

    /**
     * @ORM\Column(type="date",nullable=true)
     * @var DateTime
     */
    private ?DateTime $dob = null;

    /** @ORM\Column(type="string",length=50,nullable=true) */
    private ?string $birthplace = '';

    /**
     * @var string $country
     * @ORM\Column(type="string",length=3,nullable=true)
     */
    private ?string $country = '';

    /** @ORM\Column(type="string",length=255,nullable=true) */
    private ?string $image = '';

    /** @ORM\Column(type="string",length=255,nullable=true) */
    private ?string $backgroundImage = '';

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Person
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return Country|null
     * @throws \Del\CountryException
     */
    public function getCountry(): ?Country
    {
        return $this->country ? CountryFactory::generate($this->country) : null;
    }

    /**
     * @param Country $country
     * @return Person
     */
    public function setCountry(Country $country): void
    {
        $this->country = $country->getIso();
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): void
    {
        $this->firstname = $firstname;
    }

    public function getMiddlename(): ?string
    {
        return $this->middlename;
    }

    public function setMiddlename(string $middlename): void
    {
        $this->middlename = $middlename;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): void
    {
        $this->lastname = $lastname;
    }

    public function getAka(): ?string
    {
        return $this->aka;
    }

    public function setAka(string $aka): void
    {
        $this->aka = $aka;
    }

    public function getDob(): ?DateTime
    {
        return $this->dob;
    }

    public function setDob(DateTime $dob): void
    {
        $this->dob = $dob;
    }

    public function getBirthplace(): ?string
    {
        return $this->birthplace;
    }

    public function setBirthplace(string $birthplace): void
    {
        $this->birthplace = $birthplace;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): void
    {
        $this->image = $image;
    }

    public function getBackgroundImage(): ?string
    {
        return $this->backgroundImage;
    }

    public function setBackgroundImage(string $backgroundImage): void
    {
        $this->backgroundImage = $backgroundImage;
    }

    public function getFullName($includeMiddleNames = false): string
    {
        $middleName = $includeMiddleNames && $this->middlename ? ' ' . $this->middlename : '';

        return $this->firstname . $middleName . ' ' . $this->lastname;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'firstname' => $this->getFirstname(),
            'middlename' => $this->getMiddlename(),
            'lastname' => $this->getLastname(),
            'aka' => $this->getAka(),
            'dob' => $this->getDob(),
            'birthplace' => $this->getBirthplace(),
            'country' => $this->country ? $this->getCountry()->getIso() : null,
            'image' => $this->getImage(),
            'backgrundImage' => $this->getImage(),
        ];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
