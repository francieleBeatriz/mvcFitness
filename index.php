<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/mvcFitness/generic/AutoLoad.php";

use generic\Controller;
use generic\RouteAction;

$controller = new Controller();

$controller->addRota(
    "api/login/",
    new RouteAction("Cliente", "login")
);
$controller->addRota(
    "login/",
    new RouteAction("AuthViewController", "login")
);
$controller->addRota(
    "cadastrar/",
    new RouteAction("AuthViewController", "cadastrar")
);

if(isset($_GET['rota']))
{
    $controller->verificarCaminho($_GET['rota']);
} 
