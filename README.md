# Object Hydrator

[![Build Status](https://travis-ci.org/jameshalsall/object-hydrator.svg?branch=master)](https://travis-ci.org/jameshalsall/object-hydrator)

A *simple* object hydrator using reflection for constructor or setter based injection.

The hydrator takes an array of raw data and hydrates one or multiple objects of a given class with 
that data.

## Usage

There are two main types of hydrator provided, the `ObjectConstructorFromArrayHydrator` and the 
`ObjectSetterFromArrayHydrator` allowing you to hydrate via a constructor or via setters, respectively.

### Constructor injection

If your object uses constructor injection then you can hydrate your objects using an instance of 
`ObjectConstructorFromArrayHydrator`.

Example:

```php
$data = ['name' => 'Frank Turner', 'job_title' => 'Musician'];
$hyrdator = new ObjectConstructorFromArrayHydrator();
$person = $hydrator->hydrate('Person\Employee', $data);
```

The `Person\Employee` class would look as follows:

```php
<?php

namespace Person;

class Employee
{
    private $name;
    private $jobTitle;
    
    public function __construct($name, $jobTitle)
    {
        $this->name = $name;
        $this->jobTitle = $jobTitle;
    }
}
```

### Setter injection

If your object uses setter injection then you can hydrate your objects using an instance of 
`ObjectSetterFromArrayHydrator`.

Example:

```php
$data = ['name' => 'Frank Turner', 'job_title' => 'Musician'];
$hyrdator = new ObjectSetterFromArrayHydrator();
$person = $hydrator->hydrate('Person\Employee', $data);
```

The `Person\Employee` class would look as follows:

```php
<?php

namespace Person;

class Employee
{
    private $name;
    private $jobTitle;
    
    public function setName($name)
    {
        $this->name = $name;
    }
    
    public function setJobTitle($jobTitle)
    {
        $this->jobTitle = $jobTitle;
    }
}
```

### Hydrating collections

Sometimes you may have an array of arrays, each representing a model's raw data. You can hydrate these in one
method call, for example:

```php
$data = [['name' => 'Frank Turner', 'job_title' => 'Musician'], ['name' => 'Steve Jobs', 'job_title' => 'CEO']];
$hydrator = new ObjectSetterFromArrayHydrator();
$hydratedObjects = $hydrator->hydrateCollection('Person\Employee', $data);
```

### Callable class names

When hydrating an object the first argument that you pass to the `hydrate` or `hydrateCollection` method is the fully
qualified class name (FQCN) that you wish to create an instance of. Instead of a FQCN you can pass a callable. The
callable will receive the raw data (`$data`) that you pass as the second argument.s

Example:

```php
$data = ['name' => 'Frank Turner', 'job_title' => 'Musician'];
$hydrator = new ObjectConstructorFromArrayHydrator();
$person = $hydrator->hydrate(function ($rawData) {
    if ($rawData['job_title' === 'Musician']) {
        return 'Person\Musician';
    }

    return 'Person\Employee';
}, $data);
```

## Roadmap

* Add factory to improve readability of instantiating hydrators
* Explore option of adding support for the hydration of nested objects
* Allow instances of objects to be passed to the hydrator instead of class names