<?php
namespace generic;

class Controller{
    private $rotas = [];
    public function __construct()
    {
        $this->rotas = [
            "api/cliente/cadastrar" => new RouteAction("Cliente", "cadastrar"),
            "api/cliente/atualizar" => new RouteAction("Cliente", "atualizar")
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