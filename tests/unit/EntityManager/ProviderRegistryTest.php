<?php
/**
 * @author VeDev Team Kraken
 * @license Closed source, do not copy or distribute in any form.
 * @copyright 2014 Ve Interactive Ltd.
 * @link http://veinteractive.com
 */

namespace Ve\EntityManager;

use Codeception\TestCase\Test;

/**
 * Class ProviderRegistryTest
 *
 * @package EntityManager
 *
 * @coversDefaultClass Ve\EntityManager\ProviderRegistry
 */
class ProviderRegistryTest extends Test
{

	/**
	 * @var ProviderRegistry
	 */
	protected $registry;

	protected function _before()
	{
		$this->registry = new ProviderRegistry;
	}

	/**
	 * @group EntityManager
	 */
	public function testRegisteringProviders()
	{
		$uri = 'some/entity';
		$provider = 'Some\Fake\Class';

		$this->registry->registerProvider($uri, $provider);

		$this->assertEquals(
			$provider,
			$this->registry->getProvider($uri)
		);

		$this->assertEquals(
			[$uri => $provider],
			$this->registry->getProviders()
		);
	}

	/**
	 * @group             EntityManager
	 * @expectedException \Ve\EntityManager\UnknownProviderException
	 */
	public function testGettingAnInvalidProvider()
	{
		$this->registry->getProvider('should/not/exist');
	}

	/**
	 * @group EntityManager
	 */
	public function testGettingUris()
	{
		$uri = 'some/entity';
		$provider = 'Some\Fake\Class';

		$this->registry->registerProvider($uri, $provider);

		$this->assertEquals(
			[$uri],
			$this->registry->getURIs()
		);
	}

	public function testGetInstance()
	{
		$uri = 'some/entity';
		$provider = 'Ve\EntityManager\BasicProviderStub';

		$this->registry->registerProvider($uri, $provider);

		$this->assertInstanceOf(
			$provider,
			$this->registry->getProviderInstance($uri)
		);
	}

}
