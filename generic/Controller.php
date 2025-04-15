<?php
namespace generic;

class Controller{
    private $rotas = [];
    public function __construct()
    {
        $this->rotas = [
            "api/cliente/cadastrar" => new RouteAction("Cliente", "cadastrar"),
            "api/cliente/atualizar" => new RouteAction("Cliente", "atualizar"),
            "api/cliente/autenticar" => new RouteAction("Cliente", "autenticar"),
            "api/cliente/deletar" => new RouteAction("Cliente", "deletar"),

            "api/desafio/criar" => new RouteAction("Desafio", "criarDesafio"),
            "api/desafio/atualizar" => new RouteAction("Desafio", "atualizarDesafio"),
            "api/desafio/deletar" => new RouteAction("Desafio", "deletarDesafio")
        ];
    }

    public function verificarCaminho($rota){
        if(isset($this->rotas[$rota])){
            $acao = $this->rotas[$rota];
            $acao->executar();
            return;
        }

        echo 'Rota não existe!';
    }

    public function addRota(
        string $rota, 
        RouteAction $metodo
    ): void
    {
        $this->rotas[$rota] = $metodo;
    }
}