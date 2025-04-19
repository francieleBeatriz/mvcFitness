<?php

namespace service;

use dao\ProgressoDAO;

class ProgressoService extends ProgressoDAO{
    public function registrar($usuarioId, $desafioId, $progresso)
    {
        if (!$desafioId || $progresso === null) {
            header("Location: /mvcFitness/home/progressos/cadastrar?erro=Todos os campos são obrigatórios!");
            exit;
        }

        if ($progresso < 0 || $progresso > 100) {
            header("Location: /mvcFitness/home/progressos/cadastrar?erro=Progresso deve estar entre 0 e 100!");
            exit;
        }

        $registroExistente = $this->buscarPorUsuarioDesafio($usuarioId, $desafioId);

        if ($registroExistente) {
            $sucesso = $this->atualizarProgresso($usuarioId, $desafioId, $progresso);
        } else {
            $sucesso = $this->inserirProgresso($usuarioId, $desafioId, $progresso);
        }

        if(!$sucesso) {
            header("Location: /mvcFitness/home/progressos/cadastrar?erro=Erro ao registrar progresso!");
            exit;
        }

        header("Location: /mvcFitness/home/progressos/cadastrar?sucesso=Progresso registrado com sucesso!");
        exit;
    }

    public function listarTodosOsProgressos()
    {
        $dados = $this->buscarTodosOsProgressos();
        return $dados ?: "Nenhum progresso encontrado.";
    }

    public function listarProgressoPorDesafio($desafioId)
    {
        $progresso = parent::listarProgressoPorDesafio($desafioId);
        return $progresso ? $progresso : "";
    }

}