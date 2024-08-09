<?php

namespace VanguardBackup\Vanguard\Exceptions;

use Exception;

class ValidationException extends Exception
{
    /**
     * The array of validation errors.
     *
     * @var array
     */
    protected array $errors;

    /**
     * Create a new exception instance.
     *
     * @param array $errors
     * @param string $message
     */
    public function __construct(array $errors, string $message = 'The given data failed to pass validation.')
    {
        parent::__construct($message);

        $this->errors = $errors;
    }

    /**
     * Get the validation errors.
     *
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }
}