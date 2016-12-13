<?php
declare(strict_types=1);

namespace Lookyman\Rundeck\Api\Endpoints\Job;

use GuzzleHttp\Promise\PromiseInterface;
use GuzzleHttp\Psr7\Request;
use Lookyman\Rundeck\Api\Client;

class Schedule
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
	 * @param string $id
	 * @return PromiseInterface
	 */
	public function enable(string $id): PromiseInterface
	{
		return $this->client->getConfiguration()->getGuzzle()->sendAsync(
			new Request('POST', $this->client->getConfiguration()->getBaseUri() . sprintf('/job/%s/schedule/enable', urlencode($id)))
		);
	}

	/**
	 * @param string $id
	 * @return PromiseInterface
	 */
	public function disable(string $id): PromiseInterface
	{
		return $this->client->getConfiguration()->getGuzzle()->sendAsync(
			new Request('POST', $this->client->getConfiguration()->getBaseUri() . sprintf('/job/%s/schedule/disable', urlencode($id)))
		);
	}
}
