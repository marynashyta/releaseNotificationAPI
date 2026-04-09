<?php

declare(strict_types=1);

namespace App\Infrastructure;

use JsonException;

/**
 * Typed JSON helpers.
 *
 * json_decode() returns mixed, making it impossible to access array offsets
 * without PHPStan level-9 errors. Routing all JSON operations through this
 * class gives callers a precise return type and a single throw point.
 */
final class Json
{
    /**
     * Decode a JSON string to an associative array.
     *
     * @return array<string, mixed>
     * @throws JsonException on malformed input
     */
    public static function decode(string $json): array
    {
        $decoded = json_decode($json, associative: true, flags: JSON_THROW_ON_ERROR);
        return is_array($decoded) ? $decoded : [];
    }

    /**
     * Encode a value to a JSON string.
     *
     * @throws JsonException on un-encodable value
     */
    public static function encode(mixed $value): string
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_THROW_ON_ERROR);
    }
}
