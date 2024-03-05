<?php

    session_start();

    if (isset($_SESSION['usuarioEmail'])) {
        session_destroy();
        header('Location: ../index.php');
        die;
    } else {
        echo "A sessão não está inicializada."; // Aqui é só um tratamento de erro caso por algum motivo o usuário acesse essa página sem estar em sessão.
    }


?>
