<?php
require('../autoload.php');

use Symfony\Component\Yaml\Yaml;
use WebDriver\ServiceFactory;

ServiceFactory::getInstance()->setServiceClass('service.curl', 'Scrape\CurlSubstitute');

$config = Yaml::parse(file_get_contents('../config/scrape.1.yaml'));

$phantomHost = 'http://scrape-api.appspot.com/phantomjs'; // appengine
//$phantomHost = 'http://127.0.0.1:8080/phantomjs'; // local
$driver = new \Behat\Mink\Driver\Selenium2Driver('phantomjs', null, $phantomHost);
$session = new \Behat\Mink\Session($driver);
$session->start();

Scrape::initSession($session);
Scrape::executeActions($config['actions']);