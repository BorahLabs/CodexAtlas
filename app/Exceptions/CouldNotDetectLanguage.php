<?php

namespace App\Exceptions;

use Exception;

class CouldNotDetectLanguage extends Exception
{
    public function __construct()
    {
        parent::__construct('Could not detect the language in the provided file');
    }
}
