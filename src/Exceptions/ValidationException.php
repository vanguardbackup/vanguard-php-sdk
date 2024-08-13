<?php

declare(strict_types=1);

namespace VanguardBackup\Vanguard\Exceptions;

use Exception;

class ValidationException extends Exception
{
    /**
     * The array of validation errors.
     */
    protected array $errors;

    /**
     * Create a new exception instance.
     */
    public function __construct(array $errors, string $message = 'The given data failed to pass validation.')
    {
        parent::__construct($message);

        $this->errors = $errors;
    }

    /**
     * Get the validation errors.
     */
    public function getErrors(): array
    {
        return $this->errors;
    }
}
