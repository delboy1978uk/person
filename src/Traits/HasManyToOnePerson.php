<?php

declare(strict_types=1);

namespace Del\Person\Traits;

use Del\Person\Entity\Person;
use Doctrine\ORM\Mapping as ORM;

trait HasManyToOnePerson
{
    #[ORM\ORM\ManyToOne(targetEntity: Person::class, cascade: ['persist'])]
    private Person $person;

    public function getPerson(): Person
    {
        return $this->person;
    }

    public function setPerson(Person $person): void
    {
        $this->person = $person;
    }
}
