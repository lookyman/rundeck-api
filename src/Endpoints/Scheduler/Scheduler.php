<?php
declare(strict_types=1);

namespace Lookyman\Rundeck\Api\Endpoints\Scheduler;

use GuzzleHttp\Promise\PromiseInterface;
use Lookyman\Rundeck\Api\Client;
use GuzzleHttp\Psr7\Request;

class Scheduler
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
	 * @return PromiseInterface
	 */
	public function takeover(/* todo args */): PromiseInterface
	{
		// todo
	}

	/**
	 * @return Server
	 */
	public function server(): Server
	{
		return new Server($this->client);
	}

	/**
	 * @return PromiseInterface
	 */
	public function jobs(): PromiseInterface
	{
		return $this->client->getConfiguration()->getGuzzle()->sendAsync(new Request('GET', $this->client->getConfiguration()->getBaseUri() . '/scheduler/jobs'));
	}
}
