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

        return $resultado ? $resultado[0] : null;
    }

    public function atualizar($id, $nome, $email, $senha)
    {
        $senhaHash = password_hash($senha, PASSWORD_BCRYPT);
        $sql = "update usuarios set nome = :nome, email = :email, senha = :senha where id = :id";

        return $this->banco->executar($sql, [
            ":id" => $id,
            ":nome" => $nome,
            ":email" => $email,
            ":senha" => $senhaHash
        ]);
    }

    public function buscarPorEmail($email){
        $sql = "SELECT * FROM usuarios WHERE email = :email";
        $resultado = $this->banco->executar($sql, [
            ":email" => $email
        ]);
        return $resultado ? $resultado[0] : null;
    }

    public function buscarPorId($id)
    {
        $sql = "SELECT * FROM usuarios WHERE id = :id";
        $resultado = $this->banco->executar($sql, [
            ":id" => $id
        ]);
        return $resultado ? $resultado[0] : null;
    }


    public function deletar($email){
        $sql = "DELETE FROM usuarios WHERE email = :email";
        return $this->banco->executar($sql, [
            ":email" => $email
        ]);
    }
}