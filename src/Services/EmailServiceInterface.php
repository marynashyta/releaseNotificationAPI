<?php

declare(strict_types=1);

namespace App\Services;

use PHPMailer\PHPMailer\Exception as PHPMailerException;

interface EmailServiceInterface
{
    /**
     * @throws PHPMailerException
     */
    public function sendConfirmation(
        string $email,
        string $repo,
        string $confirmToken,
        string $unsubscribeToken
    ): void;

    /**
     * @throws PHPMailerException
     */
    public function sendReleaseNotification(
        string $email,
        string $repo,
        string $tag,
        string $unsubscribeToken
    ): void;
}
