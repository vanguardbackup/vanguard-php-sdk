<?php

namespace VanguardBackup\Vanguard;

use GuzzleHttp\Client as HttpClient;
use VanguardBackup\Vanguard\Resources\User;

class VanguardClient
{
    use Actions\ManagesBackupDestinations,
        Actions\ManagesBackupTasks,
        Actions\ManagesNotificationStreams,
        Actions\ManagesRemoteServers,
        Actions\ManagesTags,
        MakesHttpRequests;

    /**
     * The VanguardBackup API Key.
     *
     * @var string
     */
    protected string $apiKey;

    /**
     * The Guzzle HTTP Client instance.
     *
     * @var \GuzzleHttp\Client
     */
    public HttpClient $httpClient;

    /**
     * The base URL for the VanguardBackup API.
     *
     * @var string
     */
    protected string $baseUrl = 'https://app.vanguardbackup.com/api/';

    /**
     * Create a new VanguardClient instance.
     *
     * @param  string|null  $apiKey
     * @param  string|null  $baseUrl
     * @param  \GuzzleHttp\Client|null  $httpClient
     * @return void
     */
    public function __construct($apiKey = null, $baseUrl = null, ?HttpClient $httpClient = null)
    {
        if (! is_null($baseUrl)) {
            $this->setBaseUrl($baseUrl);
        }

        if (! is_null($apiKey)) {
            $this->setApiKey($apiKey, $httpClient);
        }

        if (! is_null($httpClient)) {
            $this->httpClient = $httpClient;
        }
    }

    /**
     * Transform the items of the collection to the given class.
     *
     * @param  array  $collection
     * @param  string  $class
     * @param  array  $extraData
     * @return array
     */
    protected function transformCollection($collection, $class, $extraData = [])
    {
        return array_map(function ($data) use ($class, $extraData) {
            return new $class($data + $extraData, $this);
        }, $collection);
    }

    /**
     * Set the API key and set up the HTTP client.
     *
     * @param  string  $apiKey
     * @param  \GuzzleHttp\Client|null  $httpClient
     * @return $this
     */
    public function setApiKey($apiKey, $httpClient = null): static
    {
        $this->apiKey = $apiKey;

        $this->httpClient = $httpClient ?: new HttpClient([
            'base_uri' => $this->baseUrl,
            'http_errors' => false,
            'headers' => [
                'Authorization' => 'Bearer '.$this->apiKey,
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
        ]);

        return $this;
    }

    /**
     * Set the base URL for the VanguardBackup API.
     *
     * @param string $url
     * @return $this
     */
    public function setBaseUrl(string $url): static
    {
        $this->baseUrl = rtrim($url, '/');

        return $this;
    }

    /**
     * Get the base URL for the VanguardBackup API.
     *
     * @return string
     */
    public function getBaseUrl(): string
    {
        return $this->baseUrl;
    }

    /**
     * Get an authenticated user instance.
     *
     * @return User
     */
    public function user(): User
    {
        return new User($this->get('user')['data']);
    }
}