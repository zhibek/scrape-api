<?php
class Scrape
{

    public static function initSession($session)
    {
        Scrape\Action\Null::initSession($session);
    }

    public static function executeActions($actions, $context = null)
    {
        foreach ($actions as $action) {
            self::executeAction($action, $context);
        }
    }

    public static function executeAction($action, $context = null)
    {
        $class = self::factoryAction($action);
        
        $class::validate($action);

        try {
            Scrape\Log::log(sprintf('Executing action "%s"', $action['type']));
            $class::execute($action, $context);
        } catch (Exception $e) {
            printf('%s:%s - %s', $e->getFile(), $e->getLine(), $e->getMessage());
            print($e->getTraceAsString());die;
            //throw new Scrape\Exception(sprintf('Cannot execute "%s" action - definition (%s)', $action['type'], json_encode($action)), null, $e);
        }
    }

    public static function factoryAction($action)
    {
        $classTemplate = 'Scrape\Action\%s';
        $type = ucfirst($action['type']);

        if (!class_exists(sprintf($classTemplate, $type))) {
            throw new Scrape\Exception(sprintf('Cannot find class for "%s" action', $type));
        }

        $class = sprintf($classTemplate, $type);
        return $class;
    }

}