<?php
/**
 * @package   EntityManager
 * @author    Steve "Uru" West <uruwolf@gmail.com>
 * @license   MIT License
 * @copyright 2014 Steve "Uru" West
 * @link      http://github.com/stevewest/entity-manager
 */

namespace EntityManager;

/**
 * Provides default behaviour for providers.
 *
 * @package EntityManager
 * @author  Steve "Uru" West <uruwolf@gmail.com>
 */
class AbstractProvider implements ProviderInterface
{

	/**
	 * Contains a list of methods that a provider could possibly expose.
	 *
	 * @var string[]
	 */
	protected $routableMethods = [
		'create',
		'get',
		'getOne',
		'delete',
		'edit'
	];

	/**
	 * Gets the names of the actions this provider can perform
	 *
	 * @return string[]
	 */
	public function getActions()
	{
		$actions = [];

		foreach ($this->routableMethods as $methodName)
		{
			if (method_exists($this, $methodName))
			{
				$actions[] = $methodName;
			}
		}

		return $actions;
	}

}
