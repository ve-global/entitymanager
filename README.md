# Entity Manager

[![Build Status](https://travis-ci.org/ve-interactive/entitymanager.svg?branch=master)](https://travis-ci.org/ve-interactive/entitymanager)
[![Code Coverage](https://scrutinizer-ci.com/g/ve-interactive/entitymanager/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/ve-interactive/entitymanager/?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/ve-interactive/entitymanager/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/ve-interactive/entitymanager/?branch=master)

The aim of this package is to provide a framework for managing entities within an application as well as providing
interfaces to do so. It will tie in with whatever other framework you want to use so there's no restrictions!

## Concepts

 - Entity: A thing in your application. Eg, product, blog, user, order.
 - Provider: A thing that knows how to load entities of a particular type.
 - URI: Unique identifier for every individual entity that contains the entity type.
 - URL: Unique identifier that can be used to access the entity externally.

# Getting started

The package should be accessed via the `EntityManager`, this contains the core package logic.
To get started you must first create providers then make the `EntityManager` aware of them via the `ProviderRegistry`

## Creating a provider

A provider class should know how to load its entity type.

To create a provider you extend the `AbstractProvider` class. No methods need to actually be implemented but if you do
not implement any then your provider will not do anything!

The basic example below shows a sample product provider.
```php
<?php
class ProductProvider extends \Ve\EntityManager\AbstractProvider
{

	public function getOne($id)
	{
		return Model_Product::find('first', ['where' => ['id', $id]]);
	}

	public function getUrl($identifier)
	{
		return 'product/'.$identifier;
	}

}
```

The provider then needs to be registered with the `ProviderRegistry`.
```php
$providerRegistry->registerProvider('product', 'ProductProvider');
```

## Using the `EntityManager`

Once we have a provider and a provider registry we can start resolving entities.

At the moment there's only method support for getting an entity and getting an entity URL.

```php
<?php

$registry = new ProviderRegistry;
// Register our providers here

$em = new EntityManager($registry);

var_dump($em->getEntity('product:1'));
var_dump($em->getEntityUrl('product:1'));
```
