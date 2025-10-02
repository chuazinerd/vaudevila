<?php
if (!isset($_SESSION)) {
    session_start();
}

// Se não houve POST, carrega tela de login
if (empty($_POST)) {
    include_once "../View/login.php";
}

// --- Login ---
elseif (isset($_POST["btnLogin"])) {
    require_once "../Controller/UsuarioController.php";
    $uController = new UsuarioController();
    if ($uController->login($_POST["txtLogin"], $_POST["txtSenha"])) {
        include_once "../View/principal.php";
    } else {
        include_once "../View/cadastroNaoRealizado.php";
    }
}

// --- Primeiro Acesso ---
elseif (isset($_POST["btnPrimeiroAcesso"])) {
    include_once "../View/primeiroAcesso.php";
}

// --- Cadastrar ---
elseif (isset($_POST["btnCadastrar"])) {
    require_once "../Controller/UsuarioController.php";
    $uController = new UsuarioController();
    if ($uController->inserir(
        $_POST["txtNome"],
        $_POST["txtCpf"],
        date("Y-m-d", strtotime($_POST["DataNascimento"])),
        $_POST["txtEmail"],
        $_POST["txtEndereco"],
        $_POST["txtSenha"]
    )) {
        include_once "../View/cadastroRealizado.php";
    } else {
        include_once "../View/cadastroNaoRealizado.php";
    }
}

// --- Atualizar ---
elseif (isset($_POST["btnAtualizar"])) {
    require_once "../Controller/UsuarioController.php";
    $uController = new UsuarioController();
    if ($uController->atualizar(
        $_POST["txtID"],
        $_POST["txtNome"],
        $_POST["txtCpf"],
        $_POST["txtEmail"],
        $_POST["txtEndereco"],
        date("Y-m-d", strtotime($_POST["txtData"]))
    )) {
        include_once "../View/atualizacaoRealizada.php";
    } else {
        include_once "../View/operacaoNaoRealizada.php";
    }
}

// Verifica se o botão "Buscar Endereço" foi acionado no formulário
if (isset($_POST["btnBuscarEndereco"])) {
    // Remove todos os caracteres que não são números do CEP digitado
    $cep = preg_replace('/[^0-9]/', '', $_POST["txtCep"]);
    // Verifica se o CEP possui exatamente 8 dígitos (formato válido no Brasil)
    if (strlen($cep) == 8) {
        // Monta a URL para fazer a requisição na API ViaCEP, no formato XML
        $url = "https://viacep.com.br/ws/$cep/xml/";
        // Faz a requisição HTTP para a URL e obtém a resposta como string XML
        $xmlString = file_get_contents($url);
        // Converte a string XML em um objeto manipulável em PHP
        $xml = simplexml_load_string($xmlString);
        // Verifica se na resposta existe a tag <erro>, o que significa CEP não encontrado
        if (isset($xml->erro) && (string)$xml->erro == 'true') {
            // Define uma mensagem de erro para informar que o CEP não foi encontrado
            $msgErro = "CEP não encontrado.";
            // Limpa o campo de endereço, já que não encontrou
            $_POST["txtEndereco"] = "";
        } else {
            // Se não houver erro, monta o endereço usando as informações do XML
            // Formato: logradouro, bairro, cidade - UF
            $endereco = $xml->logradouro . ", " . $xml->bairro . ", " . $xml->localidade . " - " . $xml->uf;
            // Preenche o campo de endereço no formulário com o endereço montado
            $_POST["txtEndereco"] = $endereco;
        }
    } else {
        // Se o CEP não tiver 8 dígitos, mostra uma mensagem de erro
        $msgErro = "Informe um CEP válido.";
        // Limpa o campo de endereço
        $_POST["txtEndereco"] = "";
    }
    // Inclui o arquivo da página principal (provavelmente para recarregar o formulário com o endereço preenchido ou erro mostrado)
    include_once "../View/principal.php";
}


// --- Adicionar Formação Acadêmica ---
elseif (isset($_POST["btnAddFormacao"])) {
    require_once "../Controller/formacaoAcadController.php";
    include_once "../Model/Usuario.php";
    $fController = new FormacaoAcadController();
    if ($fController->inserir(
        date("Y-m-d", strtotime($_POST["txtInicioFA"])),
        date("Y-m-d", strtotime($_POST["txtFimFA"])),
        $_POST["txtDescFA"],
        unserialize($_SESSION["Usuario"])->getID()
    )) {
        include_once "../View/cadastroRealizado.php";
    } else {
        include_once "../View/cadastroNaoRealizado.php";
    }
}

