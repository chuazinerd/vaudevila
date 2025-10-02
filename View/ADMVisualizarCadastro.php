<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>+ info</title>
</head>

<body>
    <?php
    include_once '../Model/Usuario.php';
    include_once '../Controller/UsuarioController.php';
    $cpf = $_POST['btnUserInfo'];
    $usuario = new Usuario();
    $usuario->carregarUsuario($cpf);
    ?>

    <header class="w3-container w3-padding-32 w3-center ">
        <h1 class="w3-text-white w3-panel w3-cyan w3-round-large">
            <?= $usuario->getNome(); ?> Curriculo
        </h1>
    </header>

    <div class="w3-padding-128 w3-content w3-text-grey">
        <div class="w3-container">
            <h2 class="w3-text-white w3-panel w3-cyan w3-round-large">
                NOME: <?= $usuario->getNome(); ?>
            </h2>
            <h2 class="w3-text-white w3-panel w3-cyan w3-round-large">
                CPF: <?= $usuario->getCpf(); ?>
            </h2>
            <h2 class="w3-text-white w3-panel w3-cyan w3-round-large">
                EMAIL: <?= $usuario->getEmail(); ?>
            </h2>
            <h2 class="w3-text-white w3-panel w3-cyan w3-round-large">
                DATA DE NASCIMENTO: <?= $usuario->getDataNascimento(); ?>
            </h2>
        </div>
    </div>

    <!--Formação academica  -->

    <header class="w3-container  w3-center ">
        <h1 class="w3-text-cyan" style="margin-left: 20%; margin-right: 20%;">
            Fomação Academica
        </h1>
    </header>

    <div class="w3-padding-128 w3-content w3-text-grey">
        <div class="w3-container">
            <table class="w3-table-all w3-centered">
                <thead>
                    <tr class="w3-center w3-blue">
                        <th>Início</th>
                        <th>Fim</th>
                        <th>Descrição</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    include_once '../Model/FormacaoAcad.php';

                    $formacao = new FormacaoAcad();
                    $prendado = $formacao->listaFormacoes($usuario->getId());
                    if ($prendado != null) {
                        while ($row = $prendado->fetch_object()) {
                            echo '<tr>';
                            echo '<td style="width: 25%;">' . $row->inicio . '</td>';
                            echo '<td style="width: 25%;">' . $row->fim . '</td>';
                            echo '<td style="width: 25%;">' . $row->descricao . '</td>';
                            echo '</tr>';
                        }
                    } else {
                        echo "Nenhum usuario encontrado";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Xp Profissional  -->

    <header class="w3-container  w3-center ">
        <h1 class="w3-text-cyan" style="margin-left: 20%; margin-right: 20%;">
            Experiência Profissional
        </h1>
    </header>

    <div class="w3-padding-128 w3-content w3-text-grey">
        <div class="w3-container">
            <table class="w3-table-all w3-centered">
                <thead>
                    <tr class="w3-center w3-blue">
                        <th>Início</th>
                        <th>Fim</th>
                        <th>Empresa</th>
                        <th>Descrição</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include_once '../Model/ExperienciaProf.php';

                    $experienciaProf = new ExperienciaProf();
                    $prendado = $experienciaProf->listaExperiencias($usuario->getId());
                    if ($prendado != null) {
                        while ($row = $prendado->fetch_object()) {
                            echo '<tr>';
                            echo '<td style="width: 25%;">' . $row->inicio . '</td>';
                            echo '<td style="width: 25%;">' . $row->fim . '</td>';
                            echo '<td style="width: 25%;">' . $row->empresa . '</td>';
                            echo '<td style="width: 25%;">' . $row->descricao . '</td>';
                            echo '</tr>';
                        }
                    } else {
                        echo "Nenhuma experiência encontrada";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>


    <!-- Div botão voltar -->

    <div class="w3-padding-128 w3-content w3-text-grey">
        <form action="../Controller/navegacao.php" method="post" class="w3-container w3-light-grey w3-text-blue w3-margin w3-center" style="width: 30%;">
            <div class="w3-row w3-section">
                <div>
                    <button name="btnVoltar" class="w3-button w3-block w3-margin w3-blue w3-cell w3-round-large" style="width: 30%;">
                        Voltar
                    </button>
                </div>
            </div>
        </form>
    </div>

</body>

</html>