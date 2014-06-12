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

	public function testGetUriParts()
	{
		$uri = 'product:1';

		$this->assertEquals(
			[
				'type' => 'product',
				'identifier' => 1,
			],
			$this->manager->getURIParts($uri)
		);
	}

	/**
	 * @expectedException \Ve\EntityManager\InvalidURIException
	 */
	public function testGetUriPartsWithInvalidUri()
	{
		$uri = 'product';
		$this->manager->getURIParts($uri);
	}

	public function testGetEntity()
	{
		$type = 'product';
		$id = 1;
		$uri = "$type:$id";

		$this->registry->shouldReceive('getProviderInstance')
			->with($type)
			->andReturn(new DataProviderStub)
			->once();

		$this->assertEquals(
			['This is the first entity'],
			$this->manager->getEntity($uri)
		);
	}

	public function testGetEntityUrl()
	{
		$this->assertEquals(
			'product/1',
			$this->manager->getEntityUrl('product:1')
		);
	}

}
