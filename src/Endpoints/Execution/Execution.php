<?php
declare(strict_types=1);

namespace Lookyman\Rundeck\Api\Endpoints\Execution;

use Lookyman\Rundeck\Api\Client;

class Execution
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
