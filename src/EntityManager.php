<?php
/**
 * @author VeDev Team Kraken
 * @license Closed source, do not copy or distribute in any form.
 * @copyright 2014 Ve Interactive Ltd.
 * @link http://veinteractive.com
 */

namespace Ve\EntityManager;


class EntityManager
{

	/**
	 * @var ProviderRegistry
	 */
	protected $registry;

	public function __construct(ProviderRegistry $registry)
	{
		$this->registry = $registry;
	}

	/**
	 * @return ProviderRegistry
	 */
	public function getRegistry()
	{
		return $this->registry;
	}

	/**
	 * @param ProviderRegistry $registry
	 */
	public function setRegistry(ProviderRegistry $registry)
	{
		$this->registry = $registry;
	}

	/**
	 * Tries to get an entity based on URI and identifier.
	 *
	 * @param string $uri Expects a format like 'product:1'
	 *
	 * @return mixed
	 *
	 * @throws EntityNotReadableException
	 * @throws UnknownEntityException
	 */
	public function getEntity($uri)
	{
		$uriParts = $this->getURIParts($uri);

		// Get our provider
		/** @var AbstractProvider $provider */
		$provider = $this->getRegistry()->getProviderInstance($uriParts['type']);

		// Check we can read it
		if ( ! $provider->canProvide('getOne'))
		{
			throw new EntityNotReadableException('Entities of type ' . $uriParts['type'] . ' are not readable.');
		}

		// Try and load an entity
		$entity = $provider->getOne($uriParts['identifier']);

		if ($entity === null)
		{
			throw new UnknownEntityException($uriParts['identifier'] . ' is not a known entity for type '.$uriParts['type']);
		}

		return $entity;
	}

	/**
	 * Returns the entity type and identifier specified in the URI
	 *
	 * @param string $uri
	 *
	 * @return array
	 */
	public function getURIParts($uri)
	{
		$parts = explode(':', $uri);

		if (count($parts) <= 1)
		{
			throw new InvalidURIException('The URI: '.$uri.' is not a valid entity URI');
		}

		return [
			'type' => $parts[0],
			'identifier' => $parts[1],
		];
	}

}
