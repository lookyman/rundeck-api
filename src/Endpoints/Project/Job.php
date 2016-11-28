<?php
declare(strict_types=1);

namespace Lookyman\Rundeck\Api\Endpoints\Project;

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
	 * @param string $project
	 * @return PromiseInterface
	 */
	public function list(string $project): PromiseInterface
	{
		return $this->client->getConfiguration()->getGuzzle()->sendAsync(new Request('GET', $this->client->getConfiguration()->getBaseUri() . sprintf('/project/%s/jobs', urlencode($project))));
	}
}
