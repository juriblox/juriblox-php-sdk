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

/**
 * Helper method that outputs a properly aligned name => value table
 *
 * @param      $table
 * @param null $title
 */
function printTable($table, $title = null)
{
    $keyLength = 20;
    $valueLength = 30;

    // Determine column width
    foreach ($table as $key => $value)
    {
        if (mb_strlen($key) > $keyLength)
        {
            $keyLength = mb_strlen($key);
        }

        if (is_array($value))
        {
            $table[$key] = trim(implode("\n", $value));

            $length = 0;
            foreach ($value as $item)
            {
                if (mb_strlen($item) > $length)
                {
                    $length = mb_strlen($item);
                }
            }
        }
        elseif ($value instanceof DateTime)
        {
            $table[$key] = $value->format('r');
            $length = mb_strlen($table[$key]);
        }
        else
        {
            $length = mb_strlen($table[$key]);
        }

        if ($length > $valueLength)
        {
            $valueLength = $length;
        }
    }

    $valueLength = min(60, $valueLength);

    print "\n";
    if ($title !== null)
    {
        print mb_strtoupper($title) . "\n";
        print str_repeat('-', $keyLength + 2 + $valueLength) . "\n";
    }

    foreach ($table as $key => $value)
    {
        printf('%-' . $keyLength . "s: %s\n", mb_substr($key, 0, $keyLength), wordwrap($value, $valueLength));
    }

    print "\n";
}