<?php
declare(strict_types=1);

namespace Lookyman\Rundeck\Api\Authentication;

interface AuthenticationInterface
{
	/**
	 * @param callable $handler
	 * @return callable
	 */
	public function authenticate(callable $handler): callable;
}
