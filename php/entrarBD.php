<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') { //Verifico se houve um submit com método POST

    include("conexao.php");

    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $consulta = "SELECT * FROM usuario WHERE email = '$email' and senha = '$senha'";
    $resultado = $mysqli->query($consulta); //Faço a consulta no Banco de Dados

    if ($mysqli->connect_error) { //Verifico se a conexão com o banco ocorreu bem
        die("Erro na conexão: " . $mysqli->connect_error);
    }

    if ($resultado->num_rows == 1) { //Se na consulta ele encontrou uma informação, ele retorna TRUE
        $linha = $resultado->fetch_assoc();
        /*O fetch_assoc é um método que é usado para recuperar uma linha de resultados de uma consulta MySQLi e converter ele em uma array associativo
        Para ficar mais fácil o entendimento, a variável $linha ficaria assim:
            Array (
                'email' => x,
                'tipo' => 'estabelecimento/cliente',
                )

        */ 
        $_SESSION['usuarioEmail'] = $email; //Eu também posso usar também o $linha ['email'], mas como eu já tenho certeza que dentro dessa condição o $email existe, eu armazeno na direto na variável mesmo
        $_SESSION['usuarioTipo'] = $linha['tipo'];
        header('Location: ../index.php');
    } else {
        $emailError = true;
        header('Location: ../entrar.php?erro=' . urlencode($emailError));
        exit;
    }
}
?>