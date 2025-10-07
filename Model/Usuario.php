<?php

class Usuario
{
    private $id;
    private $nome;
    private $cpf;
    private $email;
    private $endereco;
    private $dataNascimento;
    private $senha;

    // atributos da classe

    //ID
    public function setId($id)
    {
        $this->id = $id;
    }
    public function getId()
    {
        return $this->id;
    }

    //Nome
    public function setNome($nome)
    {
        $this->nome = $nome;
    }
    public function getNome()
    {
        return $this->nome;
    }

    //CPF
    public function setCpf($cpf)
    {
        $this->cpf = $cpf;
    }
    public function getCpf()
    {
        return $this->cpf;
    }

    //Email
    public function setEmail($email)
    {
        $this->email = $email;
    }
    public function getEmail()
    {
        return $this->email;
    }
    //Endereco
    public function setEndereco($endereco)
    {
        $this->endereco = $endereco;
    }
    public function getEndereco()
    {
        return $this->endereco;
    }

    //Data de nascimento
    public function setDataNascimento($dataNascimento)
    {
        $this->dataNascimento = $dataNascimento;
    }
    public function getDataNascimento()
    {
        return $this->dataNascimento;
    }

    // Senha
    public function setSenha($senha)
    {
        $this->senha = $senha;
    }
    public function getSenha()
    {
        return $this->senha;
    }

    //Métodos da classe
    public function inserirBD()
    {
        require_once 'ConexaoBD.php';
        $con = new ConexaoBD();
        $conn = $con->conectar();
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "INSERT INTO usuario (nome, cpf, dataNascimento, email, endereco, senha ) VALUES (
        '" . $this->nome . "',
        '" . $this->cpf . "',
        '" . $this->dataNascimento . "',
        '" . $this->email . "',
        '" . $this->endereco . "',
        '" . $this->senha . "'
        )";

        // Verifica se a consulta foi bem-sucedida
        if ($conn->query($sql) === TRUE) {
            $this->id = mysqli_insert_id($conn);
            $conn->close();
            return TRUE;
        } else {
            $conn->close();
            return FALSE;
        }
    }
    public function carregarUsuario($cpf)
    {
        require_once 'ConexaoBD.php';
        $con = new ConexaoBD();
        $conn = $con->conectar();
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM usuario WHERE cpf = '" . $cpf . "'";
        $re = $conn->query($sql);
        $r = $re->fetch_object();

        if ($r != null) {
            $this->id = $r->idusuario;
            $this->nome = $r->nome;
            $this->email = $r->email;
            $this->endereco = $r->endereco;
            $this->cpf = $r->cpf;
            $this->dataNascimento = $r->dataNascimento;
            $this->senha = $r->senha;

            $conn->close();
            return true;
        } else {
            $conn->close();
            return false;
        }
    }


    public function atualizarBD()
    {
        require_once 'ConexaoBD.php';
        $con = new ConexaoBD();
        $conn = $con->conectar();
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "UPDATE usuario SET nome = '" . $this->nome . "', cpf = '" . $this->cpf . "', dataNascimento = '" . $this->dataNascimento . "', email='" . $this->email . "' , endereco='" . $this->endereco . "' WHERE idusuario ='" . $this->id . "'";

        if (
            $conn->query($sql) === TRUE
        ) {
            $conn->close();
            return TRUE;
        } else {
            $conn->close();
            return FALSE;
        }
    }

    public function listaCadastrados()
    {
        require_once 'ConexaoBD.php';
        $con = new ConexaoBD();
        $conn = $con->conectar();
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "SELECT idusuario, nome, cpf, email, endereco, dataNascimento FROM usuario;";
        $re = $conn->query($sql);
        $conn->close();
        return $re;
    }
}
