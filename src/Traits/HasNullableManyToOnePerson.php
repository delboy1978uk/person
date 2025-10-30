<?php

declare(strict_types=1);

namespace Del\Person\Traits;

use Del\Person\Entity\Person;
use Doctrine\ORM\Mapping as ORM;

trait HasNullableManyToOnePerson
{
    #[ORM\ORM\ManyToOne(targetEntity: Person::class, cascade: ['persist'], nullable: true)]
    private ?Person $person = null;

    public function getPerson(): ?Person
    {
        return $this->person;
    }

    public function setPerson(?Person $person): void
    {
        $this->person = $person;
    }
}
