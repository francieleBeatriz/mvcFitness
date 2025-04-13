<?php
namespace dao;

use generic\MysqlFactory;

class ClienteDAO extends MysqlFactory
{
    public function inserir($nome, $email, $senha)
    {


        $sql = "insert into usuarios (nome, email, senha) values (:nome, :email, :senha)";

        return $this->banco->executar(
            $sql, 
            [
                ":nome" => $nome,
                ":email" => $email,
                ":senha" => $senha
            ]
        );
    }

    public function autenticar($email)
    {
        $sql = "SELECT * FROM usuarios WHERE email = :email";
        $resultado = $this->banco->executar($sql, [
            ":email" => $email
        ]);

        return $resultado ? $resultado[0] : null; // Retorna o usuário ou null
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