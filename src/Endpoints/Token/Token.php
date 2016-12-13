<?php
declare(strict_types=1);

namespace Lookyman\Rundeck\Api\Endpoints\Token;

use GuzzleHttp\Promise\PromiseInterface;
use Lookyman\Rundeck\Api\Client;
use GuzzleHttp\Psr7\Request;

class Token
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
	 * @param string|null $user
	 * @return PromiseInterface
	 */
	public function list(string $user = null): PromiseInterface
	{
		return $this->client->getConfiguration()->getGuzzle()->sendAsync(
			new Request('GET', $this->client->getConfiguration()->getBaseUri() . '/tokens' . ($user ? sprintf('/%s', urlencode($user)) : ''))
		);
	}

	/**
	 * @param string $token
	 * @return PromiseInterface
	 */
	public function get(string $token): PromiseInterface
	{
		return $this->client->getConfiguration()->getGuzzle()->sendAsync(
			new Request('GET', $this->client->getConfiguration()->getBaseUri() . '/token/' . urlencode($token))
		);
	}

	/**
	 * @param string $user
	 * @return PromiseInterface
	 */
	public function create(string $user): PromiseInterface
	{
		return $this->client->getConfiguration()->getGuzzle()->sendAsync(
			new Request('POST', $this->client->getConfiguration()->getBaseUri() . '/tokens/' . urlencode($user))
		);
	}

	/**
	 * @param string $token
	 * @return PromiseInterface
	 */
	public function delete(string $token): PromiseInterface
	{
		return $this->client->getConfiguration()->getGuzzle()->sendAsync(
			new Request('DELETE', $this->client->getConfiguration()->getBaseUri() . '/token/' . urlencode($token))
		);
	}
}
