<?php
namespace Scrape;

class Log
{

    public static function log($message)
    {
        error_log($message, 0);
    }

}