<?php

namespace VanguardBackup\Vanguard\Resources;

use VanguardBackup\Vanguard\VanguardClient;

#[\AllowDynamicProperties]
class Resource
{
    /**
     * The resource attributes.
     *
     * @var array
     */
    protected array $attributes;

    /**
     * The VanguardBackup client instance.
     *
     * @var VanguardClient|null
     */
    protected ?VanguardClient $client;

    /**
     * Create a new resource instance.
     *
     * @param array $attributes
     * @param VanguardClient|null $client
     * @return void
     */
    public function __construct(array $attributes, ?VanguardClient $client = null)
    {
        $this->attributes = $attributes;
        $this->client = $client;

        $this->fill();
    }

    /**
     * Fill the resource with the array of attributes.
     *
     * @return void
     */
    protected function fill(): void
    {
        foreach ($this->attributes as $key => $value) {
            $key = $this->camelCase($key);

            $this->{$key} = $value;
        }
    }

    /**
     * Convert the key name to camel case.
     *
     * @param string $key
     * @return string
     */
    protected function camelCase(string $key): string
    {
        return lcfirst(str_replace(' ', '', ucwords(str_replace('_', ' ', $key))));
    }

    /**
     * Transform the items of the collection to the given class.
     *
     * @param array $collection
     * @param string $class
     * @param array $extraData
     * @return array
     */
    protected function transformCollection(array $collection, string $class, array $extraData = []): array
    {
        return array_map(function ($data) use ($class, $extraData) {
            return new $class($data + $extraData, $this->client);
        }, $collection);
    }

    /**
     * Transform the collection of tags to a string.
     *
     * @param array $tags
     * @param string $separator
     * @return string
     */
    protected function transformTags(array $tags, string $separator = ', '): string
    {
        return implode($separator, array_column($tags ?? [], 'name'));
    }

    /**
     * Get an attribute from the resource.
     *
     * @param string $key
     * @return mixed
     */
    public function getAttribute(string $key): mixed
    {
        return $this->attributes[$key] ?? null;
    }

    /**
     * Get all attributes from the resource.
     *
     * @return array
     */
    public function getAttributes(): array
    {
        return $this->attributes;
    }
}