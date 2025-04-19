<?php
require_once __DIR__ . '/generic/AutoLoad.php';

use generic\Controller;
use generic\RouteAction;

$controller = new Controller();

$controller->addRota(
    "api/login/",
    new RouteAction("Cliente", "login")
);

$controller->addRota(
    "login",
    new RouteAction("AuthViewController", "login")
);
$controller->addRota(
    "cadastrar",
    new RouteAction("AuthViewController", "cadastrar")
);

$controller->addRota(
    "home",
    new RouteAction("HomeController", "desafios", true)
);
$controller->addRota(
    "home/cadastrar",
    new RouteAction("HomeController", "cadastrarDesafio", true)
);
$controller->addRota(
    "home/editar",
    new RouteAction("HomeController", "editarDesafio", true)
);

$controller->addRota(
    "home/progressos",
    new RouteAction("Progresso", "progressos", true)
);
$controller->addRota(
    "home/progressos/cadastrar",
    new RouteAction("Progresso", "cadastrar", true)
);
$controller->addRota(
    "home/progressos/editar",
    new RouteAction("Progresso", "editar", true)
);

$controller->addRota(
    "perfil",
    new RouteAction("Perfil", "perfil", true)
);
$controller->addRota(
    "perfil/excluir",
    new RouteAction("Perfil", "excluir", true)
);

if(isset($_GET['rota']))
{
    $controller->verificarCaminho($_GET['rota']);
} 
