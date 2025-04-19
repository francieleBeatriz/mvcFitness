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

        $params = [
            ":id" => $id,
            ":nome" => $nome,
            ":email" => $email,
            ":senha" => $senhaHash
        ];
        $senha = ", senha = :senha";

        if(!$senha){
            $params = [
                ":id" => $id,
                ":nome" => $nome,
                ":email" => $email
            ];
            $senha = "";
        }
        
        $sql = "update usuarios set nome = :nome, email = :email$senha where id = :id";

        return $this->banco->executar($sql, $params);
    }

    public function buscarPorEmail($email){
        $sql = "SELECT * FROM usuarios WHERE email = :email";
        $resultado = $this->banco->executar($sql, [
            ":email" => $email
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