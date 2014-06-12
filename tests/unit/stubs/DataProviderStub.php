<?php
/**
 * @author VeDev Team Kraken
 * @license Closed source, do not copy or distribute in any form.
 * @copyright 2014 Ve Interactive Ltd.
 * @link http://veinteractive.com
 */

namespace Ve\EntityManager;

class DataProviderStub extends AbstractProvider
{

	protected $data = [
		1 => ['This is the first entity'],
		2 => ['This is the second entity'],
		3 => ['This is the third entity'],
	];

	public function getOne($id)
	{
		return $this->data[$id];
	}

	public function getUrl($identifier)
	{
		return 'product/'.$identifier;
	}

}
