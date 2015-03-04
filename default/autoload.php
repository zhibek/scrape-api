<?php
$path = __DIR__ . DIRECTORY_SEPARATOR . 'src';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);

spl_autoload_register(function($className) {
    $classPath = str_replace(array('\\', '_'), DIRECTORY_SEPARATOR, $className) . '.php';
    if (stream_resolve_include_path($classPath)) {
        require_once($classPath);
    }
});

require('../vendor/autoload.php');