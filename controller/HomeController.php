<?php

namespace controller;

use views\template\DefaultTemplate;

class HomeController
{
    public function desafios()
    {
        $template = new DefaultTemplate();
        $template->layout("/public/desafios.php", [
            "rota" => "/mvcFitness/home/cadastrar",
            "tituloBotao" => "Cadastrar Desafio"
        ]);
    }

    public function cadastrarDesafio()
    {
        $template = new DefaultTemplate();
        $template->layout("/public/cadastrarDesafio.php");
    }

    public function editarDesafio()
    {
        $template = new DefaultTemplate();
        $template->layout("/public/cadastrarDesafio.php");
    }
}