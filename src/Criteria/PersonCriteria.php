<?php

namespace Del\Person\Criteria;

class PersonCriteria
{
    const ORDER_ASC = 'ASC';
    const ORDER_DESC = 'DESC';
    const ORDER_FIRSTNAME = 'firstname';
    const ORDER_MIDDLENAME = 'middlename';
    const ORDER_LASTNAME = 'state';
    const ORDER_AKA = 'aka';
    const ORDER_BIRTHPLACE = 'birthplace';
    const ORDER_COUNTRY = 'country';
    const ORDER_DOB = 'dob';

    protected ?int $id = null;
    protected ?string $firstname = null;
    protected ?string $middlename = null;
    protected ?string $lastname = null;
    protected ?string $aka = null;
    protected ?string $birthplace = null;
    protected ?string $country = null;
    protected ?string $dob = null;
    protected ?int $limit = null;
    protected ?int $offset = null;
    protected ?string $order = null;
    protected ?string $orderDirection = null;

    public function hasOffset(): bool
    {
        return $this->offset !== null;
    }

    public function setOffset(int $offset): void
    {
        $this->offset = $offset;
    }

    public function getOffset(): int
    {
        return $this->offset;
    }

    public function hasLimit(): bool
    {
        return $this->limit !== null;
    }

    public function setLimit(int $limit): void
    {
        $this->limit = $limit;
    }

    public function getLimit(): int
    {
        return $this->limit;
    }

    public function hasOrder(): bool
    {
        return $this->order !== null;
    }

    public function setOrder(string $order): void
    {
        $this->order = $order;
    }

    public function getOrder(): string
    {
        return $this->order;
    }

    public function getOrderDirection(): string
    {
        return $this->orderDirection;
    }

    public function setOrderDirection(string $orderDirection): void
    {
        $this->orderDirection = $orderDirection;
    }

    public function hasOrderDirection(): bool
    {
        return $this->orderDirection !== null;
    }

    public function setPagination(int $page, int $limit): void
    {
        $offset = ($limit * $page) - $limit;
        $this->setLimit($limit);
        $this->setOffset($offset);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function hasId(): bool
    {
        return $this->id != null;
    }

    public function getFirstname(): string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): void
    {
        $this->firstname = $firstname;
    }

    public function hasFirstname(): bool
    {
        return $this->firstname != null;
    }

    public function getMiddlename(): string
    {
        return $this->middlename;
    }

    public function setMiddlename(string $middlename): void
    {
        $this->middlename = $middlename;
    }

    public function hasMiddlename(): bool
    {
        return $this->middlename != null;
    }

    public function getLastname(): string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): void
    {
        $this->lastname = $lastname;
    }

    public function hasLastname(): bool
    {
        return $this->lastname != null;
    }

    public function getAka(): string
    {
        return $this->aka;
    }

    public function setAka(string $aka): void
    {
        $this->aka = $aka;
    }

    public function hasAka(): bool
    {
        return $this->aka != null;
    }

    public function getBirthplace(): string
    {
        return $this->birthplace;
    }

    public function setBirthplace(string $birthplace): void
    {
        $this->birthplace = $birthplace;
    }

    public function hasBirthplace(): bool
    {
        return $this->birthplace != null;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function setCountry(string $country): void
    {
        $this->country = $country;
    }

    public function hasCountry(): bool
    {
        return $this->country != null;
    }

    public function getDob(): string
    {
        return $this->dob;
    }

    public function setDob(string $dob): void
    {
        $this->dob = $dob;
    }

    public function hasDob(): bool
    {
        return $this->dob != null;
    }
}
