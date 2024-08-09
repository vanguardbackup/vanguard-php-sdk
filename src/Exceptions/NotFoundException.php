<?php

namespace VanguardBackup\Vanguard\Exceptions;

use Exception;

class NotFoundException extends Exception
{
    /**
     * Create a new exception instance.
     *
     * @param string $message
     */
    public function __construct(string $message = 'The requested resource could not be found.')
    {
        parent::__construct($message);
    }
}