<?php
namespace service;

use dao\ClienteDAO;

class ClienteService extends ClienteDAO
{
    public function inserirCliente($nome,$email){
        return parent::inserir($nome,$email);
    }
    public function atualizarDados($id,$nome,$email){
        return parent::atualizar($id,$nome,$email);
    }
}