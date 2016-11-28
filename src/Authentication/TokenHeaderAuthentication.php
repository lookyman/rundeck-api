<?php
declare(strict_types=1);

namespace Lookyman\Rundeck\Api\Authentication;

use Psr\Http\Message\RequestInterface;

class TokenHeaderAuthentication implements AuthenticationInterface
{
	/**
	 * @var string
	 */
	private $token;

	/**
	 * @param string $token
	 */
	public function __construct(string $token)
	{
		$this->token = $token;
	}

	/**
	 * @param callable $handler
	 * @return callable
	 */
	public function authenticate(callable $handler): callable
	{
		return function (RequestInterface $request, array $options) use ($handler) {
			return $handler($request->withAddedHeader('X-Rundeck-Auth-Token', $this->token), $options);
		};
	}
}
