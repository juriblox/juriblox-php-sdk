<?php

use Dotenv\Dotenv;

$vendors = @include __DIR__ . '/../vendor/autoload.php';
if (!$vendors)
{
    die("Could not load vendors, run 'composer install' first\n");
}

$dotenv = new Dotenv(__DIR__ . '/..');
$dotenv->load();

$dotenv->required(['JURIBLOX_CLIENT_ID', 'JURIBLOX_CLIENT_KEY']);