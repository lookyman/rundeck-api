<?php
declare(strict_types=1);

namespace Lookyman\Rundeck\Api\Endpoints\System;

use GuzzleHttp\Promise\PromiseInterface;
use Lookyman\Rundeck\Api\Client;
use GuzzleHttp\Psr7\Request;

class LogStorage
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
	public function info(): PromiseInterface
	{
		return $this->client->getConfiguration()->getGuzzle()->sendAsync(
			new Request('GET', $this->client->getConfiguration()->getBaseUri() . '/system/logstorage')
		);
	}

	/**
	 * @return Incomplete
	 */
	public function incomplete(): Incomplete
	{
		return new Incomplete($this->client);
	}
}
