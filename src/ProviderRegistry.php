<?php
/**
 * @author VeDev Team Kraken
 * @license Closed source, do not copy or distribute in any form.
 * @copyright 2014 Ve Interactive Ltd.
 * @link http://veinteractive.com
 */

namespace Ve\EntityManager;

/**
 * Acts as a central registry and access point for entity providers
 *
 * @package EntityManager
 */
class ProviderRegistry
{

	/**
	 * @var string[]
	 */
	protected $providers = [];

	/**
	 * Registers a new entity provider
	 *
	 * @param string $uri
	 * @param string $class
	 */
	public function registerProvider($uri, $class)
	{
		$this->providers[$uri] = $class;
	}

	/**
	 * Gets a single provider
	 *
	 * @param  string $uri
	 *
	 * @return string
	 *
	 * @throws UnknownProviderException
	 */
	public function getProvider($uri)
	{
		if ( ! array_key_exists($uri, $this->providers))
		{
			throw new UnknownProviderException($uri . ' is not a known entity provider.');
		}

		return $this->providers[$uri];
	}

	/**
	 * Gets a list of all known providers
	 *
	 * @return ProviderInterface[]
	 */
	public function getProviders()
	{
		return $this->providers;
	}

	/**
	 * Returns a list of known URIs for providers
	 *
	 * @return string[]
	 */
	public function getURIs()
	{
		return array_keys($this->providers);
	}

	/**
	 * Gets a constructed instance of a provider
	 *
	 * @param string $uri
	 *
	 * @return ProviderInterface
	 */
	public function getProviderInstance($uri)
	{
		$providerClass = $this->getProvider($uri);

		return new $providerClass;
	}

}
