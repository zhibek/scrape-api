<?php
namespace Scrape\Action;

class FollowLink extends ActionAbstract
{

    public static function execute($action, $context = null)
    {
        //$node = parent::$session->getPage()->find('named', array('link_or_button', $action['title']));
        $node = parent::$session->getPage()->findLink($action['title']);
        $node->click();
    }

}