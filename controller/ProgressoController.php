<?php

namespace controller;

use service\ProgressoService;

class ProgressoController{
    public function registrarProgresso()
    {
        $usuarioId = $_SESSION['id'];
        $desafioId = $_POST['desafio_id'];
        $progresso = $_POST['progresso'];

        $service = new ProgressoService();
        $resultado = $service->registrar($usuarioId, $desafioId, $progresso);

        echo $resultado;
    }
}