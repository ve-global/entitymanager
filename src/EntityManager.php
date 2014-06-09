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

	public function performAction($uri, $action, $data = null)
	{
		$instance = $this->registry->getProviderInstance($uri);

		// TODO: check if the action actually exists

		return $instance->{$action}();
	}


}
