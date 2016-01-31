<?php

namespace Del\Repository;

use Del\Entity\Person as PersonEntity;
use Del\Criteria\PersonCriteria;
use Doctrine\ORM\EntityRepository;

class Person extends EntityRepository
{
    /**
     * @param PersonEntity $person
     * @return PersonEntity
     */
    public function save(PersonEntity $person)
    {
        $this->_em->merge($person);
        $this->_em->flush();
        return $person;
    }
    /**
     * @param PersonEntity $person
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
        $qb = $this->createQueryBuilder('p');

        if($criteria->hasFirstname()) {
            $qb->where('p.firstname = :firstname');
            $qb->setParameter('firstname', $criteria->getFirstname());
        }

        if($criteria->hasMiddlename()) {
            $qb->where('p.middlename = :middlename');
            $qb->setParameter('middlename', $criteria->getFirstname());
        }

        if($criteria->hasLastname()) {
            $qb->where('p.lastname = :lastname');
            $qb->setParameter('lastname', $criteria->getLastname());
        }

        if($criteria->hasAka()) {
            $qb->andWhere('p.aka = :aka');
            $qb->setParameter('aka', $criteria->getAka());
        }

        if($criteria->hasBirthplace()) {
            $qb->andWhere('p.birthplace = :birthplace');
            $qb->setParameter('birthplace', $criteria->getBirthplace());
        }

        if($criteria->hasCountry()) {
            $qb->andWhere('p.country = :country');
            $qb->setParameter('country', $criteria->getCountry());
        }

        if($criteria->hasDob()) {
            $qb->andWhere('p.dob = :dob');
            $qb->setParameter('dob', $criteria->getDob());
        }

        $criteria->hasOrder() ? $qb->addOrderBy($criteria->getOrder()) : null;
        $criteria->hasLimit() ? $qb->setMaxResults($criteria->getLimit()) : null;
        $criteria->hasOffset() ? $qb->setFirstResult($criteria->getOffset()) : null;

        $query = $qb->getQuery();

        return $query->getResult();
    }
}
