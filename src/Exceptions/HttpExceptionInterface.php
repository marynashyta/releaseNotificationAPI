<?php

declare(strict_types=1);

namespace App\Exceptions;

interface HttpExceptionInterface
{
    public function getStatusCode(): int;
}
