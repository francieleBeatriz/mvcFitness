<?php
namespace dao;

use generic\MysqlFactory;

class ClienteDAO extends MysqlFactory
{
    public function inserir($nome, $email)
    {
        $sql = "insert into usuarios (nome, email) values (:nome, :email)";

        return $this->banco->executar(
            $sql, 
            [
                ":nome" => $nome,
                ":email" => $email
            ]
        );
    }
    
    public function atualizar($id, $nome, $email)
    {
        $sql = "update usuarios set nome = :nome, email = :email where id = :id";

        return $this->banco->executar($sql, [
            ":id" => $id,
            ":nome" => $nome,
            ":email" => $email
        ]);
    }
}