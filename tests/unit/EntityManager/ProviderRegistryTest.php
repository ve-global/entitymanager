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

/**
 * Class ProviderRegistryTest
 *
 * @package EntityManager
 * @author  Steve "Uru" West <uruwolf@gmail.com>
 *
 * @coversDefaultClass EntityManager\ProviderRegistry
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
	 * @expectedException \EntityManager\UnknownProviderException
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


}
