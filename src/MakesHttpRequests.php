<?php

namespace VanguardBackup\Vanguard;

use Exception;
use RuntimeException;
use VanguardBackup\Vanguard\Exceptions\NotFoundException;
use VanguardBackup\Vanguard\Exceptions\RateLimitExceededException;
use VanguardBackup\Vanguard\Exceptions\ValidationException;
use Psr\Http\Message\ResponseInterface;

trait MakesHttpRequests
{
    /**
     * Send a GET request to VanguardBackup API and return the response.
     *
     * @param string $uri
     * @return mixed
     * @throws Exception
     */
    public function get($uri): mixed
    {
        return $this->request('GET', $uri);
    }

    /**
     * Send a POST request to VanguardBackup API and return the response.
     *
     * @param string $uri
     * @param array $payload
     * @return mixed
     * @throws Exception
     */
    public function post($uri, array $payload = []): mixed
    {
        return $this->request('POST', $uri, $payload);
    }

    /**
     * Send a PUT request to VanguardBackup API and return the response.
     *
     * @param string $uri
     * @param array $payload
     * @return mixed
     * @throws Exception
     */
    public function put($uri, array $payload = []): mixed
    {
        return $this->request('PUT', $uri, $payload);
    }

    /**
     * Send a DELETE request to VanguardBackup API and return the response.
     *
     * @param string $uri
     * @param array $payload
     * @return mixed
     * @throws Exception
     */
    public function delete($uri, array $payload = []): mixed
    {
        return $this->request('DELETE', $uri, $payload);
    }

    /**
     * Send a request to VanguardBackup API and return the response.
     *
     * @param string $method
     * @param string $uri
     * @param array $payload
     * @return mixed
     * @throws Exception
     */
    protected function request($method, $uri, array $payload = []): mixed
    {
        $options = $this->prepareRequestPayload($payload);

        $response = $this->httpClient->request($method, $uri, $options);

        return $this->handleResponse($response);
    }

    /**
     * Prepare the payload for the request.
     *
     * @param array $payload
     * @return array
     */
    protected function prepareRequestPayload(array $payload): array
    {
        if (isset($payload['json'])) {
            return ['json' => $payload['json']];
        }

        return empty($payload) ? [] : ['form_params' => $payload];
    }

    /**
     * Handle the API response.
     *
     * @param ResponseInterface $response
     * @return mixed
     * @throws Exception
     */
    protected function handleResponse(ResponseInterface $response): mixed
    {
        $statusCode = $response->getStatusCode();

        if ($statusCode < 200 || $statusCode > 299) {
            $this->handleRequestError($response);
        }

        $responseBody = (string) $response->getBody();

        return json_decode($responseBody, true, 512, JSON_THROW_ON_ERROR) ?: $responseBody;
    }

    /**
     * Handle request errors.
     *
     * @param ResponseInterface $response
     * @throws NotFoundException
     * @throws ValidationException
     * @throws RateLimitExceededException
     * @throws Exception
     */
    protected function handleRequestError(ResponseInterface $response): void
    {
        $statusCode = $response->getStatusCode();
        $body = (string) $response->getBody();

        throw match ($statusCode) {
            422 => new ValidationException(json_decode($body, true, 512, JSON_THROW_ON_ERROR)),
            404 => new NotFoundException(),
            429 => new RateLimitExceededException(
                $response->hasHeader('x-ratelimit-reset')
                    ? (int)$response->getHeader('x-ratelimit-reset')[0]
                    : null
            ),
            default => new RuntimeException($body),
        };
    }
}