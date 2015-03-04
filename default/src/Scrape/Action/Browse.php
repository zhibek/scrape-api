<?php
namespace Scrape\Action;

class Browse extends ActionAbstract
{

    public static function execute($action, $context = null)
    {
        parent::$session->visit($action['url']);
    }

}