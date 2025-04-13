<?php
use views\builders\FormBuilder;

$formBuilder = new FormBuilder(
    action: '/api/login/', 
    method: 'POST', 
    titulo: "Login", 
    descricaoPagina: "Transforme treino em desafio. Crie, participe e acompanhe sua evolução em uma plataforma feita para quem busca ir além."
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
    placeholder: 'Digite seu e-mail aqui'
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

        <link rel="stylesheet" href="/public/assets/css/global.css">

        <style>
            .container {
                max-width: 600px;
                padding: 20px;
            }

            .logo {
                width: 80px;
                height: 80px;
                background-image: url('/public/assets/imgs/logo.jpg'); /* substitua pelo caminho correto da sua imagem */
                background-repeat: no-repeat;
                background-size: 180%; /* aumenta o zoom da imagem */
                background-position: center; /* centraliza a parte visível */
                background-origin: content-box;
                border-radius: 20px;
            }

            .logo img {
                width: 50px;
            }

            input[type="email"],
            input[type="password"] {
                width: 100%;
                padding: 12px;
                border: 2px solid transparent;
                border-radius: 8px;
                background-image: 
                    linear-gradient(#060a23, #060a23), /* fundo interno */
                    linear-gradient(to right, #FF2E92 0%, #FF8C1A 50%, #6B1EFF 100%); /* borda gradiente */
                background-origin: border-box;
                background-clip: padding-box, border-box;
                color: white;
                outline: none;
            }

            input::placeholder {
                color: #aaa;
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
                Deseja criar uma conta? <a href="http://localhost/cadastrar/">Crie uma conta aqui</a>
            </div>
        </div>
    </body>
    </html>
HTML;