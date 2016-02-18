<?php

use Dotenv\Dotenv;

require __DIR__ . '/../vendor/autoload.php';

$vendors = @include __DIR__ . '/../vendor/autoload.php';
if (!$vendors)
{
    die("Could not load vendors, run 'composer install' first\n");
}

$dotenv = new Dotenv(__DIR__ . '/..');
if (file_exists(__DIR__ . '/../.env'))
{
    $dotenv->load();
}

$dotenv->required(['JURIBLOX_CLIENT_ID', 'JURIBLOX_CLIENT_KEY']);