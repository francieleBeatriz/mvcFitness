<?php
namespace generic;

class Controller{
    private $rotas = [];
    public function __construct()
    {
        $this->rotas = [
            "api/cliente/cadastrar" => new RouteAction("Cliente", "cadastrar"),
            "api/cliente/atualizar" => new RouteAction("Cliente", "atualizar", true),
            "api/cliente/autenticar" => new RouteAction("Cliente", "autenticar"),
            "api/cliente/deletar" => new RouteAction("Cliente", "deletar", true),

            "api/desafio/registrar" => new RouteAction("Desafio", "criarDesafio", true),
            "api/desafio/atualizar" => new RouteAction("Desafio", "atualizarDesafio", true),
            "api/desafio/deletar" => new RouteAction("Desafio", "deletarDesafio", true),

            "api/progresso/registrar" => new RouteAction("Desafio", "criarDesafio", true),
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