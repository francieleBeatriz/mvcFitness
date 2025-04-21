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
            exit;
        }

        return "Erro ao cadastrar o usuário";
    }

    public function autenticarCliente($email, $senha)
    {
        if (!$email || !$senha) {
            return "Todos os campos são obrigatórios!";
        }

        $usuario = $this->autenticar($email);

        try {
            if ($usuario && password_verify($senha, $usuario['senha'])) {
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }

                $_SESSION['id'] = $usuario['id'];
                $_SESSION['nome'] = $usuario['nome'];
                $_SESSION['email'] = $usuario['email'];

                header("Location: /mvcFitness/home");
                exit;
            } else {
                header("Location: /mvcFitness/login?erro=Email ou senha inválidos!");
                exit;
            }
        } catch(Exception $e){
            return 'Houve um problema ao realizar a autenticação!';
        }
    }

    public function atualizarDados($id, $nome, $email, $senha = "")
    {
        if (!$id || !$nome || !$email) {
            header("Location: /mvcFitness/perfil?erro=Todos os campos são obrigatórios!");
            exit;
        }

        $usuarioExistente = $this->buscarPorEmail($email);

        if ($usuarioExistente && $usuarioExistente['id'] != $id) {
            header("Location: /mvcFitness/perfil?erro=Este e-mail já está em uso por outro usuário!");
            exit;
        }

        $sucesso = parent::atualizar($id,$nome,$email,$senha);

        if(!$sucesso)
        {
            header("Location: /mvcFitness/perfil?erro=Erro ao atualizar o usuário!");
            exit;
        }

        $_SESSION["nome"] = $nome;
        $_SESSION["email"] = $email;
        header("Location: /mvcFitness/perfil?sucesso=Usuário atualizado com sucesso!");
        exit;
    }

    public function deletarUsuario($email, $senha)
    {
        if(!$email || !$senha){
            header("Location: /mvcFitness/perfil/excluir?erro=Email e senha são obrigatórios!");
            exit;
        }

        $usuario = $this->buscarPorEmail($email);

        if(!$usuario){
            header("Location: /mvcFitness/perfil/excluir?erro=Usuário não encontrado!");
            exit;
        }

        if (!password_verify($senha, $usuario['senha'])) {
            header("Location: /mvcFitness/perfil/excluir?erro=Senha incorreta!");
            exit;
        }

        $sucesso = $this->deletar($email);

        if(!$sucesso)
        {
            header("Location: /mvcFitness/perfil?erro=Erro ao deletar o usuário!");
            exit;
        }

        header("Location: /mvcFitness/login");
        exit;
    }

    public function buscarPorEmail($email)
    {
        return parent::buscarPorEmail($email);
    }
}

    
