<?php

use service\ProgressoService;
use views\builders\FormBuilder;

$feedback = [];

if(isset($_GET["sucesso"]))
    $feedback = [
        $_GET["sucesso"],
        "padding: 10px; background-color: darkgreen; border-radius: 5px; font-weight: 600; margin-top: 5px; margin-bottom: 5px;",
        "<i class='fa-solid fa-check me-2'></i>"
    ];
else if(isset($_GET["erro"]))
    $feedback = [
        $_GET["erro"],
        "padding: 10px; background-color: crimson; border-radius: 5px; font-weight: 600; margin-top: 5px; margin-bottom: 5px;",
        "<i class='fa-solid fa-triangle-exclamation me-2'></i>"
    ];

$progressoService = new ProgressoService();
$progresso = $progressoService->buscarPorUsuarioDesafio($_SESSION["id"], $_SESSION["desafio_id"]);
$progresso = $progresso ? $progresso[0] : [];

$tituloPagina = "Cadastrar Progresso";
$progressoTexto = "";
if($progresso){
    $progressoTexto = $progresso["progresso"];
    $tituloPagina = "Editar Progresso";
}

$formBuilder = new FormBuilder(
    action: '/mvcFitness/api/progresso/registrar', 
    method: 'POST', 
    titulo: $tituloPagina, 
    descricaoPagina: "Registre seu progresso neste desafio e acompanhe sua evolução ao longo do tempo",
    rotaVoltar: '/mvcFitness/home/progressos',
    feedback: $feedback
);
$formBuilder->addInput(
    type: 'number', 
    name: 'progresso', 
    label: 'Progresso', 
    placeholder: 'Forneça aqui o seu progresso neste desafio',
    value: $progressoTexto
);
$formBuilder->addButton(
    label: 'Salvar'
);
$form = $formBuilder->render();

echo <<<HTML
    <div class="container">
        $form
    </div>
HTML;