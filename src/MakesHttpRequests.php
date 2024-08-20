<?php

declare(strict_types=1);

namespace VanguardBackup\Vanguard;

use Exception;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;
use RuntimeException;
use VanguardBackup\Vanguard\Exceptions\MaintenanceException;
use VanguardBackup\Vanguard\Exceptions\NotFoundException;
use VanguardBackup\Vanguard\Exceptions\TooManyRequestsException;
use VanguardBackup\Vanguard\Exceptions\ValidationException;

trait MakesHttpRequests
{
    /**
     * Send a GET request to VanguardBackup API and return the response.
     *
     * @param string $uri
     *
     * @return mixed
     * @throws GuzzleException
     */
    public function get(string $uri): mixed
    {
        return $this->request('GET', $uri);
    }

    /**
     * Send a POST request to VanguardBackup API and return the response.
     *
     * @param string $uri
     * @param array $payload
     * @return mixed
     * @throws GuzzleException
     */
    public function post(string $uri, array $payload = []): mixed
    {
        return $this->request('POST', $uri, $payload);
    }

    /**
     * Send a PUT request to VanguardBackup API and return the response.
     *
     * @param string $uri
     * @param array $payload
     * @return mixed
     * @throws GuzzleException
     */
    public function put(string $uri, array $payload = []): mixed
    {
        return $this->request('PUT', $uri, $payload);
    }

    /**
     * Send a DELETE request to VanguardBackup API and return the response.
     *
     * @param  string  $uri
     *
     * @throws Exception|GuzzleException
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
     * @throws GuzzleException
     */
    protected function request(string $method, string $uri, array $payload = []): mixed
    {
        $options = $this->prepareRequestPayload($payload);

        $response = $this->httpClient->request($method, $uri, $options);

        return $this->handleResponse($response);
    }

    /**
     * Prepare the payload for the request.
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
     * @throws NotFoundException
     * @throws ValidationException
     * @throws TooManyRequestsException
     * @throws Exception
     */
    protected function handleRequestError(ResponseInterface $response): void
    {
        $statusCode = $response->getStatusCode();
        $body = (string) $response->getBody();

        throw match ($statusCode) {
            422 => new ValidationException(json_decode($body, true, 512, JSON_THROW_ON_ERROR)),
            404 => new NotFoundException,
            429 => new TooManyRequestsException(
                $response->hasHeader('x-ratelimit-reset')
                    ? (int) $response->getHeader('x-ratelimit-reset')[0]
                    : null
            ),
            503 => new MaintenanceException,
            default => new RuntimeException($body),
        };
    }
}
