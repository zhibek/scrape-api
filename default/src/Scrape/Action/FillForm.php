<?php
namespace Scrape\Action;

class FillForm extends ActionAbstract
{

    public static function execute($action, $context = null)
    {
        $form = parent::$crawler->selectButton($action['submit'])->form();
        parent::$crawler = parent::$client->submit($form, $action['fields']);
    }

}