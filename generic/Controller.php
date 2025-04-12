<?php
namespace generic;

class Controller{
    private $rotas = [];
    public function __construct()
    {
        $this->rotas = [
            "cliente/cadastrar" => new RouteAction("Cliente", "cadastrar"),
            "cliente/logar" => new RouteAction("Cliente", "logar")
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
}