<?php
namespace service;

use dao\DesafioDAO;

class DesafioService extends DesafioDAO
{
    public function criar($idUsuario,$nome,$descricao)
    {
        if(!$nome || !$descricao){
            header("Location: /mvcFitness/home/cadastrar?erro=Por favor, preencha todos os campos!");
            exit;
        }

        $sucesso = $this->inserir($idUsuario,$nome,$descricao);

        if(!$sucesso)   
        {
            header("Location: /mvcFitness/home/cadastrar?erro=Erro ao criar desafio!");
            exit;
        }

        header("Location: /mvcFitness/home/cadastrar?sucesso=Desafio criado com sucesso!");
        exit;
    }

    public function atualizar($idUsuario,$idDesafio,$nome,$descricao)
    {
        if(!$nome || !$descricao){
            header("Location: /mvcFitness/home/cadastrar?erro=Por favor, preencha todos os campos!");
            exit;
        }

        $desafioExistente = $this->buscarPorId($idDesafio);

        if (!$desafioExistente) {
            header("Location: /mvcFitness/home/cadastrar?erro=Desafio não encontrado!");
            exit;
        }

        if ($desafioExistente['usuario_id'] != $idUsuario) {
            header("Location: /mvcFitness/home/cadastrar?erro=Você não tem permissão para atualizar este desafio!");
            exit;
        }

        $sucesso = $this->atualizarDesafio($idDesafio,$nome,$descricao);

        if(!$sucesso){
            header("Location: /mvcFitness/home/cadastrar?erro=Erro ao atualizar desafio!");
            exit;
        }

        header("Location: /mvcFitness/home/cadastrar?sucesso=Desafio atualizado com sucesso!&desafio_id=$idDesafio");
        exit;
    }

    public function deletar($idDesafio, $idUsuario)
    {
        $desafio = $this->buscarPorId($idDesafio);

        if (!$desafio) {
            header("Location: /mvcFitness/home?erro=Desafio não encontrado!");
            exit;
        }

        if ($desafio['usuario_id'] != $idUsuario) {
            header("Location: /mvcFitness/home?erro=Você não tem permissão para deletar este desafio!");
            exit;
        }

        $sucesso = $this->deletarDesafio($idDesafio);

        if(!$sucesso)
        {
            header("Location: /mvcFitness/home?erro=Erro ao deletar desafio!");
            exit;
        }

        header("Location: /mvcFitness/home?sucesso=Desafio deletado com sucesso!");
        exit;
    }

    public function listarTodosOsDesafios()
    {
        $desafios = $this->buscarTodosOsDesafios();
        return $desafios ?: "";
    }

    public function listarDesafiosDoUsuario($idUsuario)
    {
        $desafios = $this->buscarTodosDesafiosUsuario($idUsuario);
        return $desafios ?: "Nenhum desafio encontrado.";
    }

    public function buscarPorId($idDesafio)
    {
        return parent::buscarPorId($idDesafio);
    }
}