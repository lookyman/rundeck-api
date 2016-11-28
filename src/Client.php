<?php
declare(strict_types=1);

namespace Lookyman\Rundeck\Api;

use GuzzleHttp\HandlerStack;
use Lookyman\Rundeck\Api\Endpoints\Execution\Execution;
use Lookyman\Rundeck\Api\Endpoints\Job\Job;
use Lookyman\Rundeck\Api\Endpoints\Project\Project;
use Lookyman\Rundeck\Api\Endpoints\Scheduler\Scheduler;
use Lookyman\Rundeck\Api\Endpoints\Storage\Storage;
use Lookyman\Rundeck\Api\Endpoints\System\System;
use Lookyman\Rundeck\Api\Endpoints\Token\Token;

class Client
{
	/**
	 * @var Configuration
	 */
	private $configuration;

	/**
	 * @param Configuration $configuration
	 */
	public function __construct(Configuration $configuration)
	{
		$this->configuration = $configuration;

		/** @var HandlerStack $stack */
		$stack = $this->configuration->getGuzzle()->getConfig('handler');
		$stack->push([$this->configuration->getAuthentication(), 'authenticate'], 'authentication');
		$stack->push([$this->configuration->getFormat(), 'setFormat'], 'format');
	}

	/**
	 * @return Configuration
	 */
	public function getConfiguration(): Configuration
	{
		return $this->configuration;
	}

	/**
	 * @return Token
	 */
	public function token(): Token
	{
		return new Token($this);
	}

	/**
	 * @return System
	 */
	public function system(): System
	{
		return new System($this);
	}

	/**
	 * @return Scheduler
	 */
	public function scheduler(): Scheduler
	{
		return new Scheduler($this);
	}

	/**
	 * @return Project
	 */
	public function project(): Project
	{
		return new Project($this);
	}

	/**
	 * @return Job
	 */
	public function job(): Job
	{
		return new Job($this);
	}

	/**
	 * @return Execution
	 */
	public function execution(): Execution
	{
		return new Execution($this);
	}

	/**
	 * @return Storage
	 */
	public function storage(): Storage
	{
		return new Storage($this);
	}
}
