<?php
/**
 * @author VeDev Team Kraken
 * @license Closed source, do not copy or distribute in any form.
 * @copyright 2014 Ve Interactive Ltd.
 * @link http://veinteractive.com
 */

namespace Ve\EntityManager;

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
