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
	 * @param array $params
	 * @return PromiseInterface
	 */
	public function list(string $project, array $params = []): PromiseInterface
	{
		return $this->client->getConfiguration()->getGuzzle()->sendAsync(
			new Request('GET', $this->client->getConfiguration()->getBaseUri() . sprintf('/project/%s/jobs', urlencode($project)), [], $this->client->getConfiguration()->getFormat()->formatParams($params))
		);
	}

	/**
	 * @param string $project
	 * @param array $params
	 * @return PromiseInterface
	 */
	public function export(string $project, array $params = []): PromiseInterface
	{
		return $this->client->getConfiguration()->getGuzzle()->sendAsync(
			new Request('GET', $this->client->getConfiguration()->getBaseUri() . sprintf('/project/%s/jobs/export', urlencode($project)), $this->client->getConfiguration()->getFormat()->formatParams($params))
		);
	}

	/**
	 * @return PromiseInterface
	 */
	public function import(): PromiseInterface
	{
		throw new \LogicException('Not implemented');
	}
}
