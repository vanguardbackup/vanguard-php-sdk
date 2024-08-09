<?php

namespace VanguardBackup\Vanguard;

use GuzzleHttp\Client as HttpClient;
use Illuminate\Support\Traits\ForwardsCalls;

/**
 * @mixin VanguardClient
 */
class VanguardManager
{
    use ForwardsCalls;

    /**
     * The VanguardClient instance.
     *
     * @var VanguardClient
     */
    protected VanguardClient $client;

    /**
     * Create a new VanguardBackup manager instance.
     *
     * @param string $apiKey
     * @param string|null $baseUrl
     * @param HttpClient|null $httpClient
     */
    public function __construct(string $apiKey, ?string $baseUrl = null, ?HttpClient $httpClient = null)
    {
        $this->client = new VanguardClient($apiKey, $baseUrl, $httpClient);
    }

    /**
     * Dynamically forward method calls to the VanguardClient instance.
     *
     * @param string $method
     * @param array $parameters
     * @return mixed
     */
    public function __call(string $method, array $parameters)
    {
        return $this->forwardCallTo($this->client, $method, $parameters);
    }

    /**
     * Get the underlying VanguardClient instance.
     *
     * @return VanguardClient
     */
    public function getClient(): VanguardClient
    {
        return $this->client;
    }

    /**
     * Set the base URL for the VanguardBackup API.
     *
     * @param string $url
     * @return $this
     */
    public function setBaseUrl(string $url): self
    {
        $this->client->setBaseUrl($url);

        return $this;
    }

    /**
     * Get the base URL for the VanguardBackup API.
     *
     * @return string
     */
    public function getBaseUrl(): string
    {
        return $this->client->getBaseUrl();
    }
}