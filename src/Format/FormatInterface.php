<?php
declare(strict_types=1);

namespace Lookyman\Rundeck\Api\Format;

interface FormatInterface
{
	/**
	 * @param callable $handler
	 * @return callable
	 */
	public function setFormat(callable $handler): callable;
}
