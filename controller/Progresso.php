<?php

namespace controller;

use service\ProgressoService;
use views\template\DefaultTemplate;

class Progresso{
    public function registrarProgresso()
    {
        $usuarioId = $_SESSION['id'];
        $desafioId = $_SESSION['desafio_id'];
        $progresso = $_POST['progresso'];

        $service = new ProgressoService();
        $resultado = $service->registrar($usuarioId, $desafioId, $progresso);

        echo $resultado;
    }

    public function progressos()
    {
        $template = new DefaultTemplate();
        $template->layout("/public/progressos.php",[
            "rota" => "/mvcFitness/home/progressos/cadastrar"
        ]);
    }

    public function cadastrar()
    {
        $template = new DefaultTemplate();
        $template->layout("/public/cadastrarProgresso.php");
    }

    public function editar()
    {
        $template = new DefaultTemplate();
        $template->layout("/public/cadastrarProgresso.php");
    }
}