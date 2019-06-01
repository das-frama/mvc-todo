<?php

define('ROOT', substr(__DIR__, 0, -3));
define('APP', ROOT . 'app' . DIRECTORY_SEPARATOR);
define('CORE', ROOT . 'core' . DIRECTORY_SEPARATOR);

spl_autoload_register(function ($class) {
    // $class = 'core\Application'
    $file = ROOT . str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
    if (file_exists($file)) {
        require $file;
    }
});

(new core\Application())->run();
