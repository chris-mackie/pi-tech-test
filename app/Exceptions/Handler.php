<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    protected function shouldReturnJson($request, Throwable $e)
    {
        // We always want exceptions to return JSON as there are no views
        return true;
    }
}