// --- Excluir Formação Acadêmica ---
elseif (isset($_POST["btnExcluirFA"])) {
    require_once "../Controller/formacaoAcadController.php";
    include_once "../Model/Usuario.php";
    $fController = new FormacaoAcadController();
    if ($fController->remover($_POST["id"])) {
        include_once "../View/informacaoExcluida.php";
    } else {
        include_once "../View/operacaoNaoRealizada.php";
    }
}

// --- Adicionar Experiência Profissional ---
elseif (isset($_POST["btnAddEP"])) {
    require_once "../Controller/experienciaProfController.php";
    include_once "../Model/Usuario.php";
    $eController = new ExperienciaProfController();
    if ($eController->inserir(
        date("Y-m-d", strtotime($_POST["txtInicioEP"])),
        date("Y-m-d", strtotime($_POST["txtFimEP"])),
        $_POST["txtEmpEP"],
        $_POST["txtDescEP"],
        unserialize($_SESSION["Usuario"])->getID()
    )) {
        include_once "../View/cadastroRealizado.php";
    } else {
        include_once "../View/cadastroNaoRealizado.php";
    }
}

// --- Excluir Experiência Profissional ---
elseif (isset($_POST["btnExcluirEP"])) {
    require_once "../Controller/experienciaProfController.php";
    include_once "../Model/Usuario.php";
    $eController = new ExperienciaProfController();
    if ($eController->remover($_POST["id"])) {
        include_once "../View/informacaoExcluida.php";
    } else {
        include_once "../View/operacaoNaoRealizada.php";
    }
}

// --- Adicionar Outras Formações ---
elseif (isset($_POST["btnAddOF"])) {
    require_once "../Controller/outrasFormacoesController.php";
    include_once "../Model/Usuario.php";
    $oController = new OutrasFormacoesController();
    if ($oController->inserir(
        date("Y-m-d", strtotime($_POST["txtInicioOF"])),
        date("Y-m-d", strtotime($_POST["txtFimOF"])),
        $_POST["txtDescOF"],
        unserialize($_SESSION["Usuario"])->getID()
    )) {
        include_once "../View/cadastroRealizado.php";
    } else {
        include_once "../View/cadastroNaoRealizado.php";
    }
}

// --- Excluir Outras Formações ---
elseif (isset($_POST["btnExcluirOF"])) {
    require_once "../Controller/outrasFormacoesController.php";
    include_once "../Model/Usuario.php";
    $oController = new OutrasFormacoesController();
    if ($oController->remover($_POST["id"])) {
        include_once "../View/informacaoExcluida.php";
    } else {
        include_once "../View/operacaoNaoRealizada.php";
    }
}

// --- Redirecionar após cadastro realizado ---
elseif (isset($_POST["btnCadRealizado"])) {
    include_once "../View/principal.php";
}

// --- Redirecionar após cadastro não realizado ---
elseif (isset($_POST["btnCadNaoRealizado"])) {
    include_once "../View/primeiroAcesso.php";
}

// --- Redirecionar após informação inserida ---
elseif (isset($_POST["btnInfInserir"])) {
    include_once "../View/principal.php";
}

// --- Redirecionar após informação excluída ---
elseif (isset($_POST["btnInfExcluir"])) {
    include_once "../View/principal.php";
}

// --- Redirecionar após atualização de cadastro ---
elseif (isset($_POST["btnAtualizacaoCadastro"])) {
    include_once "../View/principal.php";
}

// --- Login como Administrador ---
elseif (isset($_POST["btnADM"])) {
    include_once '../View/ADMLogin.php';
}

// --- Login do Administrador ---
elseif (isset($_POST["btnListarCadastrados"])) {
    require_once "../Controller/AdministradorController.php";
    $aController = new AdministradorController();
    if ($aController->login($_POST["txtLoginADM"], $_POST["txtSenhaADM"])) {
        include_once "../View/ADMListarCadastrados.php";
    } else {
        echo "<script>alert('CPF ou senha incorretos!'); window.location.href='../View/ADMLogin.php';</script>";
    }
}

// --- Voltar (Administrador) ---
elseif (isset($_POST["btnVoltar"])) {
    include_once "../View/ADMListarCadastrados.php";
}

// --- Visualizar Cadastro de Usuário (Administrador) ---
elseif (isset($_POST["btnUserInfo"])) {
    include_once "../View/ADMVisualizarCadastro.php";
}

// --- Buscar (Usuario) ---
elseif (isset($_POST["btnBuscar"])) {
    include_once "../View/principal.php";
}

?>

