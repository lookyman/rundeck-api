<?php
declare(strict_types=1);

namespace Lookyman\Rundeck\Api\Endpoints\Storage;

use Lookyman\Rundeck\Api\Client;

class Storage
{
	/**
	 * @var Client
	 */
	private $client;

	/**
	 * @param Client $client
	 */
	public function __construct(Client $client)
	{
		$this->client = $client;
	}
}
