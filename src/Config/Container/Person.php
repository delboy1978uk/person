<?php
/**
 * User: delboy1978uk
 * Date: 06/01/16
 * Time: 21:07
 */

namespace Del\Config\Container;

use Del\Common\Container\RegistrationInterface;
use Del\Repository\Person as PersonRepository;
use Del\Service\Person as PersonService;
use Doctrine\ORM\EntityManager;
use Pimple\Container;

class Person implements RegistrationInterface
{
    /**
     * @param Container $c
     */
    public function addToContainer(Container $c)
    {
        $this->addPersonRepository($c);
        $this->addPersonService($c);
    }

    private function addPersonRepository(Container $c)
    {
        $c['repository.person'] = $c->factory(function ($c) {
            /** @var EntityManager $em */
            $em = $c['doctrine.entity_manager'];
            /** @var PersonRepository $repo */
            $repo = $em->getRepository('Del\Entity\Person');
            return $repo;
        });
    }

    private function addPersonService(Container $c)
    {
        $c['service.person'] = $c->factory(function ($c) {
            $svc = new PersonService($c['doctrine.entity_manager']);
            return $svc;
        });
    }

    public function getEntityPath()
    {
        return 'vendor/delboy1978uk/person/src/Entity';
    }

    public function hasEntityPath()
    {
        return true;
    }


}