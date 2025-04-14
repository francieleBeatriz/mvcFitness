<?php
spl_autoload_register(function ($class){
    $baseDir = dirname(__DIR__); // volta para a pasta /mvcFitness
    $path = $baseDir . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';

    if (file_exists($path)) {
        require_once $path;
    } else {
        error_log("Classe não encontrada: $class em $path");
    }
});