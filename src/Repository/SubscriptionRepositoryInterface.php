<?php

declare(strict_types=1);

namespace App\Repository;

/**
 * Persistence contract for subscription records.
 *
 * All methods return typed shapes so callers never reach through mixed PDO results.
 */
interface SubscriptionRepositoryInterface
{
    public function existsByEmailAndRepo(string $email, string $repo): bool;

    public function create(
        string $email,
        string $repo,
        string $confirmToken,
        string $unsubscribeToken,
    ): void;

    /**
     *
     * @return array{id: int, repo: string, confirmed: int}|null
     */
    public function findByConfirmToken(string $token): ?array;

    public function confirm(int $id, ?string $lastSeenTag): void;

    /**
     * Find a subscription by its unsubscribe token.
     *
     * @return array{id: int}|null
     */
    public function findByUnsubscribeToken(string $token): ?array;

    public function delete(int $id): void;

    /**
     * Return all confirmed subscriptions for an email address.
     *
     * @return list<array{email: string, repo: string, confirmed: bool, last_seen_tag: string|null}>
     */
    public function findConfirmedByEmail(string $email): array;
}
