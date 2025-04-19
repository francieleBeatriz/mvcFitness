<?php

use service\ClienteService;
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

$clienteService = new ClienteService();
$cliente = $clienteService->buscarPorEmail($_SESSION["email"]);

$formBuilder = new FormBuilder(
    action: '/mvcFitness/api/cliente/atualizar', 
    method: 'POST', 
    titulo: "Perfil", 
    descricaoPagina: "Registre seu progresso neste desafio e acompanhe sua evolução ao longo do tempo",
    feedback: $feedback
);
$formBuilder->addInput(
    type: 'text', 
    name: 'nome', 
    label: 'Nome', 
    placeholder: 'Digite aqui o seu nome',
    value: $cliente["nome"]
);
$formBuilder->addInput(
    type: 'email', 
    name: 'email', 
    label: 'E-mail', 
    placeholder: 'Digite aqui o seu e-mail',
    value: $cliente["email"]
);
$formBuilder->addInput(
    type: 'password', 
    name: 'senha', 
    label: 'Nova senha', 
    placeholder: 'Digite aqui a sua nova senha',
    value: ""
);
$formBuilder->addButton(
    label: 'Salvar'
);
$form = $formBuilder->render();

echo <<<HTML
    $form
    <button class="btn-salvar" style="border: 2px solid red; background-color: transparent; color: red;" onclick="window.location.href = '/mvcFitness/perfil/excluir'">
        <i class="fa-solid fa-trash me-2"></i>
        Excluir Conta
    </button>
HTML;