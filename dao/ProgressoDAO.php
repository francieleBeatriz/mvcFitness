<?php
namespace dao;
use generic\MysqlFactory;

class ProgressoDAO extends MysqlFactory{
    public function inserirProgresso($usuarioId, $desafioId, $progresso)
    {
        $sql = "INSERT INTO progresso (usuario_id, desafio_id, progresso) 
                VALUES (:usuario_id, :desafio_id, :progresso)";

        return $this->banco->executar($sql, [
            ":usuario_id" => $usuarioId,
            ":desafio_id" => $desafioId,
            ":progresso" => $progresso
        ]);
    }

    public function atualizarProgresso($usuarioId, $desafioId, $progresso)
    {
        $sql = "UPDATE progresso 
                SET progresso = :progresso 
                WHERE usuario_id = :usuario_id AND desafio_id = :desafio_id";

        return $this->banco->executar($sql, [
            ":usuario_id" => $usuarioId,
            ":desafio_id" => $desafioId,
            ":progresso" => $progresso
        ]);
    }

    public function buscarPorUsuarioDesafio($usuarioId, $desafioId)
    {
        $sql = "SELECT u.id, u.nome, p.id as progresso_id, p.progresso 
                FROM progresso p
                JOIN usuarios u
                    ON p.usuario_id = u.id
                WHERE p.usuario_id = :usuario_id AND p.desafio_id = :desafio_id";

        $resultado = $this->banco->executar($sql, [
            ":usuario_id" => $usuarioId,
            ":desafio_id" => $desafioId
        ]);

        return $resultado ? $resultado : null;
    }

    public function buscarTodosOsProgressos()
    {
        $sql = "SELECT * FROM progresso";
        return $this->banco->executar($sql);
    }

    public function listarProgressoPorDesafio($desafioId)
    {
        $sql = "SELECT u.id, u.nome, p.id as progresso_id, p.progresso  FROM progresso p
                JOIN usuarios u
                    ON p.usuario_id = u.id
                WHERE desafio_id = :desafio_id";
        return $this->banco->executar($sql, [
            ":desafio_id" => $desafioId
        ]);
    }

}