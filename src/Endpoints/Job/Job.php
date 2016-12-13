<?php
declare(strict_types=1);

namespace Lookyman\Rundeck\Api\Endpoints\Job;

use GuzzleHttp\Promise\PromiseInterface;
use GuzzleHttp\Psr7\Request;
use Lookyman\Rundeck\Api\Client;

class Job
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
	public function run(string $id): PromiseInterface
	{
		return $this->client->getConfiguration()->getGuzzle()->sendAsync(
			new Request('POST', $this->client->getConfiguration()->getBaseUri() . sprintf('/job/%s/run', urlencode($id)))
		);
	}
}
