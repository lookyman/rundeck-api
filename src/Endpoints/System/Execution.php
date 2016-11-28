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
	 * @return PromiseInterface
	 */
	public function enable(): PromiseInterface
	{
		return $this->client->getConfiguration()->getGuzzle()->sendAsync(new Request('POST', $this->client->getConfiguration()->getBaseUri() . '/system/executions/enable'));
	}

	/**
	 * @return PromiseInterface
	 */
	public function disable(): PromiseInterface
	{
		return $this->client->getConfiguration()->getGuzzle()->sendAsync(new Request('POST', $this->client->getConfiguration()->getBaseUri() . '/system/executions/disable'));
	}
}
