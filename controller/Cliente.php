<?php

namespace controller;

use service\ClienteService;

class Cliente{
    public function cadastrar(){
        $nome = $_POST["nome"];
        $email = $_POST["email"];

        $service = new ClienteService();
        $resultado = $service->inserir($nome,$email);
    }
    public function atualizar(){
        $id = $_POST["id"];
        $nome = $_POST["nome"];
        $email = $_POST["email"];

        $service = new ClienteService();
        $service->atualizarDados($id,$nome,$email);

        echo"Usuário atualizado com sucesso!";
    }
}