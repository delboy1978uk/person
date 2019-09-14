<?php

namespace Del\Person\Repository;

use Del\Person\Entity\Person as PersonEntity;
use Del\Person\Criteria\PersonCriteria;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;

class PersonRepository extends EntityRepository
{
    /** @var QueryBuilder $qb */
    private $qb;

    /**
     * @param PersonEntity $person
     * @return PersonEntity
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(PersonEntity $person)
    {
        $this->_em->persist($person);
        $this->_em->flush();
        return $person;
    }

    /**
     * @param PersonEntity $person
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function delete(PersonEntity $person)
    {
        $this->_em->remove($person);
        $this->_em->flush();
    }



    /**
     * @param PersonCriteria $criteria
     * @return array
     */
    public function findByCriteria(PersonCriteria $criteria)
    {
        $this->qb = $this->createQueryBuilder('p');

        $this->checkId($criteria);
        $this->checkFirstname($criteria);
        $this->checkMiddlename($criteria);
        $this->checkLastname($criteria);
        $this->checkAka($criteria);
        $this->checkBirthplace($criteria);
        $this->checkCountry($criteria);
        $this->checkDob($criteria);
        $this->checkOrder($criteria);
        $this->checkLimit($criteria);
        $this->checkOffset($criteria);

        $query = $this->qb->getQuery();
        unset($this->qb);
        return $query->getResult();
    }


    /**
     * @param PersonCriteria $criteria
     */
    private function checkId(PersonCriteria $criteria)
    {
        if($criteria->hasId()) {
            $this->qb->where('p.id = :id');
            $this->qb->setParameter('id', $criteria->getId());
        }
    }


    /**
     * @param PersonCriteria $criteria
     */
    private function checkFirstname(PersonCriteria $criteria)
    {
        if($criteria->hasFirstname()) {
            $this->qb->where('p.firstname = :firstname');
            $this->qb->setParameter('firstname', $criteria->getFirstname());
        }
    }


    /**
     * @param PersonCriteria $criteria
     */
    private function checkMiddlename(PersonCriteria $criteria)
    {
        if($criteria->hasMiddlename()) {
            $this->qb->where('p.middlename = :middlename');
            $this->qb->setParameter('middlename', $criteria->getMiddlename());
        }
    }

    /**
     * @param PersonCriteria $criteria
     */
    private function checkLastname(PersonCriteria $criteria)
    {
        if($criteria->hasLastname()) {
            $this->qb->where('p.lastname = :lastname');
            $this->qb->setParameter('lastname', $criteria->getLastname());
        }
    }

    /**
     * @param PersonCriteria $criteria
     */
    private function checkAka(PersonCriteria $criteria)
    {
        if($criteria->hasAka()) {
            $this->qb->andWhere('p.aka = :aka');
            $this->qb->setParameter('aka', $criteria->getAka());
        }
    }

    /**
     * @param PersonCriteria $criteria
     */
    private function checkBirthplace(PersonCriteria $criteria)
    {
        if($criteria->hasBirthplace()) {
            $this->qb->andWhere('p.birthplace = :birthplace');
            $this->qb->setParameter('birthplace', $criteria->getBirthplace());
        }
    }

    /**
     * @param PersonCriteria $criteria
     */
    private function checkCountry(PersonCriteria $criteria)
    {
        if($criteria->hasCountry()) {
            $this->qb->andWhere('p.country = :country');
            $this->qb->setParameter('country', $criteria->getCountry());
        }
    }

    /**
     * @param PersonCriteria $criteria
     */
    private function checkDob(PersonCriteria $criteria)
    {
        if($criteria->hasDob()) {
            $this->qb->andWhere('p.dob = :dob');
            $this->qb->setParameter('dob', $criteria->getDob());
        }
    }


    /**
     * @param PersonCriteria $criteria
     */
    private function checkOrder(PersonCriteria $criteria)
    {
        $criteria->hasOrder() ? $this->qb->addOrderBy('p.'.$criteria->getOrder(), $criteria->getOrderDirection()) : null;

    }

    /**
     * @param PersonCriteria $criteria
     */
    private function checkLimit(PersonCriteria $criteria)
    {
        $criteria->hasLimit() ? $this->qb->setMaxResults($criteria->getLimit()) : null;
    }

    /**
     * @param PersonCriteria $criteria
     */
    private function checkOffset(PersonCriteria $criteria)
    {
        $criteria->hasOffset() ? $this->qb->setFirstResult($criteria->getOffset()) : null;
    }
}
