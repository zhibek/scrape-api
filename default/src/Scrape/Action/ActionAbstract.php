<?php
namespace Scrape\Action;

abstract class ActionAbstract
{

    public static $session;

    public static $crawler;

    abstract public static function execute($action, $context = null);

    public static function validate($action)
    {
        return true;
    }

}