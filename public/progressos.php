<?php

use service\DesafioService;
use service\ProgressoService;
use views\components\ProgressCard;

$rotaVoltar = "/mvcFitness/home";

if(!isset($_GET["desafio_id"]) && !isset($_SESSION["desafio_id"]))
{
    header("Location: $rotaVoltar");
    die();
}

if(isset($_GET["desafio_id"]))
    if(!isset($_SESSION["desafio_id"]))
        $_SESSION["desafio_id"] = $_GET["desafio_id"];

$desafiosService = new DesafioService();
$progressosService = new ProgressoService();

$desafio = $desafiosService->buscarPorId($_SESSION["desafio_id"]);
$progressos = $progressosService->listarProgressoPorDesafio($_SESSION["desafio_id"]);

if(!$progressos) $progressos = [];

$progressosHTML = [];
foreach($progressos as $progresso)
{
    $progressosHTML[] = ProgressCard::render(
        usuario: $progresso["id"],
        nomeUsuario: $progresso["nome"], 
        registro: $progresso["progresso"],
        rotaEditar: "/mvcFitness/home/progressos/editar"
    );
}
$progressosHTML = count($progressosHTML) ? implode("", $progressosHTML) : "Não há progressos cadastrados no momento!";

echo <<<HTML
    <style>
        .card-progresso {
            padding: 15px 20px;
            border: 2px solid transparent;
            border-radius: 15px;
            background-image:
                linear-gradient(#0b0c27, #0b0c27),
                linear-gradient(to right, #FF2E92, #FF8C1A, #6B1EFF);
            background-origin: border-box;
            background-clip: padding-box, border-box;
        }
        .card-progresso .usuario {
            font-weight: 800;
            color: #FF8C1A;
        }
        .card-progresso .registro {
            margin-top: 5px;
        }
        .challenge-progress {
            border-radius: 50%;
            border: 2px solid #FF2E92;
            width: 40px;
            height: 40px;
            font-weight: bold;
            color: #FF2E92;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: transparent;
        }
    </style>
    <div class="container-desafios">
        <p style="color: #FF8C1A; opacity: 0.6;">
            <i class="fa-solid fa-house" style=""></i>
            >
            <span style="">{$desafio["nome"]}</span>
        </p>    
        <div class="d-flex">
            <button 
            style="background-color: transparent; border: none;" 
            onclick="window.location.href = '{$rotaVoltar}'">
                <i class="fa-solid fa-arrow-left me-2" style="color: #FF8C1A; font-size: 32px; opacity: 0.6;"></i>
            </button>
            <h1 class="title">Progressos</h1>
        </div>
        <p class="subtitle">Acompanhe o progresso dos usuários no desafio e veja como a comunidade está evoluindo</p>
        <div class="cards d-flex flex-column gap-4">
            $progressosHTML
        </div>
    </div>
HTML;