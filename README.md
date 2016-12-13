Lookyman/Rundeck/Api
====================

[![Build Status](https://travis-ci.org/lookyman/rundeck-api.svg?branch=master)](https://travis-ci.org/lookyman/rundeck-api)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/lookyman/rundeck-api/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/lookyman/rundeck-api/?branch=master)
[![Coverage Status](https://coveralls.io/repos/github/lookyman/rundeck-api/badge.svg?branch=master)](https://coveralls.io/github/lookyman/rundeck-api?branch=master)
[![Downloads](https://img.shields.io/packagist/dt/lookyman/rundeck-api.svg)](https://packagist.org/packages/lookyman/rundeck-api)
[![Latest stable](https://img.shields.io/packagist/v/lookyman/rundeck-api.svg)](https://packagist.org/packages/lookyman/rundeck-api)


```php
$configuration = new \Lookyman\Rundeck\Api\Configuration(
	new \GuzzleHttp\Client(),
	'https://rundeck.mydomain.com/api/17',
	new \Lookyman\Rundeck\Api\Authentication\TokenHeaderAuthentication('apitoken'),
	new \Lookyman\Rundeck\Api\Format\JsonFormat()
);

$client = new \Lookyman\Rundeck\Api\Client($configuration);

$client
	->project()
	->job()
	->list('MyProject')
	->then(function (\Psr\Http\Message\ResponseInterface $response) {
		echo (string) $response->getBody();	
	})
	->wait();
```
