<?php
include("conexao.php");


$opcao = $_POST["opcao"]; //Armazeno a opção que o usuário escolheu no momento de criar a conta

if ($opcao == "opcao1") { //A opção 1 é o o usuário
    $nome = $_POST['nome'];
    $nascimento = $_POST['nascimento'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $telefone = $_POST['telefone'];
    $tipo = 'cliente';

    $verificarEmail_query = "SELECT * FROM usuario WHERE email = '$email'";
    $resultadoVerificar = $mysqli->query($verificarEmail_query); //Consulta MySQLi

    if ($resultadoVerificar->num_rows > 0) { //Caso ele tenha encontrado alguma informação, ele retorna TRUE
        $emailError = true;
        header('Location: ../cria_conta.php?erro=' . urlencode($emailError));
        /*Insiro a variável na URL e envio o usuário novamente para a pagina de alterar dados. Lá vai ser tratado essa variável através do GET*/
        exit;
    } else {

        /*No código abaixo, eu estou inserindo os dados no Banco e verificando se tudo correu bem*/

        $sql_usuario = "INSERT INTO usuario (email, tipo, senha) VALUES ('$email', '$tipo', '$senha')";
        $sql_cliente = "INSERT INTO cliente (nome, nascimento, email, telefone) VALUES ('$nome', '$nascimento', '$email', '$telefone')";


        $resultado_usuario = $mysqli->query($sql_usuario);
        $resultado_cliente = $mysqli->query($sql_cliente);


        if (!$resultado_usuario || !$resultado_cliente) {

            echo "Erro na inserção: " . $mysqli->error;
        } else {
            header('Location: ../cadastro_realizado.html');
        }
    }
} else {

    //Basicamente o mesmo código anterior, porém para o tipo ESTABELECIMENTO

    $nome = $_POST['nome'];
    $endereco = $_POST['endereco'];
    $complemento = $_POST['complemento'];
    $cep = $_POST['cep'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $telefone = $_POST['telefone'];
    $tipo = 'estabelecimento';

    $checar_email_query = "SELECT * FROM usuario WHERE email = '$email'";
    $resultadoChecar_email = $mysqli->query($checar_email_query);

    if ($resultadoChecar_email->num_rows > 0) {
        $emailError = true;
        header('Location: ../criar_contaDB.php?erro=' . urlencode($emailError));
        exit;
    } else {
        $sql_usuario = "INSERT INTO usuario (email, tipo, senha) VALUES ('$email', '$tipo', '$senha')";
        $sql_estabelecimento = "INSERT INTO estabelecimento (nome, endereço, complemento, cep, cidade, estado, email, telefone) VALUES ('$nome', '$endereco', '$complemento', '$cep', '$cidade', '$estado', '$email','$telefone')";

        $resultado_usuario = $mysqli->query($sql_usuario);
        $resultado_estabelecimento = $mysqli->query($sql_estabelecimento);

        if (!$resultado_usuario || !$resultado_estabelecimento) {
            echo "Erro na inserção: " . $mysqli->error;
        } else {
            header('Location: ../cadastro_realizado.html');
        }
    }
}



$mysqli->close();
die;
?>