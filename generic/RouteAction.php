<?php
namespace generic;
class RouteAction{
    private $classe;
    private $metodo;

    public function __construct($classe, $metodo){
        $this->classe = "controller\\".$classe;
        $this->metodo = $metodo;
    }
    
    public function executar(){
        $objeto = new $this->classe();
        $objeto->{$this->metodo}();
    }
}