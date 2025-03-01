<?php

declare(strict_types=1);

namespace VanguardBackup\Vanguard\Resources;

class SshKey extends Resource
{
    /**
     * The SSH public key.
     */
    public string $publicKey;

    /**
     * Create a new resource instance.
     */
    public function __construct(array $attributes, $vanguard = null)
    {
        parent::__construct($attributes, $vanguard);

        $this->publicKey = $attributes['public_key'];
    }

    /**
     * Get the string representation of the SSH key.
     */
    public function __toString(): string
    {
        return $this->publicKey;
    }
}
