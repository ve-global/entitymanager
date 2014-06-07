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
		$this->registry = \Mockery::mock('EntityManager\ProviderRegistry');
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
