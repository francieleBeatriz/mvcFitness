<?php
spl_autoload_register(function ($class){
  //  $caminho = __DIR__ . '/../' . str_replace('\\', '/', $class) . '.php';

  //  if (file_exists($caminho)) {
    include_once $_SERVER["DOCUMENT_ROOT"] . "\mvcFitness\\" . $class . ".php";
    //}
});