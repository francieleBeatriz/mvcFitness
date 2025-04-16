<?php
namespace service;

use dao\ClienteDAO;
use Exception;

class ClienteService extends ClienteDAO
{
    public function inserirCliente($nome, $email, $senha, $confirmarSenha)
    {
        if (!$nome || !$email || !$senha || !$confirmarSenha) {
            return "Todos os campos são obrigatórios!";
        }

        if ($senha !== $confirmarSenha) {
            return "As senhas não coincidem!"; 
        }

        $senhaHash = password_hash($senha, PASSWORD_BCRYPT);
        $sucesso = parent::inserir($nome, $email, $senhaHash);

        if($sucesso)
        {
            header("Location: /mvcFitness/cadastrar?sucesso=1");
            die();
        }

        return "Erro ao cadastrar o usuário";
    }

    public function autenticarCliente($email, $senha)
    {
        if (!$email || !$senha) {
            return "Todos os campos são obrigatórios!";
        }

        $usuario = $this->autenticar($email);

        try{
            if ($usuario && password_verify($senha, $usuario['senha'])) 
            {
                session_start();
                $_SESSION['id'] = $usuario['id'];
                $_SESSION['nome'] = $usuario['nome'];
                $_SESSION['email'] = $usuario['email'];

                return "Usuário logado com sucesso!";
                header("Location: /mvcFitness/home/");
                die();
            } 
            else {
                return "Email ou senha inválidos!";
            }
        }
        catch(Exception $e){
            return 'houve um problema ao realizar a autenticação!';
        }
    }

    public function atualizarDados($id, $nome, $email, $senha)
    {
        if (!$id || !$nome || !$email || !$senha) {
            return "Todos os campos são obrigatórios!";
        }

        $usuarioExistente = $this->buscarPorEmail($email);

        if ($usuarioExistente && $usuarioExistente['id'] != $id) {
            return "Este e-mail já está em uso por outro usuário!";
        }

        $sucesso = parent::atualizar($id,$nome,$email,$senha);

        return $sucesso !== false ? "Usuário atualizado com sucesso!" : "Erro ao atualizar o usuário!";
    }

    public function deletarUsuario($email, $senha)
    {
        if(!$email || !$senha){
            return "Email e senha são obrigatórios!";
        }

        $usuario = $this->buscarPorEmail($email);

        if(!$usuario){
            return "Usuário não encontrado!";
        }

        if (!password_verify($senha, $usuario['senha'])) {
            return "Senha incorreta!";
        }

        $sucesso = $this->deletar($email);

        return $sucesso ? "Usuário deletado com sucesso!" : "Erro ao deletar o usuário!";
    }
}

    
