<?php

namespace App\Exceptions;

use Exception;
use GuzzleHttp\Psr7\Request;

class ValidationException extends Exception{

    public function __construct(string $message)
    {
        parent::__construct($message);
    }

    public function render()
    {
        return response($this->getMessage(),400);

    }
}