<?php

namespace service;

use dao\ProgressoDAO;

class ProgressoService extends ProgressoDAO{
    public function registrar($usuarioId, $desafioId, $progresso)
    {
        if (!$desafioId || $progresso === null) {
            return 'Todos os campos são obrigatórios!';
        }

        if ($progresso < 0 || $progresso > 100) {
            return 'O progresso deve estar entre 0 e 100!';
        }

        // Verifica se já existe progresso registrado
        $registroExistente = $this->buscarPorUsuarioDesafio($usuarioId, $desafioId);

        if ($registroExistente) {
            $sucesso = $this->atualizarProgresso($usuarioId, $desafioId, $progresso);
        } else {
            $sucesso = $this->inserirProgresso($usuarioId, $desafioId, $progresso);
        }

        return $sucesso ? "Progresso registrado com sucesso!" : "Erro ao registrar progresso!";
    }
}