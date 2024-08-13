<?php

declare(strict_types=1);

namespace VanguardBackup\Vanguard\Resources;

use VanguardBackup\Vanguard\VanguardClient;

#[\AllowDynamicProperties]
class Resource
{
    /**
     * The resource attributes.
     */
    protected array $attributes;

    /**
     * The VanguardBackup client instance.
     */
    protected ?VanguardClient $client;

    /**
     * Create a new resource instance.
     *
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
     */
    protected function camelCase(string $key): string
    {
        return lcfirst(str_replace(' ', '', ucwords(str_replace('_', ' ', $key))));
    }

    /**
     * Transform the items of the collection to the given class.
     */
    protected function transformCollection(array $collection, string $class, array $extraData = []): array
    {
        return array_map(function ($data) use ($class, $extraData) {
            return new $class($data + $extraData, $this->client);
        }, $collection);
    }

    /**
     * Transform the collection of tags to a string.
     */
    protected function transformTags(array $tags, string $separator = ', '): string
    {
        return implode($separator, array_column($tags ?? [], 'name'));
    }

    /**
     * Get an attribute from the resource.
     */
    public function getAttribute(string $key): mixed
    {
        return $this->attributes[$key] ?? null;
    }

    /**
     * Get all attributes from the resource.
     */
    public function getAttributes(): array
    {
        return $this->attributes;
    }
}
