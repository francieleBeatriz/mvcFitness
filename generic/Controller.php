<?php
namespace generic;

class Controller{
    private $rotas = [];
    
    public function __construct()
    {
        $this->rotas = [
            "Cadastrar" => new RouteAction("controller\ClienteController", "cadastrar"),
            "Logar" => new RouteAction("controller\ClienteController", "logar"),
        ];
    }

    public function verificarCaminho($rota){
        if(isset($this->rotas[$rota])){
            $this->rotas[$rota]->executar();
            return;
        }
            echo 'Rota não existe!';
    }
}