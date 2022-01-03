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

    protected $id;
    protected $firstname;
    protected $middlename;
    protected $lastname;
    protected $aka;
    protected $birthplace;
    protected $country;
    protected $dob;

    protected $limit;
    protected $offset;
    protected $order;
    protected $orderDirection;

    /**
     * @return bool
     */
    public function hasOffset()
    {
        return $this->offset !== null;
    }

    /**
     * @param $code
     * @return $this
     */
    public function setOffset($code)
    {
        $this->offset = $code;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getOffset()
    {
        return $this->offset;
    }

    /**
     * @return bool
     */
    public function hasLimit()
    {
        return $this->limit !== null;
    }

    /**
     * @param $code
     * @return $this
     */
    public function setLimit($code)
    {
        $this->limit = $code;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLimit()
    {
        return $this->limit;
    }

    /**
     * @return bool
     */
    public function hasOrder()
    {
        return $this->order !== null;
    }

    /**
     * @param $code
     * @return $this
     */
    public function setOrder($order)
    {
        $this->order = $order;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @return mixed
     */
    public function getOrderDirection()
    {
        return $this->orderDirection;
    }

    /**
     * @param mixed $orderDirection
     * @return Criteria
     */
    public function setOrderDirection($orderDirection)
    {
        $this->orderDirection = $orderDirection;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasOrderDirection()
    {
        return $this->orderDirection !== null;
    }

    /**
     * @param $page
     * @param $limit
     */
    public function setPagination($page, $limit)
    {
        $offset = ($limit * $page) - $limit;
        $this->setLimit($limit);
        $this->setOffset($offset);
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = (int)$id;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasId()
    {
        return $this->id != null;
    }

    /**
     * @return string|null
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param string $firstname
     * @return PersonCriteria
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasFirstname()
    {
        return $this->firstname != null;
    }

    /**
     * @return mixed
     */
    public function getMiddlename()
    {
        return $this->middlename;
    }

    /**
     * @param mixed $middlename
     * @return PersonCriteria
     */
    public function setMiddlename($middlename)
    {
        $this->middlename = $middlename;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasMiddlename()
    {
        return $this->middlename != null;
    }

    /**
     * @return mixed
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param mixed $lastname
     * @return PersonCriteria
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasLastname()
    {
        return $this->lastname != null;
    }

    /**
     * @return mixed
     */
    public function getAka()
    {
        return $this->aka;
    }

    /**
     * @param mixed $aka
     * @return PersonCriteria
     */
    public function setAka($aka)
    {
        $this->aka = $aka;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasAka()
    {
        return $this->aka != null;
    }

    /**
     * @return mixed
     */
    public function getBirthplace()
    {
        return $this->birthplace;
    }

    /**
     * @param mixed $birthplace
     * @return PersonCriteria
     */
    public function setBirthplace($birthplace)
    {
        $this->birthplace = $birthplace;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasBirthplace()
    {
        return $this->birthplace != null;
    }

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param mixed $country
     * @return PersonCriteria
     */
    public function setCountry($country)
    {
        $this->country = $country;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasCountry()
    {
        return $this->country != null;
    }

    /**
     * @return mixed
     */
    public function getDob()
    {
        return $this->dob;
    }

    /**
     * @param mixed $dob
     * @return PersonCriteria
     */
    public function setDob($dob)
    {
        $this->dob = $dob;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasDob()
    {
        return $this->dob != null;
    }
}
