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
	 * @param array $params
	 * @return PromiseInterface
	 */
	public function run(string $id, array $params = []): PromiseInterface
	{
		return $this->client->getConfiguration()->getGuzzle()->sendAsync(
			new Request('POST', $this->client->getConfiguration()->getBaseUri() . sprintf('/job/%s/run', urlencode($id)), [], $this->client->getConfiguration()->getFormat()->formatParams($params))
		);
	}

	/**
	 * @param string $id
	 * @param array $params
	 * @return PromiseInterface
	 */
	public function get(string $id, array $params = []): PromiseInterface
	{
		return $this->client->getConfiguration()->getGuzzle()->sendAsync(
			new Request('GET', $this->client->getConfiguration()->getBaseUri() . sprintf('/job/%s', urlencode($id)), [], $this->client->getConfiguration()->getFormat()->formatParams($params))
		);
	}

	/**
	 * @param string $id
	 * @return PromiseInterface
	 */
	public function delete(string $id): PromiseInterface
	{
		return $this->client->getConfiguration()->getGuzzle()->sendAsync(
			new Request('DELETE', $this->client->getConfiguration()->getBaseUri() . sprintf('/job/%s', urlencode($id)))
		);
	}

	/**
	 * @param string[] $ids
	 * @return PromiseInterface
	 */
	public function bulkDelete(array $ids): PromiseInterface
	{
		return $this->client->getConfiguration()->getGuzzle()->sendAsync(
			new Request('DELETE', $this->client->getConfiguration()->getBaseUri() . '/jobs/delete', [], $this->client->getConfiguration()->getFormat()->formatParams(['ids' => $ids]))
		);
	}

	/**
	 * @return Execution
	 */
	public function execution(): Execution
	{
		return new Execution($this->client);
	}

	/**
	 * @return Schedule
	 */
	public function schedule(): Schedule
	{
		return new Schedule($this->client);
	}
}
