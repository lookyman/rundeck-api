<?php
declare(strict_types=1);

namespace Lookyman\Rundeck\Api\Endpoints\System;

use GuzzleHttp\Promise\PromiseInterface;
use Lookyman\Rundeck\Api\Client;
use GuzzleHttp\Psr7\Request;

class Acl
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
	public function list(): PromiseInterface
	{
		return $this->client->getConfiguration()->getGuzzle()->sendAsync(
			new Request('GET', $this->client->getConfiguration()->getBaseUri() . '/system/acl')
		);
	}

	/**
	 * @return PromiseInterface
	 */
	public function get(): PromiseInterface
	{
		return $this->client->getConfiguration()->getGuzzle()->sendAsync(
			new Request('GET', $this->client->getConfiguration()->getBaseUri() . '/system/acl/name.aclpolicy')
		);
	}

	/**
	 * @param array $params
	 * @return PromiseInterface
	 */
	public function create(array $params = []): PromiseInterface
	{
		return $this->client->getConfiguration()->getGuzzle()->sendAsync(
			new Request('POST', $this->client->getConfiguration()->getBaseUri() . '/system/acl/name.aclpolicy', [], $this->client->getConfiguration()->getFormat()->formatParams($params))
		);
	}

	/**
	 * @param array $params
	 * @return PromiseInterface
	 */
	public function update(array $params = []): PromiseInterface
	{
		return $this->client->getConfiguration()->getGuzzle()->sendAsync(
			new Request('PUT', $this->client->getConfiguration()->getBaseUri() . '/system/acl/name.aclpolicy', [], $this->client->getConfiguration()->getFormat()->formatParams($params))
		);
	}

	/**
	 * @return PromiseInterface
	 */
	public function delete(): PromiseInterface
	{
		return $this->client->getConfiguration()->getGuzzle()->sendAsync(
			new Request('DELETE', $this->client->getConfiguration()->getBaseUri() . '/system/acl/name.aclpolicy')
		);
	}
}
