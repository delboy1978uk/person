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
    private $id;

    /** @ORM\Column(type="string",length=60,nullable=true) */
    private string $firstname = '';

    /** @ORM\Column(type="string",length=60,nullable=true) */
    private string $middlename = '';

    /** @ORM\Column(type="string",length=60,nullable=true) */
    private string $lastname = '';

    /** @ORM\Column(type="string",length=50,nullable=true) */
    private string $aka = '';

    /**
     * @ORM\Column(type="date",nullable=true)
     * @var DateTime
     */
    private ?DateTime $dob;

    /** @ORM\Column(type="string",length=50,nullable=true) */
    private string $birthplace = '';

    /**
     * @var string $country
     * @ORM\Column(type="string",length=3,nullable=true)
     */
    private string $country = '';

    /** @ORM\Column(type="string",length=255,nullable=true) */
    private string $image = '';

    /** @ORM\Column(type="string",length=255,nullable=true) */
    private string $backgroundImage = '';

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Person
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
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
    public function setCountry(Country $country)
    {
        $this->country = $country->getIso();
        return $this;
    }

    /**
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param string $firstname
     * @return Person
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
        return $this;
    }

    /**
     * @return string
     */
    public function getMiddlename()
    {
        return $this->middlename;
    }

    /**
     * @param string $middlename
     * @return Person
     */
    public function setMiddlename($middlename)
    {
        $this->middlename = $middlename;
        return $this;
    }

    /**
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param string $lastname
     * @return Person
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
        return $this;
    }

    /**
     * @return string
     */
    public function getAka()
    {
        return $this->aka;
    }

    /**
     * @param string $aka
     * @return Person
     */
    public function setAka($aka)
    {
        $this->aka = $aka;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getDob()
    {
        return $this->dob;
    }

    /**
     * @param $dob
     * @return Person
     */
    public function setDob(DateTime $dob)
    {
        $this->dob = $dob;
        return $this;
    }

    /**
     * @return string
     */
    public function getBirthplace()
    {
        return $this->birthplace;
    }

    /**
     * @param string $birthplace
     * @return Person
     */
    public function setBirthplace($birthplace)
    {
        $this->birthplace = $birthplace;
        return $this;
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param string $image
     * @return Person
     */
    public function setImage($image)
    {
        $this->image = $image;
        return $this;
    }

    /**
     * @return string
     */
    public function getBackgroundImage(): string
    {
        return $this->backgroundImage;
    }

    /**
     * @param string $backgroundImage
     */
    public function setBackgroundImage(string $backgroundImage): void
    {
        $this->backgroundImage = $backgroundImage;
    }
    

    /**
     * @param bool $includeMiddleNames
     * @return string
     */
    public function getFullName($includeMiddleNames = false): string
    {
        $middleName = $includeMiddleNames && $this->middlename ? ' ' . $this->middlename : '';

        return $this->firstname . $middleName . ' ' . $this->lastname;
    }

    /**
     * @return array
     */
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

    /**
     * @return array
     */
    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }
}
