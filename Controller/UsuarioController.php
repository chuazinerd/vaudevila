<?php
if (!isset($_SESSION)) {
    session_start();
}
class UsuarioController
{
    public function inserir($nome, $cpf, $dataNascimento, $email, $endereco, $senha)
    {
        require_once '../Model/Usuario.php';
        $usuario = new Usuario();
        $usuario->setNome($nome);
        $usuario->setCPF($cpf);
        $usuario->setDataNascimento($dataNascimento);
        $usuario->setEmail($email);
        $usuario->setEndereco($endereco);
        $usuario->setSenha($senha);
        $r = $usuario->inserirBD();
        $_SESSION['Usuario'] = serialize($usuario);
        return $r;
    }

    public function atualizar($id, $nome, $cpf, $email, $endereco, $dataNascimento)
    {
        require_once '../Model/Usuario.php';
        $usuario = new Usuario();
        $usuario->setId($id);
        $usuario->setNome($nome);
        $usuario->setCpf($cpf);
        $usuario->setEmail($email);
        $usuario->setEndereco($endereco);
        $usuario->setDataNascimento($dataNascimento);



        $r = $usuario->atualizarBD();
        $_SESSION['Usuario'] = serialize($usuario);
        return $r;
    }

    public function login($cpf, $senha)
    {
        require_once '../Model/Usuario.php';
        $usuario = new Usuario();
        $usuario->carregarUsuario($cpf);
        $verSenha = $usuario->getSenha();
        if ($senha == $verSenha) {
            $_SESSION['Usuario'] = serialize($usuario);
            $_SESSION['idusuario'] = $usuario->getId();  // <-- Salva o id na sessão
            return true;
        } else {
            return false;
        }
    }

    public function gerarLista($idusuario)
    {
        require_once '../Model/OutrasFormacoes.php';
        $outrasform = new OutrasFormacoes();
        return $results = $outrasform->listaFormacoes($idusuario);
    }

}
