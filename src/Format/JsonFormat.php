<?php
declare(strict_types=1);

namespace Lookyman\Rundeck\Api\Format;

use Psr\Http\Message\RequestInterface;

class JsonFormat implements FormatInterface
{
	/**
	 * @param callable $handler
	 * @return callable
	 */
	public function setFormat(callable $handler): callable
	{
		return function (RequestInterface $request, array $options) use ($handler) {
			return $handler($request->withAddedHeader('Content-Type', 'application/json')->withAddedHeader('Accept', 'application/json'), $options);
		};
	}

	/**
	 * @param array $params
	 * @return string
	 */
	public function formatParams(array $params): string
	{
		return \GuzzleHttp\json_encode($params);
	}
}
