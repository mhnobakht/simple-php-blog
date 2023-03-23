<?php

require_once __DIR__.'/config.php';

// Sanitizer
function autoloadClass($class) {

    $path = __DIR__.DIRECTORY_SEPARATOR.'Classes'.DIRECTORY_SEPARATOR.$class.'.php';

    if (file_exists($path)) {
        require_once $path;
    }

}

spl_autoload_register('autoloadClass');