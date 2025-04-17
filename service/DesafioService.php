<?php
namespace service;

use dao\DesafioDAO;

class DesafioService extends DesafioDAO
{
    public function criar($idUsuario,$nome,$descricao)
    {
        if(!$nome || !$descricao){
            return'Por favor, preencha todos os campos!';
        }

        $sucesso = $this->inserir($idUsuario,$nome,$descricao);

        return $sucesso ? "Desafio criado com sucesso!" : "Erro ao criar desafio!";
    }

    public function atualizar($idUsuario,$idDesafio,$nome,$descricao)
    {
        if(!$nome || !$descricao){
            return'Por favor, preencha todos os campos!';
        }

        $desafioExistente = $this->buscarPorId($idDesafio);

        if (!$desafioExistente) {
            return 'Desafio não encontrado!';
        }

        if ($desafioExistente['usuario_id'] != $idUsuario) {
            return 'Você não tem permissão para atualizar este desafio!';
        }

        $sucesso = $this->atualizarDesafio($idDesafio,$nome,$descricao);

        return $sucesso ? "Desafio atualizado com sucesso!" : "Erro ao atualizar desafio!";
    }

    public function deletar($idDesafio, $idUsuario)
    {
        $desafio = $this->buscarPorId($idDesafio);

        if (!$desafio) {
            return "Desafio não encontrado!";
        }

        if ($desafio['usuario_id'] != $idUsuario) {
            return "Você não tem permissão para deletar este desafio!";
        }

        $sucesso = $this->deletarDesafio($idDesafio);
            return $sucesso ? "Desafio deletado com sucesso!" : "Erro ao deletar desafio!";
        }

    public function listarTodosOsDesafios()
    {
        $desafios = $this->buscarTodosOsDesafios();
        return $desafios ?: "Nenhum desafio encontrado.";
    }

    public function listarDesafiosDoUsuario($idUsuario)
    {
        $desafios = $this->buscarTodosDesafiosUsuario($idUsuario);
        return $desafios ?: "Nenhum desafio encontrado.";
    }

        
}