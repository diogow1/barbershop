<?php

session_start();


?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>index</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/style.css">

</head>

<body>
    <header>
        <!-- As classes navbar e navbar-expand são necessárias para a responsividade e possuem estilos 
    já definidos pelo bootstrap. A classe shadow-sm também é do bootstrap e define uma pequena sombra na navbar. -->
        <nav class="navbar navbar-expand-lg sticky-top shadow-sm">

            <!--Container é uma classe do bootstrap que define estilos para uma pequena caixa de conteúdo-->
            <div class="container">

                <!--navbar-brand é uma subclasse do navbar do bootstrap que identifica o elemento como sendo a logo da página .
        Classes como fa-solid e fa-shop são apenas para modificar o texto, serão removidas quando adicionarmos a imagem da logo.-->
                <a class="navbar-brand" href="index.php"><img id="imgLogo" class="img-thumbnail" src="images/barber.png" class="img-thumbnail" alt="..." width="50" height="60"></a>

                <!--Navbar-toggle também uma subclasse do navbar e modifica estilos do menu do site em telas menores, no caso aqui adicionando um botão.-->
                <button class="navbar-toggler custom-logo" id="buttonMenuMobile" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="gg-menu"></span>
                </button>

                <!--Já havia comentado essa estrutura no pdf que deixei com o código, mas basicamente são classes e subclasses que aplicam estilos já pré-definidos
        do bootstrap.
  
        nav-link pode ou não ter a classe mãe nav-item que, por sua vez, define estilos obrigatórios para a nav-link.
  
        Da mesma maneira que nav-item tem como classe mãe a navbar-nav, que é um tipo de navbar com estilos já pré-definidos pelo bootstrap.
          
      -->
                <div class=" collapse navbar-collapse" id="navbarNavDropdown" style='justify-content: flex-end;'>
                    <?php
                    /*
                    Ok vamo lá. Essa parte pode ficar meio confusa por conta dos código HTML dentro do PHP, tentei ao máximo deixar legível.
                    */

                    if (isset($_SESSION['usuarioEmail'])) { // Verifico se há algum usuário em sessão, se sim ele exibe as opções conforme o tipo de usuário
                        $email = $_SESSION["usuarioEmail"];
                        $tipo = $_SESSION['usuarioTipo'];
                        echo '<nav class="navbar navbar-expand-lg navbar-light bg-transparent" style ="padding: 0px; display: flex;" >
                                <div class="container-fluid">
                                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                                        <span class="navbar-toggler-icon"></span>
                                    </button>
                                    <div class="collapse navbar-collapse" id="navbarNavDropdown">
                                        <ul class="navbar-nav ms-auto">
                                            <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">', $email, '</a>
                                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">';
                        if ($tipo == 'estabelecimento') {
                            echo '<li><a class="dropdown-item" href="barbearia.php">Barbearia</a></li>';
                        } elseif ($tipo == 'cliente') {
                            echo '<li><a class="dropdown-item" href="cliente.php">Cliente</a></li>';
                        }
                        echo '<li><a class="dropdown-item" href="#">Agendamentos</a></li>
                                                <li><hr class="dropdown-divider"></li>
                                                <li><a class="dropdown-item" href="php/fimSessao.php">Sair</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </nav>';
                    } else {  //Caso não haja sessão, ele exibe apenas o login e cadastrar
                        echo '<ul class="navbar-nav  ms-auto custom-ul"></ul>
                            <ul class="navbar-nav ms-auto custom-login">
                                <li class="nav-item">
                                    <a class="nav-link mx-2 text-uppercase text-white" href="entrar.php"><i class="fa-solid fa-cart-shopping"></i>Entrar</a>
                                </li>
                                <li class="nav-item custom-register ms-2 ">
                                    <a class="nav-link mx-2 text-uppercase text-white" href="cria_conta.php"><i class="fa-solid fa-circle-user"></i>Criar conta</a>
                                </li>
                            </ul>';
                    } ?>
                </div>
            </div>
        </nav>
    </header>


    <section>
        <form action="index.php" method="POST">
            <div class="col-lg-12 card-margin">
                <div class="card search-form ">
                    <form id="search-form">
                        <div class="custom-filtro">
                            <div class="col-lg-2 custom-estado">
                                <select class="form-control" name="estado" id="uf">
                                    <option>Estado</option>
                                </select>
                            </div>
                            <div class="col-lg-3 custom-cidade">
                                <select class="form-control" name="cidade" id="cid">
                                    <option>Cidade</option>
                                </select>
                            </div>
                            <div class="col-lg-5 custom-pesquisa">
                                <input type="text" placeholder="Procurar por nome" class="form-control" id="procurar" name="procurar">
                            </div>
                            <div class="col-lg-1 custom-botao">
                                <button type="submit" class="btn btn-base">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search">
                                        <circle cx="11" cy="11" r="8"></circle>
                                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="pt-5" id="resultadosPesquisa">
            <?php
            include("php/conexao.php");

            if ($_SERVER["REQUEST_METHOD"] == "POST") { //Verifico se houve request (Caso o usuário tenha clicado em procurar)


                /*O código a seguir utiliza um operador ternário para verificar se o valor de $_POST["procurar"] está definido. 
                Se estiver definido, o valor é atribuído à variável $barbearia após passar pelo método real_escape_string() do  MySQLi.
                Esse método tem como objetivo prevenir ataques de injeção de SQL, eu usei ele com o intuito de que nada ocorra caso o usuário clica em pesquisar
                sem ter selecionado nada (não conheço muito sobre esse método).
                */
                $pesquisa = isset($_POST["procurar"]) ? $mysqli->real_escape_string($_POST["procurar"]) : "";
                $cidade = isset($_POST['cidade']) ? $mysqli->real_escape_string($_POST['cidade']) : "";
                $estado = isset($_POST['estado']) ? $mysqli->real_escape_string($_POST['estado']) : "";


                //Verifico se o usuário digitou algo na pesquisa, mas e selecionou a cidade ou estado
                if (!empty($pesquisa) and ($cidade != 'Cidade' or $estado != 'Estado')) {

                    //Caso ele tenha selecionado apenas o estado, ele realiza a consulta com base no estado e o nome da barbearia
                    /*É provável que eu não consiga colocar a API do IBGE para mostrar as cidades quando o usuário selecionar o estado
                    Por enquanto (ou talvez pra sempre) se o usuário selecionar apenas a cidade e tente pesquisar, nada vai acontecer. */
                    if ($estado != 'Estado' and $cidade == 'Cidade') {
                        $consulta = "SELECT * FROM estabelecimento WHERE estado = '$estado' AND  nome LIKE '%$pesquisa%'";
                        $resultado = $mysqli->query($consulta);
                        mostrarPesquisa($resultado);             
                    } elseif ($estado != 'Estado' and $cidade != 'Cidade') {//Se ele selecionar a cidade, estado e pesquisar por algo, a consulta é baseada nas 3 informações
                        $consulta = "SELECT * FROM estabelecimento WHERE cidade = '$cidade' AND estado = '$estado' AND nome LIKE '%$pesquisa%'";
                        $resultado = $mysqli->query($consulta);
                        mostrarPesquisa($resultado);
                    }
                } elseif (empty($pesquisa) and ($cidade != 'Cidade' or $estado != 'Estado')) {
                    /*Aqui é caso o usuário pesquise apenas por cidade ou estado*/
                    if ($estado != 'Estado' and $cidade == 'Cidade') {//Verfica se sele selecionou só o estado e faz a consulta
                        $consulta = "SELECT * FROM estabelecimento WHERE estado = '$estado'";
                        $resultado = $mysqli->query($consulta);
                        mostrarPesquisa($resultado);
                    } elseif ($estado != 'Estado' and $cidade != 'Cidade') {//Verifica se ele selecionou os 2 e faz a consulta com base nos dois
                        $consulta = "SELECT * FROM estabelecimento WHERE cidade = '$cidade' AND estado = '$estado'";
                        $resultado = $mysqli->query($consulta);
                        mostrarPesquisa($resultado);
                    }
                    //Aqui é caso o usuário não tenha selecionado nenhuma localidade e apenas fez a pesquisa.
                } elseif (!empty($pesquisa) and $cidade == 'Cidade' and $estado == 'Estado') {
                    $consulta = "SELECT * FROM estabelecimento WHERE nome LIKE '%$pesquisa%'";
                    $resultado = $mysqli->query($consulta);
                    mostrarPesquisa($resultado);
                }
            }



            ///*Essa função tem como objetivo verificar se na consulta foi encontrado alguma barbearia.

            function mostrarPesquisa($resultado)
            {
                
                //O num_rows é uma função do php que retorna o número de linhas da consulta
                if ($resultado->num_rows > 0) {

                    /* ok, vamo la ... o método $resultado->fetch_assoc() é utilizado para obter a próxima linha do conjunto de resultados da consulta.
                    A função fetch_assoc() retorna uma matriz associativa que representa os dados da linha.
                    Em uma matriz associativa, as chaves são os nomes das colunas no banco de dados e os valores
                    são os dados dessas colunas.
                    O while continua executando enquanto ainda houverem linhas no conjunto de resultados e a cada loop do while, 
                    uma linha é recuperada utilizando fetch_assoc() e os dados são armazenados na variável $barbearia.
                    

                    é complicado de entender mesmo, mas acho que olhando visualmente fica mais claro


                    
                    */
                    while ($barbearia = $resultado->fetch_assoc()) {
                        echo '
                        <div class="container mt-5">
                            <div class="card">
                                <div class="card-body d-flex align-items-start p-1">
                                    <img src="images/3.jpg" class="mr-3" id="imagem-card" alt="Imagem do Card" style="max-width: 200px; max-height: 200px; margin-top:15px;">
                                    <div class="card-body">
                                        <h4 class="card-title">', $barbearia['nome'], '</h4>
                                        <p class="card-text mb-1"><span>Endereço: </span>', $barbearia['endereço'], ' (', $barbearia['complemento'], ') - ', $barbearia['cidade'], ', ', strtoupper($barbearia['estado']), ' | ', $barbearia['cep'], '</p> 
                                        <p class="card-text mb-1"><span>Horario de antedimento: </span> ', $barbearia['horarioAtendimento'], '</p>
                                        <p class="card-text mb-1"><span>Telefone: </span>', $barbearia['telefone'], '</p>
                                        <p class="card-text mb-3"><span>Serviços: </span>', $barbearia['serviços'], '</p>
                                        <a href="php/agendar.php?id_barber=', $barbearia['id_barber'], '" class="btn btn-primary">Agendar</a>
                                    </div>
                                </div>
                            </div>
                        </div>';
                    }
                    echo "</ul>";
                } else {
                    echo '<div>
                            <h1 id="titulo">Nenhum resultado encontrado :(</h1>
                        ';
                }
            }

            ?>

            </div>
        </form>
    </section>


    <footer class=" text-light">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5>Contato</h5>
                    <p>Endereço: </p>
                    <p>Email: contato@exemplo.com</p>
                    <p>Telefone: </p>
                </div>
                <div class="col-md-6">
                    <h5>Redes Sociais</h5>
                    <ul class="list-unstyled">
                        <li><a href="#">Facebook</a></li>
                        <li><a href="#">Twitter</a></li>
                        <li><a href="#">Instagram</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
</body>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/ibgeAPI.js"></script>


</html>