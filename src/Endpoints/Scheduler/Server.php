<?php
declare(strict_types=1);

namespace Lookyman\Rundeck\Api\Endpoints\Scheduler;

use GuzzleHttp\Promise\PromiseInterface;
use Lookyman\Rundeck\Api\Client;
use GuzzleHttp\Psr7\Request;

class Server
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

	/**
	 * @param string $uuid
	 * @return PromiseInterface
	 */
	public function jobs(string $uuid): PromiseInterface
	{
		return $this->client->getConfiguration()->getGuzzle()->sendAsync(
			new Request('GET', $this->client->getConfiguration()->getBaseUri() . sprintf('/scheduler/server/%s/jobs', urlencode($uuid)))
		);
	}
}
