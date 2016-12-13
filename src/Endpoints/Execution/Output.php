<?php
declare(strict_types=1);

namespace Lookyman\Rundeck\Api\Endpoints\Execution;

use GuzzleHttp\Promise\PromiseInterface;
use GuzzleHttp\Psr7\Request;
use Lookyman\Rundeck\Api\Client;

class Output
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
}
