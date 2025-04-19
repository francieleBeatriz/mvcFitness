<?php

namespace controller;

use views\template\DefaultTemplate;

class Perfil{
    public function perfil()
    {
        $template = new DefaultTemplate();
        $template->layout("/public/perfil.php");
    }
    public function excluir()
    {
        $template = new DefaultTemplate();
        $template->layout("/public/excluirPerfil.php");
    }
}