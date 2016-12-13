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

	/**
	 * @param array $params
	 * @return string
	 */
	public function formatParams(array $params): string;
}
