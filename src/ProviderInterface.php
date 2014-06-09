<?php
/**
 * @author VeDev Team Kraken
 * @license Closed source, do not copy or distribute in any form.
 * @copyright 2014 Ve Interactive Ltd.
 * @link http://veinteractive.com
 */

namespace Ve\EntityManager;

/**
 * Interface ProviderInterface
 *
 * @package EntityManager
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
