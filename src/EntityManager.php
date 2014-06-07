<?php
/**
 * @package   EntityManager
 * @author    Steve "Uru" West <uruwolf@gmail.com>
 * @license   MIT License
 * @copyright 2014 Steve "Uru" West
 * @link      http://github.com/stevewest/entity-manager
 */

namespace EntityManager;


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
