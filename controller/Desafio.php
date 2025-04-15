<?php
namespace controller;

use service\DesafioService;

class Desafio
{
    public function criarDesafio()
    {
        session_start();

        $idUsuario = $_SESSION['id'];

        if (!isset($idUsuario)) {
            echo "Você precisa estar logado para criar um desafio!";
            return;
        }

        $idUsuario = $_SESSION['id'];

        $nome = $_POST['nome'];
        $descricao = $_POST['descricao'];

        $service = new DesafioService();
        $resultado = $service->criar($idUsuario,$nome, $descricao);

        echo $resultado;
    }
    
    public function atualizarDesafio()
    {
        session_start();

        $idUsuario = $_SESSION['id'];
  
        if (!isset($idUsuario)) {
            echo "Você precisa estar logado para atualizar um desafio!";
            return;
        }

        $idDesafio = $_POST['id'];
        $nome = $_POST['nome'];
        $descricao = $_POST['descricao'];

        $service = new DesafioService();
        $resultado = $service->atualizar($idUsuario,$idDesafio,$nome, $descricao);

        echo $resultado;
    }
    public function deletarDesafio(){
        session_start();

        $idUsuario = $_SESSION['id'];
  
        if (!isset($idUsuario)) {
            echo "Você precisa estar logado para atualizar um desafio!";
            return;
        }

        $idDesafio = $_POST['id'];

        $service = new DesafioService();
        $resultado = $service->deletar($idDesafio, $idUsuario);
    
        echo $resultado;
    }
}