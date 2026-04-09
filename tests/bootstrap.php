<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

$_ENV['DB_HOST'] = 'localhost';
$_ENV['DB_PORT'] = '3306';
$_ENV['DB_NAME'] = 'test';
$_ENV['DB_USER'] = 'test';
$_ENV['DB_PASS'] = '';

$_ENV['GITHUB_TOKEN'] = '';

$_ENV['MAIL_HOST']         = 'localhost';
$_ENV['MAIL_PORT']         = '1025';
$_ENV['MAIL_USERNAME']     = '';
$_ENV['MAIL_PASSWORD']     = '';
$_ENV['MAIL_FROM_ADDRESS'] = 'test@example.com';
$_ENV['MAIL_FROM_NAME']    = 'Test';
$_ENV['APP_URL']           = 'http://localhost:8080';

$_ENV['REDIS_HOST'] = 'localhost';
$_ENV['REDIS_PORT'] = '6379';
$_ENV['REDIS_DB']   = '0';
$_ENV['API_KEY']    = '';
