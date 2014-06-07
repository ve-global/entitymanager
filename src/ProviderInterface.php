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
 * Interface ProviderInterface
 *
 * @package EntityManager
 * @author  Steve "Uru" West <uruwolf@gmail.com>
 */
interface ProviderInterface
{

	/**
	 * Gets the names of the actions this provider can perform
	 *
	 * @return string[]
	 */
	public function getActions();

}
