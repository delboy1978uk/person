<?php

declare(strict_types=1);

namespace Del\Person\Repository;

use Del\Person\Entity\Person as PersonEntity;
use Del\Person\Criteria\PersonCriteria;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use PDO;

class PersonRepository extends EntityRepository
{
    private QueryBuilder $qb;

    public function save(PersonEntity $person): PersonEntity
    {
        $this->_em->persist($person);
        $this->_em->flush();

        return $person;
    }

    public function delete(PersonEntity $person): void
    {
        $this->_em->remove($person);
        $this->_em->flush();
    }

    public function findByCriteria(PersonCriteria $criteria): array
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

    private function checkId(PersonCriteria $criteria): void
    {
        if($criteria->hasId()) {
            $this->qb->where('p.id = :id');
            $this->qb->setParameter('id', $criteria->getId(), PDO::PARAM_INT);
        }
    }

    private function checkFirstname(PersonCriteria $criteria): void
    {
        if($criteria->hasFirstname()) {
            $this->qb->andWhere('p.firstname = :firstname');
            $this->qb->setParameter('firstname', $criteria->getFirstname(), PDO::PARAM_STR);
        }
    }

    private function checkMiddlename(PersonCriteria $criteria): void
    {
        if($criteria->hasMiddlename()) {
            $this->qb->andWhere('p.middlename = :middlename');
            $this->qb->setParameter('middlename', $criteria->getMiddlename(), PDO::PARAM_STR);
        }
    }

    private function checkLastname(PersonCriteria $criteria): void
    {
        if($criteria->hasLastname()) {
            $this->qb->andWhere('p.lastname = :lastname');
            $this->qb->setParameter('lastname', $criteria->getLastname(), PDO::PARAM_STR);
        }
    }

    private function checkAka(PersonCriteria $criteria): void
    {
        if($criteria->hasAka()) {
            $this->qb->andWhere('p.aka = :aka');
            $this->qb->setParameter('aka', $criteria->getAka(), PDO::PARAM_STR);
        }
    }

    private function checkBirthplace(PersonCriteria $criteria): void
    {
        if($criteria->hasBirthplace()) {
            $this->qb->andWhere('p.birthplace = :birthplace');
            $this->qb->setParameter('birthplace', $criteria->getBirthplace(), PDO::PARAM_STR);
        }
    }

    private function checkCountry(PersonCriteria $criteria): void
    {
        if($criteria->hasCountry()) {
            $this->qb->andWhere('p.country = :country');
            $this->qb->setParameter('country', $criteria->getCountry(), PDO::PARAM_STR);
        }
    }

    private function checkDob(PersonCriteria $criteria): void
    {
        if($criteria->hasDob()) {
            $this->qb->andWhere('p.dob = :dob');
            $this->qb->setParameter('dob', $criteria->getDob(), PDO::PARAM_STR);
        }
    }

    private function checkOrder(PersonCriteria $criteria): void
    {
        $criteria->hasOrder() ? $this->qb->addOrderBy('p.'.$criteria->getOrder(), $criteria->getOrderDirection()) : null;
    }

    private function checkLimit(PersonCriteria $criteria): void
    {
        $criteria->hasLimit() ? $this->qb->setMaxResults($criteria->getLimit()) : null;
    }

    private function checkOffset(PersonCriteria $criteria): void
    {
        $criteria->hasOffset() ? $this->qb->setFirstResult($criteria->getOffset()) : null;
    }
}
