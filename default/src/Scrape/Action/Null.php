<?php
namespace Scrape\Action;

class Null extends ActionAbstract
{

    public static function initSession($session)
    {
        parent::$session = $session;
    }

    public static function execute($action, $context = null)
    {
        // null
    }

}