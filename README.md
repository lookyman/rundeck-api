Lookyman/Rundeck/Api
===================================

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
