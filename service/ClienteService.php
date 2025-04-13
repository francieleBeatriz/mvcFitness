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

        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
        $sucesso = parent::inserir($nome, $email, $senhaHash);

        return $sucesso ? "Usuário cadastrado com sucesso!" : "Erro ao cadastrar o usuário";
    }

    public function autenticarCliente($email, $senha)
    {
        if (!$email || !$senha) {
            return "Todos os campos são obrigatórios!";
        }

        $usuario = $this->autenticar($email);

        try{
            if ($usuario && password_verify($senha, $usuario['senha'])) {
                session_start();

                $_SESSION['nome'] = $usuario['nome'];
                $_SESSION['email'] = $usuario['email'];

                return "Login bem-sucedido!"; 
            } 
            else {
                return "Email ou senha inválidos!";
            }
        }
        catch(Exception $e){
            return 'houve um problema ao realizar a autenticação!';
        }
    }

    public function atualizarDados($id, $nome, $email)
    {
        return parent::atualizar($id, $nome, $email);
    }
}
