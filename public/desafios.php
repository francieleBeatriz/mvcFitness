<?php

use service\DesafioService;
use views\components\CardsDesafio;

$mensagem = "";

if(isset($_SESSION["desafio_id"])) 
    unset($_SESSION['desafio_id']);

if(isset($_GET["sucesso"]))
    $mensagem = <<<HTML
        <div class="mensagem-feedback" style="padding: 10px; background-color: darkgreen; border-radius: 5px; font-weight: 600; margin-top: 5px; margin-bottom: 5px;">
            <i class='fa-solid fa-check me-2'></i>{$_GET["sucesso"]}
        </div>
    HTML;
else if(isset($_GET["erro"]))
    $mensagem = <<<HTML
    <div class="mensagem-feedback" style="padding: 10px; background-color: crimson; border-radius: 5px; font-weight: 600; margin-top: 5px; margin-bottom: 5px;">
        <i class='fa-solid fa-triangle-exclamation me-2'></i>{$_GET["erro"]}
    </div>
    HTML;

$desafios = $_GET["desafios"] ?? "1";

$codigoDesafios = $desafios === "2" ? "2" : "1";
$todos = $codigoDesafios === "1" ? "active" : "";
$meusDesafios = $codigoDesafios === "2" ? "active" : "";

$desafioService = new DesafioService();

$desafiosDesc = [
    "1" => $desafioService->listarTodosOsDesafios(),
    "2" => $desafioService->listarDesafiosDoUsuario($_SESSION["id"])
];

$desafios = $desafiosDesc[$codigoDesafios];

if(!$desafios) $desafios = [];

$desafiosHTML = [];
foreach($desafios as $desafio)
{
    $desafiosHTML[] = CardsDesafio::render(
        titulo: $desafio["nome"], 
        descricao: $desafio["descricao"], 
        progresso: $desafio["progresso"],
        onclick: "window.location.href = '/mvcFitness/home/progressos?desafio_id={$desafio["id"]}'",
        usuario: $desafio["usuario_id"],
        rotaEditar: "/mvcFitness/home/editar?desafio_id={$desafio["id"]}",
        rotaExcluir: "/mvcFitness/api/desafio/deletar?desafio_id={$desafio["id"]}"
    );
}
$desafiosHTML = count($desafiosHTML) ? implode("", $desafiosHTML) : "Não há desafios cadastrados no momento!";

echo <<<HTML
    <style>
        .container-desafios{
            margin-top: 10px;
        }
        .filters {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }

        .filter-btn {
            padding: 8px 16px;
            border: 2px solid white;
            background: transparent;
            color: white;
            border-radius: 20px;
            cursor: pointer;
            font-weight: bold;
        }

        .filter-btn.active {
            background-color: white;
            color: #0b0c27;
        }

        .cards {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .challenge-card {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
            padding: 15px 20px;
            border: 2px solid transparent;
            border-radius: 15px;
            background-image:
                linear-gradient(#0b0c27, #0b0c27),
                linear-gradient(to right, #FF2E92, #FF8C1A, #6B1EFF);
            background-origin: border-box;
            background-clip: padding-box, border-box;
        }

        .challenge-title {
            color: #f8f8f8;
            font-weight: bold;
            margin: 0;
        }

        .challenge-desc {
            font-size: 12px;
            color: #ccc;
            margin: 5px 0 0;
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
        
        <div class="filters">
          <button class="filter-btn $todos" onclick="window.location.href = '/mvcFitness/home?desafios=1'">Todos</button>
          <button class="filter-btn $meusDesafios" onclick="window.location.href = '/mvcFitness/home?desafios=2'">Meus desafios</button>
        </div>
        $mensagem
        <h1 class="title">Desafios</h1>
        <p class="subtitle">Confira todos os desafios criados pela comunidade e escolha em qual superar seus limites</p>
        <div class="cards">
            $desafiosHTML
        </div>
    </div>
HTML;