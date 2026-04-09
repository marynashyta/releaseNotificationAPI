#!/usr/bin/env php
<?php

declare(strict_types=1);

use App\Database\Connection;
use App\Database\Migrator;

require __DIR__ . '/../vendor/autoload.php';

// Load environment variables
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->safeLoad();

echo "Running database migrations...\n";

try {
    $pdo      = Connection::getInstance();
    $migrator = new Migrator($pdo);
    $migrator->run();
    echo "All migrations completed successfully.\n";
    exit(0);
} catch (\Throwable $e) {
    echo "Migration failed: " . $e->getMessage() . "\n";
    exit(1);
}
