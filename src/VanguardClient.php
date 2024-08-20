<?php

declare(strict_types=1);

namespace VanguardBackup\Vanguard;

use GuzzleHttp\Client as HttpClient;
use VanguardBackup\Vanguard\Actions\ManagesBackupTaskLogs;
use VanguardBackup\Vanguard\Resources\User;

class VanguardClient
{
    use Actions\ManagesBackupDestinations,
        Actions\ManagesBackupTasks,
        Actions\ManagesNotificationStreams,
        Actions\ManagesRemoteServers,
        Actions\ManagesTags,
        MakesHttpRequests,
        ManagesBackupTaskLogs;

    /**
     * The VanguardBackup API Key.
     */
    protected string $apiKey;

    /**
     * The Guzzle HTTP Client instance.
     */
    public HttpClient $httpClient;

    /**
     * The base URL for the VanguardBackup API.
     */
    protected string $baseUrl = 'https://app.vanguardbackup.com/api/';

    /**
     * Create a new VanguardClient instance.
     *
     * @return void
     */
    public function __construct(?string $apiKey = null, ?string $baseUrl = null, ?HttpClient $httpClient = null)
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
     */
    protected function transformCollection(array $collection, string $class, array $extraData = []): array
    {
        return array_map(function ($data) use ($class, $extraData) {
            return new $class($data + $extraData, $this);
        }, $collection);
    }

    /**
     * Set the API key and set up the HTTP client.
     *
     * @return $this
     */
    public function setApiKey(string $apiKey, ?HttpClient $httpClient = null): static
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
     * @return $this
     */
    public function setBaseUrl(string $url): static
    {
        $this->baseUrl = rtrim($url, '/');

        return $this;
    }

    /**
     * Get the base URL for the VanguardBackup API.
     */
    public function getBaseUrl(): string
    {
        return $this->baseUrl;
    }

    /**
     * Get an authenticated user instance.
     */
    public function user(): User
    {
        return new User($this->get('user')['data']);
    }
}
