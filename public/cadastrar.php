<?php
session_destroy();  

use views\builders\FormBuilder;
$feedback = [];
if(isset($_GET["sucesso"]))
    $feedback = [
        "O usuário foi cadastrado com sucesso!",
        "padding: 10px; background-color: darkgreen; border-radius: 5px; font-weight: 600; margin-top: 5px; margin-bottom: 5px;",
        "<i class='fa-solid fa-check me-2'></i>"
    ];
else if(isset($_GET["erro"]))
    $feedback = [
        "Houve um erro ao realizar o cadastro!",
        "padding: 10px; background-color: crimson; border-radius: 5px; font-weight: 600; margin-top: 5px; margin-bottom: 5px;",
        "<i class='fa-solid fa-triangle-exclamation me-2'></i>"
    ];

$formBuilder = new FormBuilder(
    action: '/mvcFitness/api/cliente/cadastrar', 
    method: 'POST', 
    titulo: "Criar Conta", 
    descricaoPagina: "Crie sua conta e comece agora mesmo a participar dos desafios e acompanhar seu progresso.",
    feedback: $feedback
);
$formBuilder->addInput(
    type: 'text', 
    name: 'nome', 
    label: 'Nome', 
    placeholder: 'Digite seu o seu nome aqui'
);
$formBuilder->addInput(
    type: 'email', 
    name: 'email', 
    label: 'E-mail', 
    placeholder: 'Digite seu e-mail aqui'
);
$formBuilder->addInput(
    type: 'password', 
    name: 'senha', 
    label: 'Senha', 
    placeholder: 'Digite a sua senha aqui'
);
$formBuilder->addInput(
    type: 'password', 
    name: 'confirmarSenha', 
    label: 'Repetir senha', 
    placeholder: 'Digite a sua senha novamente aqui'
);
$formBuilder->addButton(
    label: 'Entrar'
);
$form = $formBuilder->render();

echo <<<HTML
    <!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <title>Criar Conta</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" 
        rel="stylesheet" 
        integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" 
        crossorigin="anonymous">

        <script src="https://kit.fontawesome.com/e5aedbc5af.js" crossorigin="anonymous"></script>

        <link rel="stylesheet" href="/mvcFitness/public/assets/css/global.css">

        <script src=""></script>

        <style>
            .container {
                max-width: 600px;
                padding: 20px;
            }

            .logo {
                width: 80px;
                height: 80px;
                background-image: url('/mvcFitness/public/assets/imgs/logo.jpg'); /* substitua pelo caminho correto da sua imagem */
                background-repeat: no-repeat;
                background-size: 180%; /* aumenta o zoom da imagem */
                background-position: center; /* centraliza a parte visível */
                background-origin: content-box;
                border-radius: 20px;
            }

            .logo img {
                width: 50px;
            }

            button {
                width: 100%;
                padding: 12px;
                margin-top: 10px;
                background-color: #ff4f68;
                color: white;
                border: none;
                border-radius: 6px;
                font-weight: bold;
                cursor: pointer;
                transition: background-color 0.3s;
            }

            button:hover {
                background-color: #e13c58;
            }

            .login-link {
                text-align: center;
                margin-top: 15px;
                font-size: 12px;
            }

            .login-link a {
                color: #aaa;
                text-decoration: none;
            }

            .login-link a:hover {
                text-decoration: underline;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="logo"></div>
            $form
            <div class="login-link">
                Já criou uma conta? <a href="http://localhost/mvcFitness/login">Faça o login aqui</a>
            </div>
        </div>
    </body>
    </html>
HTML;