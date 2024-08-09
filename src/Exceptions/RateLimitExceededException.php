<?php

namespace VanguardBackup\Vanguard\Exceptions;

use Exception;

class RateLimitExceededException extends Exception
{
    /**
     * The timestamp when the rate limit will be reset.
     *
     * @var int|null
     */
    public ?int $rateLimitResetsAt;

    /**
     * Create a new exception instance.
     *
     * @param int|null $rateLimitReset
     * @param string $message
     */
    public function __construct(?int $rateLimitReset, string $message = 'API rate limit exceeded.')
    {
        parent::__construct($message);

        $this->rateLimitResetsAt = $rateLimitReset;
    }

    /**
     * Get the timestamp when the rate limit will be reset.
     *
     * @return int|null
     */
    public function getRateLimitResetsAt(): ?int
    {
        return $this->rateLimitResetsAt;
    }
}