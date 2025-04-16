<?php
namespace generic;
class RouteAction{
    private $classe;
    private $metodo;
    private $auth;

    public function __construct($classe, $metodo, $auth = false)
    {
        $this->classe = "controller\\".$classe;
        $this->metodo = $metodo;
        $this->auth = $auth;
    }
    
    public function executar()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if ($this->auth && !isset($_SESSION['id'])) {
            echo "Você precisa estar logado para acessar essa rota!";
            return;
        }
        $objeto = new $this->classe();
        $objeto->{$this->metodo}();
    }
}