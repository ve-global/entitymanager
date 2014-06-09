<?php
/**
 * @author VeDev Team Kraken
 * @license Closed source, do not copy or distribute in any form.
 * @copyright 2014 Ve Interactive Ltd.
 * @link http://veinteractive.com
 */

namespace Ve\EntityManager;

use Codeception\TestCase\Test;

class EntityManagerTest extends Test
{

	/**
	 * @var EntityManager
	 */
	protected $manager;

	/**
	 * @var \Mockery\Mock
	 */
	protected $registry;

	protected function _before()
	{
		/** @var ProviderRegistry $registry */
		$this->registry = \Mockery::mock('Ve\EntityManager\ProviderRegistry');
		$this->manager = new EntityManager($this->registry);
	}

	public function testGettingAndSettingRegistry()
	{
		$registry = new ProviderRegistry;

		$this->manager->setRegistry($registry);

		$this->assertEquals(
			$registry,
			$this->manager->getRegistry()
		);
	}

	public function testPerformAction()
	{
		$uri = 'foobar';
		$provider = new BasicProviderStub;

		$this->registry
			->shouldReceive('getProviderInstance')
			->with($uri)
			->andReturn($provider);

		$this->assertTrue(
			$this->manager->performAction($uri, 'create')
		);
	}


}
