# person
[![Build Status](https://travis-ci.org/delboy1978uk/person.png?branch=master)](https://travis-ci.org/delboy1978uk/person) [![Code Coverage](https://scrutinizer-ci.com/g/delboy1978uk/person/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/delboy1978uk/person/?branch=master) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/delboy1978uk/person/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/delboy1978uk/person/?branch=master) <br />
A persistable Person Entity, Collection, Repository, and Service, written in PHP. 
##Installation
Install via composer into your project:
```
composer require delboy1978uk/person
```
##The Person Entity
Usage as follows. The ```$date``` variable is a DateTime object. ```$country``` is a a Del\Entity\Country object.
```php
$del = new Person();
$del->setFirstname('Derek')
    ->setMiddlename('Stephen')
    ->setLastname('McLean)
    ->setAka('Del Boy')
    ->setDob($date)
    ->setBirthplace('Glasgow, Scotland')
    ->setCountry($country);
```
##The Person Collection
Or people, as we might like to call it. Extends ArrayIterator and contains the following (additional) methods:
```php
$collection->update($person); // Updates the entity in the collection with fresh details
$collection->append($person); // Adds an entity to the collection
$collection->current(); // Retrieves the currently selected Person object
$collection->findKey($person); // Retrieves the array offset key for any Person in the collection
$collection->findById($id); // Retrieves a Person from the collection by their Id
```
##The Person Service
Contains a few methods for dealing with Person objects. 
```php
$svc->createFromArray($data); // Person object factory method accepting an array
$svc->toArray($person); // Pass a Person, receive an array
$svc->savePerson($person); // Saves a Person (adds or updates) to the database
$svc->getRepository(); // Gets the Person Repository
```
##The Person Repository
Currently only contains save() and delete() methods.
##Setup and Usage
You can use delboy1978uk/common, which contains Doctrine2 ORM for database persistance, and Pimple as a dependency
injection container. You can register the Person DIC items using the Del\Config\Container\Person object. See 
delboy1978uk/common for details.
```php
$config = new \Del\Config\Container\Person();
ContainerService::getInstance()->registerToContainer($config);
```