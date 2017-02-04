<?php

namespace Viber;

/**
 * Overide output
 *
 * @see https://mwop.net/blog/2014-08-11-testing-output-generating-code.html
 */
abstract class Output
{
    public static $headers = [];

    public static function reset()
    {
        self::$headers = [];
    }
}

/**
 * Overide default function
 */
function headers_sent()
{
    return false;
}

/**
 * Overide default function
 */
function header($value)
{
    Output::$headers[] = $value;
}
