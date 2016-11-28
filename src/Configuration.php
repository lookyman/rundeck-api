<?php
declare(strict_types=1);

namespace Lookyman\Rundeck\Api;

use GuzzleHttp\ClientInterface;
use Lookyman\Rundeck\Api\Authentication\AuthenticationInterface;
use Lookyman\Rundeck\Api\Format\FormatInterface;

class Configuration
{
	/**
	 * @var ClientInterface
	 */
	private $guzzle;

	/**
	 * @var string
	 */
	private $baseUri;

	/**
	 * @var AuthenticationInterface
	 */
	private $authentication;

	/**
	 * @var FormatInterface
	 */
	private $format;

	/**
	 * @param ClientInterface $guzzle
	 * @param string $baseUri
	 * @param AuthenticationInterface $authentication
	 * @param FormatInterface $format
	 */
	public function __construct(
		ClientInterface $guzzle,
		string $baseUri,
		AuthenticationInterface $authentication,
		FormatInterface $format
	) {
		$this->guzzle = $guzzle;
		$this->baseUri = $baseUri;
		$this->authentication = $authentication;
		$this->format = $format;
	}

	/**
	 * @return ClientInterface
	 */
	public function getGuzzle(): ClientInterface
	{
		return $this->guzzle;
	}

	/**
	 * @return string
	 */
	public function getBaseUri(): string
	{
		return $this->baseUri;
	}

	/**
	 * @return AuthenticationInterface
	 */
	public function getAuthentication(): AuthenticationInterface
	{
		return $this->authentication;
	}

	/**
	 * @return FormatInterface
	 */
	public function getFormat(): FormatInterface
	{
		return $this->format;
	}
}
