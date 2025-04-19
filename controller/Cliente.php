<?php

namespace controller;

use service\ClienteService;

class Cliente
{
    public function cadastrar(){
        $nome = $_POST["nome"] ?? null;
        $email = $_POST["email"] ?? null;
        $senha = $_POST["senha"] ?? null;
        $confirmarSenha = $_POST["confirmarSenha"] ?? null;

        $service = new ClienteService();
        $resultado = $service->inserirCliente($nome, $email, $senha, $confirmarSenha);

        return $resultado;
    }

    public function autenticar()
    {   
        $email = $_POST["email"];
        $senha = $_POST["senha"];

        $service = new ClienteService();
        $usuario = $service->autenticarCliente($email, $senha);

        echo $usuario;
    }

    public function atualizar(){
        $id = $_SESSION["id"];
        $nome = $_POST["nome"];
        $email = $_POST["email"];
        $senha = $_POST["senha"] ?? "";

        $service = new ClienteService();
        $resultado =  $service->atualizarDados($id,$nome,$email,$senha);

        echo $resultado;
    }

    public function deletar()
    {
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $service = new ClienteService();
        $resultado = $service->deletarUsuario($email, $senha);

        echo $resultado;
    }

}