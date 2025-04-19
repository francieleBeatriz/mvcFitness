<?php

namespace views\template;

class DefaultTemplate
{
    public function cabecalho($params = [])
    {
        if(!isset($_SESSION["nome"]))
        {
            header("Location: /mvcFitness/login");
            die();
        }
        
        $button = "";
        
        if ($params)
        {
            $button = <<<HTML
                <button class="btn-cadastrar" onclick="window.location.href = '{$params['rota']}'">
                    <i class="fa-solid fa-plus me-2" style="font-size: 16px;"></i> Cadastrar
                </button>           
            HTML;
        }

        $end = $params ? "between" : "end";

        echo <<<HTML
            <html>
                <head>
                    <title>Fitness APP</title>
                    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" 
                    rel="stylesheet" 
                    integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" 
                    crossorigin="anonymous">
                    <link rel="stylesheet" href="/mvcFitness/public/assets/css/global.css">

                    <script src="https://kit.fontawesome.com/e5aedbc5af.js" crossorigin="anonymous"></script>

                    <style>
                        header
                        {
                            width: 100%;
                            height: 48px;
                        }
                    </style>    
                </head>
                <body>
                    <header class="d-flex justify-content-$end align-items-center">
                        $button
                        <button class="user-info d-flex align-items-center justify-content-center" style="border: none; background-color: transparent;" 
                        onclick="window.location.href = '/mvcFitness/perfil'">
                            <i class="fa-solid fa-user user-icon me-2" style=""></i>
                            <span class="user-name">{$_SESSION["nome"]}</span>
                        </button>
                    </header>
        HTML;
    }

    public function rodape()
    {
        echo <<<HTML
                </body>
            </html>
        HTML;
    }

    public function layout($caminho, $parametro = null)
    {
        $this->cabecalho($parametro);
        include_once $_SERVER["DOCUMENT_ROOT"] . "/mvcFitness". $caminho;
        $this->rodape();
    }
    
}