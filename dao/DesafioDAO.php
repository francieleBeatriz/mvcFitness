<?php
namespace dao;

use generic\MysqlFactory;

class DesafioDAO extends MysqlFactory
{
    public function inserir($idUsuario,$nome,$descricao)
    {
        $sql = "INSERT INTO desafios (usuario_id,nome, descricao) VALUES (:usuario_id, :nome, :descricao)";

        return $this->banco->executar(
            $sql, 
            [
                ":usuario_id" => $idUsuario,
                ":nome" => $nome,
                ":descricao" => $descricao,
            ]
        );
    }

    public function atualizarDesafio($idDesafio,$nome,$descricao)
    {
        $sql = 'UPDATE desafios SET nome = :nome, descricao = :descricao WHERE id = :id';
        return $this->banco->executar($sql, [
            ":id" => $idDesafio,
            ":nome" => $nome,
            ":descricao" => $descricao
        ]);
    }
    
    public function buscarPorId($idDesafio)
    {
        $sql = "SELECT * FROM desafios WHERE id = :id";
        $resultado = $this->banco->executar($sql, [":id" => $idDesafio]);
    
        return $resultado ? $resultado[0] : null;
    }

    public function deletarDesafio($idDesafio){
        $sql = "DELETE FROM desafios WHERE id = :id";
        return $this->banco->executar($sql, [":id" => $idDesafio]);
    }

    public function buscarTodosOsDesafios()
    {
        $sql = "SELECT * FROM desafios";
        return $this->banco->executar($sql);
    }

    public function buscarTodosDesafiosUsuario($idUsuario)
    {
        $sql = "SELECT * FROM desafios WHERE usuario_id = :usuario_id";
        return $this->banco->executar($sql, [
            ":usuario_id" => $idUsuario
        ]);
    }


}