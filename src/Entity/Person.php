<?php

namespace Del\Entity;

use DateTime;

class Person
{
    /** @var int */
    private $id;

    /** @var  string */
    private $country;

    /** @var string */
    private $firstname;

    /** @var string */
    private $middlename;

    /** @var  string */
    private $lastname;

    /** @var  string */
    private $aka;

    /** @var DateTime */
    private $dob;

    /** @var string */
    private $birthplace;

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
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param string $country
     * @return Person
     */
    public function setCountry($country)
    {
        $this->country = $country;
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
     * @param DateTime $dob
     * @return Person
     */
    public function setDob($dob)
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
}
