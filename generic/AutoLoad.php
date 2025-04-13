<?php
spl_autoload_register(function ($class){
    $caminho = __DIR__ . '/../' . str_replace('\\', '/', $class) . '.php';

    if (file_exists($caminho)) {
        include $caminho;
    }
});