<?php

declare(strict_types=1);

namespace VanguardBackup\Vanguard\Exceptions;

use Exception;

class NotFoundException extends Exception
{
    /**
     * Create a new exception instance.
     */
    public function __construct(string $message = 'The requested resource could not be found.')
    {
        parent::__construct($message);
    }
}
