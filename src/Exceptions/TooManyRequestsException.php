<?php

declare(strict_types=1);

namespace VanguardBackup\Vanguard\Exceptions;

use Exception;

class TooManyRequestsException extends Exception
{
    /**
     * The timestamp when the rate limit will be reset.
     */
    public ?int $rateLimitResetsAt;

    /**
     * Create a new exception instance.
     */
    public function __construct(?int $rateLimitReset, string $message = 'API rate limit exceeded.')
    {
        parent::__construct($message);

        $this->rateLimitResetsAt = $rateLimitReset;
    }

    /**
     * Get the timestamp when the rate limit will be reset.
     */
    public function getRateLimitResetsAt(): ?int
    {
        return $this->rateLimitResetsAt;
    }
}
