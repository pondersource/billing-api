<?php

use GuzzleHttp\Psr7\Response;
use PonderSource\HerokuApi\HerokuClient;
use PonderSource\HerokuApi\BadHttpStatusException;
use PonderSource\HerokuApi\JsonDecodingException;
use PonderSource\HerokuApi\JsonEncodingException;
use PonderSource\HerokuApi\MissingApiKeyException;
use Http\Client\HttpClient;
use Http\Mock\Client as MockHttpClient;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    protected function setUp(): void
    {
        // Make sure an API key exists in the environment.
        putenv('HEROKU_API_KEY=truthyvalue');

        // Create a mock HTTP client that will always return something nice.
        $this->mockHttpClient = new MockHttpClient();
        $this->mockHttpClient->addResponse(
            new Response(200, [], '{}')
        );

        // Create a Heroku client for use by tests that only need a standard one.
        $this->client = new HerokuClient(['httpClient' => $this->mockHttpClient]);
    }

    public function getPrivateProperty($object, $property)
    {
        $reflection = new ReflectionClass(get_class($object));
        $property = $reflection->getProperty($property);
        $property->setAccessible(true);

        return $property->getValue($object);
    }

    public function testApiKeyIsInferredFromTheEnvironment()
    {
        // Assert that a client instantiated without an API key infers one from the environment.
        $this->assertSame(
            $this->getPrivateProperty(new HerokuClient([
                'apiKey' => 'truthyvalue'
            ]), 'apiKey'),
            'truthyvalue'
        );
    }
}