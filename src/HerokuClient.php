<?php

namespace Ishifoev\HerokuApi;

use GuzzleHttp\Psr7\Request;
use Ishifoev\HerokuApi\BadHttpStatusException;
use Ishifoev\HerokuApi\JsonDecodingException;
use Ishifoev\HerokuApi\JsonEncodingException;
use Ishifoev\HerokuApi\MissingApiKeyException;
use Http\Client\Curl\Client as CurlHttpClient;
use Http\Client\HttpClient;
use Http\Factory\Guzzle\ResponseFactory;
use Http\Factory\Guzzle\StreamFactory;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;


class HerokuClient {
    protected $baseUrl = 'https://api.heroku.com/';
    protected $apiKey;
    protected $curlOptions = [];
    protected $httpClient;
    protected $lastHttpRequest;
    protected $lastHttpResponse;

    public function __construct(array $config) {
        foreach($config as $property => $value) {
            $this->$property = $value;
        }

        if(!($this->apiKey)) {
            throw new MissingApiKeyException(
                'Heroku client error: Missing API key. An API key should either be provided ' .
                'at instantiation or available as the HEROKU_API_KEY environmental variable.'
            );
        }

         // Configure a default HTTP client if none was provided.
         if (!$this->httpClient) {
            $this->httpClient = $this->buildHttpClient();
        }
    }

    public function get($path, array $headers = [])
    {
        return $this->execute('GET', $path, null, $headers);
    }

    public function getLastHttpRequest()
    {
        return $this->lastHttpRequest;
    }

    public function getLastHttpResponse()
    {
        return $this->lastHttpResponse;
    }

    protected function execute($method, $path, $body = null, array $customHeaders = [])
    {
        // Clear state from the last call.
        $this->lastHttpRequest = null;
        $this->lastHttpResponse = null;

        // Build the request.
        $request = $this->buildRequest($method, $path, $body, $customHeaders);

        $this->lastHttpRequest = $request->withHeader('Authorization', 'Bearer {REDACTED}');

        // Make the API call.
        $response = $this->httpClient->sendRequest($request);

        $this->lastHttpResponse = $response;

        return $this->processResponse($response);
    }

    protected function buildRequest($method, $path, $body = null, array $customHeaders = [])
    {
        $headers = [];

        // If a body was included, add it to the request.
        if (isset($body)) {
            $headers['Content-Type'] = 'application/json';
            $body = json_encode($body);
            // Check for JSON encoding errors.
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new JsonEncodingException(
                    'JSON error while encoding Heroku API request: ' . json_last_error_msg()
                );
            }
        }

        // Add required headers.
        $headers['Accept'] = 'application/vnd.heroku+json; version=3'; // Heroku specifies this.
        $headers['Authorization'] = 'Bearer ' . $this->apiKey;

        // Incorporate any custom headers, preferring them over our defaults.
        $headers = $customHeaders + $headers;

        return new Request($method, $this->baseUrl . $path, $headers, $body);
    }

    protected function processResponse(ResponseInterface $httpResponse)
    {
        // Attempt to build the API response from the HTTP response body.
        $apiResponse = json_decode($httpResponse->getBody()->getContents());
        $httpResponse->getBody()->rewind(); // Rewind the stream to make future access easier.

        if ($httpResponse instanceof BadHttpStatusException && $httpResponse->getStatusCode() >= 400) {
        }

        // Check for JSON decoding errors.
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new JsonDecodingException(
                'JSON error while decoding Heroku API response: ' . json_last_error_msg()
            );
        }

        return $apiResponse;
    }

    protected function buildHttpClient()
    {
        return new CurlHttpClient(
            new ResponseFactory(),
            new StreamFactory(),
            $this->curlOptions
        );
    }
}