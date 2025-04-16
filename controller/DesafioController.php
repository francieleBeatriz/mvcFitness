<?php
namespace controller;

use service\DesafioService;

class DesafioController
{
    public function criarDesafio()
    {
        $idUsuario = $_SESSION['id'];

        $nome = $_POST['nome'];
        $descricao = $_POST['descricao'];

        $service = new DesafioService();
        $resultado = $service->criar($idUsuario,$nome, $descricao);

        echo $resultado;
    }
    
    public function atualizarDesafio()
    {
        $idUsuario = $_SESSION['id'];

        $idDesafio = $_POST['id'];
        $nome = $_POST['nome'];
        $descricao = $_POST['descricao'];

        $service = new DesafioService();
        $resultado = $service->atualizar($idUsuario,$idDesafio,$nome, $descricao);

        echo $resultado;
    }
    public function deletarDesafio(){
        $idUsuario = $_SESSION['id'];
  
        $idDesafio = $_POST['id'];

        $service = new DesafioService();
        $resultado = $service->deletar($idDesafio, $idUsuario);
    
        echo $resultado;
    }
}