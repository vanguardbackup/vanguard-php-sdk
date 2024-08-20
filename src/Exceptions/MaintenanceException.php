<?php

declare(strict_types=1);

namespace VanguardBackup\Vanguard\Exceptions;

use Exception;

class MaintenanceException extends Exception
{
    /**
     * Create a new exception instance.
     */
    public function __construct(string $message = 'The application is reporting as being in maintenance mode.')
    {
        parent::__construct($message);
    }
}
