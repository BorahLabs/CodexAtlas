<?php

namespace App\Exceptions;

use Exception;

class CouldNotDetectFramework extends Exception
{
    public function __construct()
    {
        parent::__construct('Could not detect the framework in the provided folder');
    }
}
