<?php

declare(strict_types=1);

namespace App\Exceptions;

use InvalidArgumentException;

final class ValidationException extends InvalidArgumentException implements HttpExceptionInterface
{
    public function getStatusCode(): int
    {
        return 400;
    }
}
