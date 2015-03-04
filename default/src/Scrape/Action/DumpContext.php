<?php
namespace Scrape\Action;

class DumpContext extends ActionAbstract
{

    public static function execute($action, $context = null)
    {
        //var_dump($context);
        var_dump($context->text());
    }

}