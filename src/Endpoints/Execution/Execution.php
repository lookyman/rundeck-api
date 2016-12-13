<?php
declare(strict_types=1);

namespace Lookyman\Rundeck\Api\Endpoints\Execution;

use GuzzleHttp\Promise\PromiseInterface;
use GuzzleHttp\Psr7\Request;
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

	/**
	 * @param string $id
	 * @return PromiseInterface
	 */
	public function info(string $id): PromiseInterface
	{
		return $this->client->getConfiguration()->getGuzzle()->sendAsync(
			new Request('GET', $this->client->getConfiguration()->getBaseUri() . sprintf('/execution/%s', urlencode($id)))
		);
	}

	/**
	 * @param string $id
	 * @return PromiseInterface
	 */
	public function delete(string $id): PromiseInterface
	{
		return $this->client->getConfiguration()->getGuzzle()->sendAsync(
			new Request('DELETE', $this->client->getConfiguration()->getBaseUri() . sprintf('/execution/%s', urlencode($id)))
		);
	}

	/**
	 * @param int[] $ids
	 * @return PromiseInterface
	 */
	public function bulkDelete(array $ids): PromiseInterface
	{
		return $this->client->getConfiguration()->getGuzzle()->sendAsync(
			new Request('POST', $this->client->getConfiguration()->getBaseUri() . '/executions/delete', [], $this->client->getConfiguration()->getFormat()->formatParams(['ids' => $ids]))
		);
	}

	/**
	 * @param string $id
	 * @return PromiseInterface
	 */
	public function state(string $id): PromiseInterface
	{
		return $this->client->getConfiguration()->getGuzzle()->sendAsync(
			new Request('GET', $this->client->getConfiguration()->getBaseUri() . sprintf('/execution/%s/state', urlencode($id)))
		);
	}

	/**
	 * @param string $id
	 * @param array $params
	 * @return PromiseInterface
	 */
	public function abort(string $id, array $params = []): PromiseInterface
	{
		return $this->client->getConfiguration()->getGuzzle()->sendAsync(
			new Request(
				'GET',
				$this->client->getConfiguration()->getBaseUri() . sprintf('/execution/%s/abort', urlencode($id)),
				[],
				$this->client->getConfiguration()->getFormat()->formatParams($params))
		);
	}

	/**
	 * @return Output
	 */
	public function output(): Output
	{
		return new Output($this->client);
	}
}
