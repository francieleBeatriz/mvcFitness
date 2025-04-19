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
        $sql = <<<SQL
            SELECT 
                d.id, 
                d.nome, 
                d.descricao, 
                d.usuario_id,
                ROUND(COALESCE(AVG(p.progresso), 0), 2) AS progresso
            FROM desafios d
            LEFT JOIN progresso p
                ON p.desafio_id = d.id
            GROUP BY d.id, d.nome, d.descricao
        SQL;
        return $this->banco->executar($sql);
    }

    public function buscarTodosDesafiosUsuario($idUsuario)
    {
        $sql = <<<SQL
            SELECT 
                d.id, 
                d.nome, 
                d.descricao, 
                d.usuario_id,
                ROUND(COALESCE(AVG(p.progresso), 0), 2) AS progresso
            FROM desafios d
            LEFT JOIN progresso p
                ON p.desafio_id = d.id
            WHERE d.usuario_id = :usuario_id
                OR p.usuario_id = :usuario_id
            GROUP BY d.id, d.nome, d.descricao
        SQL;

        return $this->banco->executar($sql, [
            ":usuario_id" => $idUsuario
        ]);
    }


}