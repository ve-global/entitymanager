<?php
/**
 * @author VeDev Team Kraken
 * @license MIT
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

	/**
	 * Returns the URL that can be used to access this entity. This is an actual URL (sans base site name) that the user
	 * can use to access the entity.
	 *
	 * @param string $uri
	 *
	 * @return string
	 */
	public function getEntityUrl($uri)
	{
		$uriParts = $this->getURIParts($uri);

		// Get our provider
		/** @var AbstractProvider $provider */
		$provider = $this->getRegistry()->getProviderInstance($uriParts['type']);

		// Check we can read it
		if ( ! $provider->canProvide('getUrl'))
		{
			throw new ResolutionException('Entities of type '.$uriParts['type'].' do not have urls');
		}

		// Try and load the url
		return $provider->getUrl($uriParts['identifier']);
	}

}
