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
 * @param int   $indent
 */
function printTable($table, $title = null, $indent = 0)
{
    $keyLength = 20;
    $valueLength = 30;

    /*
     * Determine column widths
     */
    foreach ($table as $key => $value)
    {
        if (mb_strlen($key) > $keyLength)
        {
            $keyLength = mb_strlen($key);
        }

        if (is_array($value))
        {
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

    $keyTotalLength = $keyLength + 2;
    $valueLength = min(60, $valueLength);

    // Indention
    $indentSpacing = ($indent > 0) ? str_repeat('   ', $indent) : '';
    if ($indent > 0)
    {
        if ($indent > 1)
        {
            print mb_substr($indentSpacing, 0, -3) . "└──┐\n";
        }

        print $indentSpacing . "│  \n";
    }
    else
    {
        print "\n";
    }

    // Print header
    if ($title !== null)
    {
        if ($indent == 0)
        {
            print mb_strtoupper($title) . "\n";
            print str_repeat('-', $keyTotalLength + $valueLength) . "\n";
        }
        else
        {
            print sprintf("%s├── [%s]\n", $indentSpacing, $title);
        }
    }

    /*
     * Print values
     */
    $first = true;
    foreach ($table as $key => $value)
    {
        // Format an array
        if (is_array($value))
        {
            if (sizeof($value) == 0)
            {
                $wrapped = '[]';
            }
            else
            {
                $rows = [];
                foreach ($value as $row)
                {
                    $rows[] = wordwrap($row, $valueLength, "\n" . str_repeat(' ', $keyTotalLength));
                }

                $wrapped = implode("\n" . str_repeat(' ', $keyTotalLength), $value);
            }
        }

        // Check for NULL
        elseif ($value === null)
        {
            $wrapped = 'NULL';
        }

        // Check whether we can display the value
        elseif (!is_scalar($value) && (!is_object($value) || !method_exists($value, '__toString')))
        {
            throw new \InvalidArgumentException(sprintf('The value for "%s" (a %s) cannot be converted to a string representation', $key, get_class($value)));
        }

        // Perform simple wordwrapping on the value
        else
        {
            $wrapped = wordwrap($value, $valueLength, "\n" . str_repeat(' ', $keyTotalLength));
        }

        $indentText = '';

        if ($first)
        {
            $first = false;
            if ($indent > 0)
            {
                $indentText = $indentSpacing . (($title === null) ? "├── " : "│   ");
            }
        }
        elseif ($indent > 0)
        {
            $indentText = $indentSpacing . "│   ";
        }

        printf($indentText . '%-' . $keyLength . "s: %s\n", mb_substr($key, 0, $keyLength), $wrapped);
    }
}