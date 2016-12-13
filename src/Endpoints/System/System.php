<?php
declare(strict_types=1);

namespace Lookyman\Rundeck\Api\Endpoints\System;

use GuzzleHttp\Promise\PromiseInterface;
use GuzzleHttp\Psr7\Request;
use Lookyman\Rundeck\Api\Client;

class System
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
			new Request('GET', $this->client->getConfiguration()->getBaseUri() . '/system/info')
		);
	}

	/**
	 * @return LogStorage
	 */
	public function logStorage(): LogStorage
	{
		return new LogStorage($this->client);
	}

	/**
	 * @return Execution
	 */
	public function execution(): Execution
	{
		return new Execution($this->client);
	}

	/**
	 * @return Acl
	 */
	public function acl(): Acl
	{
		return new Acl($this->client);
	}
}
