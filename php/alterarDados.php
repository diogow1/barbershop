<?php

session_start();//Inicio a sessão

if (isset($_SESSION['usuarioEmail'])) { //Verifico se a variável 'usuarioEmail' existe e é diferente de nulo com o método isset

    include("conexao.php");
    $opcao = $_SESSION["usuarioTipo"]; //Armazeno a opção que identifica qual é o tipo do usuário (estabelecimento/cliente)

    if ($opcao == "estabelecimento") { //Caso for estabelecimento, eu armazeno todas as informações do formulário através do POST
        $nome = $_POST['nome'];
        $endereco = $_POST['endereco'];
        $complemento = $_POST['complemento'];
        $cep = $_POST['cep'];
        $cidade = $_POST['cidade'];
        $estado = $_POST['estado'];
        $novoEmail = $_POST['email'];
        $novaSenha = $_POST['senha'];
        $telefone = $_POST['telefone'];
        $horarioAtendimento = $_POST['horarioAtendimento'];
        $servicos = $_POST['servicos'];

        $emailAtual = $_SESSION['usuarioEmail']; //Armazeno o email atual do usuário através da sessão para manipular ele caso o usuário escolha mudar o mesmo

        $verificarEmail_query = "SELECT * FROM usuario WHERE email = '$emailAtual'";
        $resultadoVerificar = $mysqli->query($verificarEmail_query);

        if ($resultadoVerificar->num_rows == 0) {  //Caso ele não encontre nenhuma informação, é possível que o usuário fez o submit sem estar logado (Tratamento de erro)
            echo "Não é possível acessar essa página sem estar logado!";
        } else { //Faço o update das informações que o usuário preencheu
            $sql_estabelecimento = "UPDATE estabelecimento SET nome='$nome', endereço='$endereco', complemento='$complemento', cep='$cep', cidade='$cidade', estado='$estado', horarioAtendimento='$horarioAtendimento', serviços='$servicos', telefone='$telefone' WHERE email='$emailAtual'";
            $resultado_estabelecimento = $mysqli->query($sql_estabelecimento);

            /*Como TODAS as informações do usuário estão presentes no formulário (exceto a senha e o email por questões de segurança)
            Eu preciso verificar se esses campos estão vazios para só então fazer o update no MySQLi
            */
            if (!empty($novaSenha)) { 
                $sql_usuario = "UPDATE usuario SET senha='$novaSenha' WHERE email = '$emailAtual'";
                $resultado_usuario = $mysqli->query($sql_usuario);
                if (!$resultado_usuario) {
                    echo "Erro na inserção: " . $mysqli->error;
                } else {
                    header('Location: ../dados_atualizados.html');
                }
            }

            if (!empty($novoEmail)) {
                $verificarEmailNovo_query = "SELECT * FROM usuario WHERE email = '$novoEmail'";
                $resultadoVerificarNovo = $mysqli->query($verificarEmailNovo_query);

                if ($resultadoVerificarNovo->num_rows == 0) {
                    $sql_usuario = "UPDATE usuario SET email='$novoEmail' WHERE email = '$emailAtual'";
                    $resultado_usuario = $mysqli->query($sql_usuario);
                    if (!$resultado_usuario) {
                        echo "Erro na inserção: " . $mysqli->error;
                    } else {
                        session_destroy();
                        header('Location: ../dados_atualizados.html');
                    }
                } else {
                    $emailError = true;
                    header('Location: ../barbearia.php?erro=' . urlencode($emailError)); 
                    /*Insiro a variável na URL e envio o usuário novamente para a pagina de alterar dados. Lá vai ser tratado essa variável através do GET*/
                    exit;
                }
            }

            //Caso ele não mudou o email nem a senha, aqui ele só verifica se os dados restante foram inseridos corretamente
            if (!$resultado_estabelecimento) {
                echo "Erro na inserção: " . $mysqli->error;
            } else {
                header('Location: ../dados_atualizados.html');
            }
        }

        /*
            A ideia do código abaixo era para a barbearia conseguir alterar a foto (não sei se vou conseguir implementar a tempo)
        */
        if (isset($_FILES['foto'])) {
            $foto = $_FILES['foto'];
        }

    } else {
        /*Basicamente aqui é o mesmo código de antes, porém para alterar os dados do CLIENTE*/

        $nome = $_POST['nome'];
        $novoEmail = $_POST['email'];
        $novaSenha = $_POST['senha'];
        $telefone = $_POST['telefone'];
        $nascimento = $_POST['nascimento'];

        $emailAtual = $_SESSION['usuarioEmail'];

        $verificarEmail_query = "SELECT * FROM usuario WHERE email = '$emailAtual'";
        $resultadoVerificar = $mysqli->query($verificarEmail_query);

        if ($resultadoVerificar->num_rows == 0) {
            echo "Não é possível acessar essa página sem estar logado!";
        } else {
            $sql_cliente = "UPDATE cliente SET nome='$nome', nascimento='$nascimento', telefone='$telefone' WHERE email='$emailAtual'";
            $resultado_cliente = $mysqli->query($sql_cliente);

            if (!empty($novaSenha)) {
                $sql_usuario = "UPDATE usuario SET senha='$novaSenha' WHERE email = '$emailAtual'";
                $resultado_usuario = $mysqli->query($sql_usuario);
                if (!$resultado_usuario) {
                    echo "Erro na inserção: " . $mysqli->error;
                } else {
                    header('Location: ../dados_atualizados.html');
                }
            }

            if (!empty($novoEmail)) {
                $verificarEmailNovo_query = "SELECT * FROM usuario WHERE email = '$novoEmail'";
                $resultadoVerificarNovo = $mysqli->query($verificarEmailNovo_query);

                if ($resultadoVerificarNovo->num_rows == 0) {
                    $sql_usuario = "UPDATE usuario SET email='$novoEmail' WHERE email = '$emailAtual'";
                    $resultado_usuario = $mysqli->query($sql_usuario);
                    if (!$resultado_usuario) {
                        echo "Erro na inserção: " . $mysqli->error;
                    } else {
                        session_destroy();
                        header('Location: ../dados_atualizados.html');
                    }
                } else {
                    $emailError = true;
                    header('Location: ../cliente.php?erro=' . urlencode($emailError));
                    exit;
                }
            }

            if (!$resultado_cliente) {
                echo "Erro na inserção: " . $mysqli->error;
            } else {
                header('Location: ../dados_atualizados.html');
            }
        }
    }
    $mysqli->close();
    die;
} else {
    header('Location: ../entrar.html');
    die;
}
?>