<?php
/**
 * @author VeDev Team Kraken
 * @license Closed source, do not copy or distribute in any form.
 * @copyright 2014 Ve Interactive Ltd.
 * @link http://veinteractive.com
 */

namespace Ve\EntityManager;

/**
 * Provides default behaviour for providers.
 *
 * @package EntityManager
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

	/**
	 * Checks if the provider can satisfy the given method
	 *
	 * @param string $method
	 *
	 * @return bool
	 */
	public function canProvide($method)
	{
		return in_array($method, $this->getActions());
	}

}
