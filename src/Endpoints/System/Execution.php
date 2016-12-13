<?php
declare(strict_types=1);

namespace Lookyman\Rundeck\Api\Endpoints\System;

use GuzzleHttp\Promise\PromiseInterface;
use Lookyman\Rundeck\Api\Client;
use GuzzleHttp\Psr7\Request;

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
	 * @param string|null $node
	 * @param string|null $step
	 * @param array $params
	 * @return PromiseInterface
	 */
	public function output(string $id, string $node = null, string $step = null, array $params = []): PromiseInterface
	{
		if ($node && $step) {
			$path = sprintf('/execution/%s/output/node/%s/step/%s', urlencode($id), urlencode($node), urlencode($step));
		} elseif ($node && !$step) {
			$path = sprintf('/execution/%s/output/node/%s', urlencode($id), urlencode($node));
		} elseif (!$node && $step) {
			$path = sprintf('/execution/%s/output/step/%s', urlencode($id), urlencode($step));
		} else {
			$path = sprintf('/execution/%s/output', urlencode($id));
		}

		return $this->client->getConfiguration()->getGuzzle()->sendAsync(
			new Request('GET', $this->client->getConfiguration()->getBaseUri() . $path, [], $this->client->getConfiguration()->getFormat()->formatParams($params))
		);
	}

	/**
	 * @param string $id
	 * @param bool $stateOnly
	 * @return PromiseInterface
	 */
	public function outputWithState(string $id, bool $stateOnly = false): PromiseInterface
	{
		return $this->client->getConfiguration()->getGuzzle()->sendAsync(
			new Request('GET', $this->client->getConfiguration()->getBaseUri() . sprintf('/execution/%s/output/state%s', urlencode($id), $stateOnly ? '?stateOnly=true' : ''))
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
	 * @return PromiseInterface
	 */
	public function enable(): PromiseInterface
	{
		return $this->client->getConfiguration()->getGuzzle()->sendAsync(
			new Request('POST', $this->client->getConfiguration()->getBaseUri() . '/system/executions/enable')
		);
	}

	/**
	 * @return PromiseInterface
	 */
	public function disable(): PromiseInterface
	{
		return $this->client->getConfiguration()->getGuzzle()->sendAsync(
			new Request('POST', $this->client->getConfiguration()->getBaseUri() . '/system/executions/disable')
		);
	}
}
