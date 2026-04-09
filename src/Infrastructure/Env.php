<?php

declare(strict_types=1);

namespace App\Infrastructure;

/**
 * Typed accessor for environment variables.
 *
 * PHPStan level 9 forbids casting `mixed` without a prior type guard.
 */
final class Env
{
    public static function string(string $key, string $default = ''): string
    {
        $value = $_ENV[$key] ?? null;
        return is_string($value) && $value !== '' ? $value : $default;
    }

    public static function int(string $key, int $default = 0): int
    {
        $value = $_ENV[$key] ?? null;
        if (!is_numeric($value)) {
            return $default;
        }
        return (int) $value;
    }

    public static function bool(string $key, bool $default = false): bool
    {
        $value = $_ENV[$key] ?? null;
        if (!is_string($value)) {
            return $default;
        }
        return in_array(strtolower($value), ['true', '1', 'yes'], strict: true);
    }
}
