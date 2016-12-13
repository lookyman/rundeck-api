<?php
declare(strict_types=1);

namespace Lookyman\Rundeck\Api\Endpoints\Job;

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
	public function enable(string $id): PromiseInterface
	{
		return $this->client->getConfiguration()->getGuzzle()->sendAsync(
			new Request('POST', $this->client->getConfiguration()->getBaseUri() . sprintf('/job/%s/execution/enable', urlencode($id)))
		);
	}

	/**
	 * @param string $id
	 * @return PromiseInterface
	 */
	public function disable(string $id): PromiseInterface
	{
		return $this->client->getConfiguration()->getGuzzle()->sendAsync(
			new Request('POST', $this->client->getConfiguration()->getBaseUri() . sprintf('/job/%s/execution/disable', urlencode($id)))
		);
	}

	/**
	 * @param string[] $ids
	 * @return PromiseInterface
	 */
	public function bulkEnable(array $ids): PromiseInterface
	{
		return $this->client->getConfiguration()->getGuzzle()->sendAsync(
			new Request('POST', $this->client->getConfiguration()->getBaseUri() . '/jobs/execution/enable', [], $this->client->getConfiguration()->getFormat()->formatParams(['ids' => $ids]))
		);
	}

	/**
	 * @param string[] $ids
	 * @return PromiseInterface
	 */
	public function bulkDisable(array $ids): PromiseInterface
	{
		return $this->client->getConfiguration()->getGuzzle()->sendAsync(
			new Request('POST', $this->client->getConfiguration()->getBaseUri() . '/jobs/execution/disable', [], $this->client->getConfiguration()->getFormat()->formatParams(['ids' => $ids]))
		);
	}
}
