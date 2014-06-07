<?php
/**
 * @package   EntityManager
 * @author    Steve "Uru" West <uruwolf@gmail.com>
 * @license   MIT License
 * @copyright 2014 Steve "Uru" West
 * @link      http://github.com/stevewest/entity-manager
 */

namespace EntityManager;

use Codeception\TestCase\Test;

class AbstractProviderTest extends Test
{

	/**
	 * @var BasicProviderStub
	 */
	protected $provider;

	protected function _before()
	{
		$this->provider = new BasicProviderStub;
	}

	public function testGetActions()
	{
		$this->assertEquals(
			['create'],
			$this->provider->getActions()
		);
	}

}
