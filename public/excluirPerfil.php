<?php
use service\ClienteService;
use views\builders\FormBuilder;

$feedback = [];

$clienteService = new ClienteService();
$cliente = $clienteService->buscarPorEmail($_SESSION["email"]);

$formBuilder = new FormBuilder(
    action: '/mvcFitness/api/cliente/deletar', 
    method: 'POST', 
    titulo: "Excluir Conta", 
    descricaoPagina: "Exclua sua conta agora preenchendo os dados",
    feedback: $feedback
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
    label: 'Senha', 
    placeholder: 'Digite aqui a sua senha',
    value: ""
);
$formBuilder->addButton(
    label: 'Excluir'
);
$form = $formBuilder->render();

echo <<<HTML
    $form
HTML;