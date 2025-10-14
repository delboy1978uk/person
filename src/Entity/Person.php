<?php

declare(strict_types=1);

namespace Del\Person\Entity;

use Bone\BoneDoctrine\Attributes\Cast;
use Bone\BoneDoctrine\Attributes\Visibility;
use Bone\BoneDoctrine\Traits\HasId;
use Bone\BoneDoctrine\Traits\HasImage;
use DateTimeInterface;
use Del\Form\Field\Attributes\Field;
use Del\Factory\CountryFactory;
use Del\Form\Field\Transformer\DateTimeTransformer;
use Del\Form\Traits\HasFormFields;
use Del\Person\Repository\PersonRepository;
use Del\Traits\HasCountryTrait;
use Del\Traits\HasOptionalCountry;
use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;

#[ORM\Entity(repositoryClass: PersonRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Person implements JsonSerializable
{
    use HasFormFields;
    use HasId;

    #[ORM\Column(type: 'string', length: 60, nullable: true)]
    #[Field('string|max:60')]
    #[Visibility('all')]
    private ?string $firstname = '';

    #[ORM\Column(type: 'string', length: 60, nullable: true)]
    #[Field('string|max:60')]
    #[Visibility('all')]
    private ?string $middlename = '';

    #[ORM\Column(type: 'string', length: 60, nullable: true)]
    #[Field('string|max:60')]
    #[Visibility('all')]
    private ?string $lastname = '';

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    #[Field('string|max:50')]
    #[Visibility('all')]
    private ?string $aka = '';

    #[ORM\Column(type: 'date', nullable: true)]
    #[Field('date')]
    #[Visibility('all')]
    #[Cast(transformer: new DateTimeTransformer('D d M Y'))]
    private ?DateTimeInterface $dob = null;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    #[Field('string|max:50')]
    #[Visibility('all')]
    private ?string $birthplace = '';

    use HasOptionalCountry;
    use HasImage;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Field('string')]
    #[Visibility('noindex')]
    private ?string $backgroundImage = '';

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

    public function getDob(): ?DateTimeInterface
    {
        return $this->dob;
    }

    public function setDob(DateTimeInterface $dob): void
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
