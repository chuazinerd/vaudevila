<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <title>Enlatados Juarez</title>
    <style>
        /* Definimos que a sidebar terá uma largura de 120px e cor a cord de fundo #222 */
        .w3-sidebar {
            width: 120px;
        }

        /*Define Fonte para todas as tagslistadas abaixo*/
        body,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: "Montserrat", sans-serif
        }
    </style>
</head>

<body class="w3-white">

    <?php
    include_once '../Controller/FormacaoAcadController.php';
    include_once '../Controller/experienciaProfController.php';
    include_once '../Controller/outrasFormacoesController.php';
    include_once '../Model/Usuario.php';

    if (!isset($_SESSION)) {
        session_start();
    }
    ?>

    <nav class="w3-sidebar w3-bar-block w3-center w3-blue">
        <br>
        <a href="#home" class="w3-bar-item w3-button w3-block n w3-cell w3-hover-light-grey w3-hover-text-cyan w3-textlight-grey">
            <i class="fa fa-home w3-xxlarge"></i>
            <p>Início</p>
        </a>
        <a href="#dPessoais" class="w3-bar-item w3-button w3-block n w3-cell w3-hover-light-grey w3-hover-textcyan w3-text-light-grey">
            <i class="fa fa-address-book fa-2x"></i>
            <p>Dados Pessoais</p>
        </a>
        <a href="#formacao" class="w3-bar-item w3-button w3-block n w3-cell w3-hover-light-grey w3-hover-textcyan w3-text-light-grey">
            <i class="fa fa-mortar-board w3-xxlarge"></i>
            <p>Formação</p>
        </a>
        <a href="#experiencia" class="w3-bar-item w3-button w3-block n w3-cell w3-hover-light-grey w3-hover-textcyan w3-text-light-grey">
            <i class="fa fa-address-card w3-xxlarge"></i>
            <p>Experiência</p>
        </a>
        <a href="#outrasforms" class="w3-bar-item w3-button w3-block n w3-cell w3-hover-light-grey w3-hover-textcyan w3-text-light-grey">
            <i class="fa fa-id-card w3-xxlarge"></i>
            <p>Outras Formações</p>
        </a>
    </nav>

    <div class="w3-padding-large" id="main">
        <header class="w3-container w3-padding-32 w3-center " id="home">
            <h1>
                <img src="./Img/latas.jpg" alt="Logo" class="w3-image" width="20%">
                </br>
            </h1>
            <a class="w3-text-cyan" href="http://www.freepik.com">Designed by brgfx & Jvzin / Freepik</a>
            <br>
            <h1 class="w3-text-cyan">SISTEMA DE CURRICULOS</h1>
        </header>
    </div>

    <!-- Formulário 1 -->
    <div class="w3-padding-128 w3-content w3-text-grey" style="width: 700px;">
        <h2 class="w3-text-cyan" id="dPessoais">Dados Pessoais</h2>

        <form action="../Controller/Navegacao.php" method="post" class="w3-light-grey w3-text-blue w3-margin" style="width: 700px; padding: 20px; border-radius: 10px;">
            <input class="w3-input w3-border w3-round-large" name="txtID" type="hidden" value="<?php echo unserialize($_SESSION['Usuario'])->getId(); ?>">
            <div class="w3-row w3-section">
                <div class="w3-row w3-margin-bottom">
                    <i class="w3-xxlarge fa fa-user w3-col" style="width: 15%;"></i>
                    <input class="w3-input w3-border w3-round-large w3-col" style="width: 85%;" name="txtNome" type="text" placeholder="Nome Completo" value="<?php echo unserialize($_SESSION['Usuario'])->getNome(); ?>">
                </div>
                <div class="w3-row w3-margin-bottom">
                    <i class="w3-xxlarge fa fa-calendar w3-col" style="width: 15%;"></i>
                    <input class="w3-input w3-border w3-round-large w3-col" style="width: 85%;" name="txtData" type="date" placeholder="dd/mm/aaaa" value="<?php echo unserialize($_SESSION['Usuario'])->getDataNascimento(); ?>">
                </div>

                <div class="w3-row w3-margin-bottom">
                    <i class="w3-xxlarge fa fa-address-card w3-col" style="width: 15%;"></i>
                    <input class="w3-input w3-border w3-round-large w3-col" style="width: 85%;" name="txtCpf" type="number" placeholder="Documento" value="<?php echo unserialize($_SESSION['Usuario'])->getCpf(); ?>">

                </div>
                <!--Campo do email -->
                <div class="w3-row w3-margin-bottom">
                    <i class="w3-xxlarge fa fa-envelope w3-col" style="width: 15%;"></i>
                    <input class="w3-input w3-border w3-round-large w3-col" style="width: 85%;" name="txtEmail" type="text" placeholder="Email" value="<?php echo unserialize($_SESSION['Usuario'])->getEmail(); ?>">
                </div>

                <!--Campo do endereco e cep -->
                <!-- Campo CEP -->
                <div class="w3-row w3-margin-bottom">
                    <i class="w3-xxlarge fa fa-map-marker-alt w3-col" style="width: 15%;"></i>
                    <input class="w3-input w3-border w3-round-large w3-col" style="width: 60%;" name="txtCep" type="text" placeholder="CEP" value="<?php echo isset($_POST['txtCep']) ? $_POST['txtCep'] : ''; ?>">
                    <button type="submit" name="btnBuscarEndereco" class="w3-button w3-blue w3-round-large" style="width: 22%;">Buscar Endereço</button>
                </div>
                <!-- Campo Endereço -->
                <div class="w3-row w3-margin-bottom">
                    <i class="w3-xxlarge fa fa-home w3-col" style="width: 15%;"></i>
                    <input class="w3-input w3-border w3-round-large w3-col" style="width: 85%;" name="txtEndereco" type="text" placeholder="Endereço" value="<?php echo isset($_POST['txtEndereco']) ? $_POST['txtEndereco'] : unserialize($_SESSION['Usuario'])->getEndereco(); ?>">
                </div>



                <button name="btnAtualizar" class="w3-button w3-blue w3-round-large w3-block" style="margin-top: 10px;">Atualizar</button>
            </div>
        </form>
    </div>

    <!-- Formação -->
    <div class="w3-padding-128 w3-content w3-text-grey" id="formacao">
        <h2 class="w3-text-cyan">Formação</h2>
        <form action="../Controller/Navegacao.php" method="post" class="w3-round-large w3-row w3-light-grey w3-text-blue w3-margin w3-padding-large ">
            <div class="w3-row w3-center">
                <div class="w3-col" style="width:50%;">
                    Data Inicial
                </div>
                <div class="w3-rest">
                    Data Final
                </div>
            </div>
            <div class="w3-row w3-section">
                <div class="w3-row w3-section w3-col" style="width:45%;">
                    <div class="w3-col" style="width:15%;">
                        <i class="w3-xxlarge fa fa-calendar"></i>
                    </div>
                    <div class="w3-rest">
                        <input class="w3-input w3-border w3-round-large" name="txtInicioFA" type="date" placeholder="">
                    </div>
                </div>
                <div class="w3-row w3-section w3-rest">
                    <div class="w3-col w3-margin-left" style="width:13%;">
                        <i class="w3-xxlarge fa fa-calendar"></i>
                    </div>
                    <div class="w3-rest">
                        <input class="w3-input w3-border w3-round-large" name="txtFimFA" type="date" placeholder="">
                    </div>
                </div>
                <div>
                    <div class="w3-row w3-section">
                        <div class="w3-col" style="width:7%;">
                            <i class="w3-xxlarge fa fa-align-justify"></i>
                        </div>
                        <div class="w3-rest">
                            <input class="w3-input w3-border w3-round-large" name="txtDescFA" type="text"
                                placeholder="Descrição: Ex.: Técnico em Desenvolvimento de Sistemas - Centro Paula Souza">
                        </div>
                    </div>
                    <div class="w3-row w3-section">
                        <div class="w3-center">
                            <button name="btnAddFormacao" class="w3-button w3-block w3-blue w3-cell w3-round-large" style="width: 20%;">
                                <i class="w3-xxlarge fa fa-user-plus"></i>
                            </button>
                        </div>
                    </div>
        </form>

        <div class="w3-container">
            <table class="w3-table-all w3-centered">
                <thead>
                    <tr class="w3-center w3-blue">
                        <th>Início</th>
                        <th>Fim</th>
                        <th>Descrição</th>
                        <th>Apagar</th>
                    </tr>
                    <thead>
                        <thead>
                            <?php
                            $fCon = new FormacaoAcadController();
                            $results = $fCon->gerarLista(unserialize($_SESSION['Usuario'])->getId());
                            if ($results != null)
                                while ($row = $results->fetch_object()) {
                                    echo '<tr>';
                                    echo '<td style="width: 10%;">' . $row->inicio . '</td>';
                                    echo '<td style="width: 10%;">' . $row->fim . '</td>';
                                    echo '<td style="width: 65%;">' . $row->descricao . '</td>';
                                    echo '<td style="width: 5%;">
                                    <form action="../Controller/Navegacao.php" method="post">
                                     <input type="hidden" name="id" value="' . $row->idformacaoAcademica . '">
                                        <button name="btnExcluirFA" class="w3-button w3-block w3-blue
                                        w3-cell w3-round-large"><i class="fa fa-user-times"></i> </button></td>
                                     </input>
                                    </form>';
                                    echo '</tr>';
                                }
                            ?>
                        </thead>
                    </thead>
            </table>
        </div>
    </div>
    </div>

    <!-- Experiência Profissional -->
    <div class="w3-padding-128 w3-content w3-text-grey" id="experiencia">
        <h2 class="w3-text-cyan">Experiência Profissional</h2>
        <form action="" method="post" class="w3-round-large w3-row w3-light-grey w3-text-blue w3-margin w3-padding-large">
            <div class="w3-row w3-center">
                <div class="w3-col" style="width:50%;">
                    Data Inicial
                </div>
                <div class="w3-rest">
                    Data Final
                </div>
            </div>
            <div class="w3-row w3-section">
                <div class="w3-row w3-section w3-col" style="width:45%;">
                    <div class="w3-col" style="width:15%;">
                        <i class="w3-xxlarge fa fa-calendar"></i>
                    </div>
                    <div class="w3-rest">
                        <input class="w3-input w3-border w3-round-large" name="txtInicioEP" type="date" placeholder="">
                    </div>
                </div>
                <div class="w3-row w3-section w3-rest">
                    <div class="w3-col w3-margin-left" style="width:13%;">
                        <i class="w3-xxlarge fa fa-calendar"></i>
                    </div>
                    <div class="w3-rest">
                        <input class="w3-input w3-border w3-round-large" name="txtFimEP" type="date" placeholder="">
                    </div>
                </div>
                <div>

                    <div class="w3-row w3-section">
                        <div class="w3-col" style="width:7%;">
                            <i class="w3-xxlarge fa fa-align-justify"></i>
                        </div>
                        <div class="w3-rest">
                            <input class="w3-input w3-border w3-round-large" name="txtEmpEP" type="text"
                                placeholder="Empresa: Ex.:  Centro Paula Souza">
                        </div>
                    </div>

                    <div class="w3-row w3-section">
                        <div class="w3-col" style="width:7%;">
                            <i class="w3-xxlarge fa fa-align-justify"></i>
                        </div>
                        <div class="w3-rest">
                            <input class="w3-input w3-border w3-round-large" name="txtDescEP" type="text"
                                placeholder="Descrição: Ex.: Técnico em Desenvolvimento de Sistemas">
                        </div>
                    </div>

                    <div class="w3-row w3-section">
                        <div class="w3-center">
                            <button name="btnAddEP" class="w3-button w3-block w3-blue w3-cell w3-round-large" style="width: 20%;">
                                <i class="w3-xxlarge fa fa-user-plus"></i>
                            </button>
                        </div>
                    </div>
        </form>

        <div class="w3-container">
            <table class="w3-table-all w3-centered">
                <thead>
                    <tr class="w3-center w3-blue">
                        <th>Início</th>
                        <th>Fim</th>
                        <th>Empresa</th>
                        <th>Descrição</th>
                        <th>Apagar</th>
                    </tr>
                    <thead>
                        <thead>
                            <?php
                            $fCon = new ExperienciaProfController();
                            $results = $fCon->gerarLista(unserialize($_SESSION['Usuario'])->getId());
                            if ($results != null)
                                while ($row = $results->fetch_object()) {
                                    echo '<tr>';
                                    echo '<td style="width: 10%;">' . $row->inicio . '</td>';
                                    echo '<td style="width: 10%;">' . $row->fim . '</td>';
                                    echo '<td style="width: 30%;">' . $row->empresa . '</td>';
                                    echo '<td style="width: 30%;">' . $row->descricao . '</td>';
                                    echo '<td style="width: 5%;">
                                    <form action="../Controller/Navegacao.php" method="post">
                                     <input type="hidden" name="id" value="' . $row->idexperienciaprofissional . '">
                                        <button name="btnExcluirEP" class="w3-button w3-block w3-blue
                                        w3-cell w3-round-large"><i class="fa fa-user-times"></i> </button></td>
                                     </input>
                                    </form>';
                                    echo '</tr>';
                                }
                            ?>
                        </thead>
                    </thead>
            </table>
        </div>
    </div>
    </div>

    <!-- Outras Formações -->
    <div class="w3-padding-128 w3-content w3-text-grey w3" id="outrasforms">
        <h2 class="w3-text-cyan">Outras Formações</h2>
        <form action="" method="post" class="w3-round-large w3-row w3-light-grey w3-text-blue w3-margin w3-padding-large">
            <div class="w3-row w3-center">
                <div class="w3-col" style="width:50%;">
                    Data Inicial
                </div>
                <div class="w3-res">
                    Data Final
                </div>
            </div>
            <div class="w3-row w3-section">
                <div class="w3-row w3-section w3-col" style="width:45%;">
                    <div class="w3-col" style="width:15%;">
                        <i class="w3-xxlarge fa fa-calendar"></i>
                    </div>
                    <div class="w3-rest">
                        <input class="w3-input w3-border w3-round-large" name="txtInicioOF" type="date" placeholder="">
                    </div>
                </div>
                <div class="w3-row w3-section w3-rest">
                    <div class="w3-col w3-margin-left" style="width:13%;">
                        <i class="w3-xxlarge fa fa-calendar"></i>
                    </div>
                    <div class="w3-rest">
                        <input class="w3-input w3-border w3-round-large" name="txtFimOF" type="date" placeholder="">
                    </div>
                </div>
                <div>
                    <div class="w3-row w3-section">
                        <div class="w3-col" style="width:7%;">
                            <i class="w3-xxlarge fa fa-align-justify"></i>
                        </div>
                        <div class="w3-rest">
                            <input class="w3-input w3-border w3-round-large" name="txtDescOF" type="text"
                                placeholder="Ex: Curso de Excel Avançado - Alura">
                        </div>
                    </div>
                    <div class="w3-row w3-section">
                        <div class="w3-center">
                            <button name="btnAddOF" class="w3-button w3-block w3-blue w3-cell w3-round-large" style="width: 20%;">
                                <i class="w3-xxlarge fa fa-user-plus"></i>
                            </button>
                        </div>
                    </div>
        </form>

        <div class="w3-container">
            <table class="w3-table-all w3-centered">
                <thead>
                    <tr class="w3-center w3-blue">
                        <th>Início</th>
                        <th>Fim</th>
                        <th>Descrição</th>
                        <th>Apagar</th>
                    </tr>
                    <thead>
                        <thead>
                            <?php
                            $fCon = new OutrasFormacoesController();
                            $results = $fCon->gerarLista(unserialize($_SESSION['Usuario'])->getId());
                            if ($results != null)
                                while ($row = $results->fetch_object()) {
                                    echo '<tr>';
                                    echo '<td style="width: 10%;">' . $row->inicio . '</td>';
                                    echo '<td style="width: 10%;">' . $row->fim . '</td>';
                                    echo '<td style="width: 65%;">' . $row->descricao . '</td>';
                                    echo '<td style="width: 5%;">
                                    <form action="../Controller/Navegacao.php" method="post">
                                     <input type="hidden" name="id" value="' . $row->idusuario . '">
                                        <button name="btnExcluirOF" class="w3-button w3-block w3-blue
                                        w3-cell w3-round-large"><i class="fa fa-user-times"></i> </button></td>
                                     </input>
                                    </form>';
                                    echo '</tr>';
                                }
                            ?>
                        </thead>
                    </thead>
            </table>
        </div>
    </div>

    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

</body>

</html>