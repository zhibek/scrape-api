<?php
namespace Scrape\Action;

class Loop extends ActionAbstract
{

    public static function execute($action, $context = null)
    {
        if (!in_array($action['filterType'], array('css', 'xpath'))) {
                throw new Scrape_Exception(sprintf('Invalid filterType "%s" specified for loop', $action['filterType']));
        }

        $nodes = parent::$session->getPage()->findAll($action['filterType'], $action['search']);
        $nodes->each(function ($node) use ($action) {
            Scrape::executeActions($action['actions'], $node);

        });

        /*
        parent::$crawler->$method($action['search'])->each(function ($node) use ($action) {
            Scrape::executeActions($action['actions'], $node);

        });
        */
    }

}