<?php
declare(strict_types=1);

namespace Lookyman\Rundeck\Api\Endpoints\Project;

use GuzzleHttp\Promise\PromiseInterface;
use GuzzleHttp\Psr7\Request;
use Lookyman\Rundeck\Api\Client;

class Project
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
	public function list(): PromiseInterface
	{
		return $this->client->getConfiguration()->getGuzzle()->sendAsync(new Request('GET', $this->client->getConfiguration()->getBaseUri() . '/projects'));
	}

	/**
	 * @return Job
	 */
	public function job(): Job
	{
		return new Job($this->client);
	}
}
