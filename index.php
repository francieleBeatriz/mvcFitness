<?php
namespace generic;

include_once "generic/AutoLoad.php";

if(isset($_GET['rota'])){
    $controller = new Controller();
    $controller->verificarCaminho($_GET['rota']);
} 
