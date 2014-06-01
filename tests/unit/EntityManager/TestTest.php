<?php

namespace EntityManager;

use Codeception\TestCase\Test as BaseClass;

/**
 * Test test class
 *
 * @coversDefaultClass EntityManager\Test
 */
class TestTest extends BaseClass
{

	/**
	 * @var Test
	 */
	protected $test;

	public function _before()
	{
		$this->test = new Test;
	}

	/**
	 * @covers ::returnTrue
	 * @group  EntityManager
	 */
	public function testReturnTrue()
	{
		$this->assertTrue($this->test->returnTrue());
	}


}
