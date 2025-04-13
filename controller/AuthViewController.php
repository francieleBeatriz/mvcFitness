<?php
namespace controller;

class AuthViewController
{
    private string $raiz;

    public function __construct() {
        $this->raiz = $_SERVER["DOCUMENT_ROOT"];
    }

    public function login()
    {
        include_once $this->raiz . "/public/login.php";
    }

    public function cadastrar()
    {
        include_once $this->raiz . "/public/cadastrar.php";
    }

    public function esqueceuSenha()
    {
        return "Em construção";
    }
}