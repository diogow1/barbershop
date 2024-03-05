<?php

session_start();



?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entrar</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/barbearia.css">

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
                    if (isset($_SESSION['usuarioEmail'])) { //Verifico se o usuário existe e está logado.
                        include("php/conexao.php");

                        $consultaBarbearia = "SELECT * FROM estabelecimento WHERE email = '{$_SESSION['usuarioEmail']}'";
                        $resultadoBarbearia = $mysqli->query($consultaBarbearia);
                        $dadosBarbearia = $resultadoBarbearia->fetch_assoc(); // Transformo a consulta em um array associativo.


                        //Aqui é um tratamento de erro caso o usuário seja diferente do permitido da página.
                        if ($_SESSION['usuarioTipo'] == 'cliente') {
                            header('Location: cliente.php');
                            die;
                        }

                        
                        $email = $_SESSION["usuarioEmail"]; //Armazeno as informações da sessão em variáveis para ficar mais fácil a manipulação depois.
                        $tipo = $_SESSION['usuarioTipo'];
                        echo '<nav class="navbar navbar-expand-lg navbar-light bg-transparent" style ="padding: 0px; display: flex;" >
                        <div class="container-fluid">
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                        <div class="collapse navbar-collapse" id="navbarNavDropdown">
                            <ul class="navbar-nav ms-auto">
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        ', $email, '
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">';
                        if ($tipo == 'estabelecimento') { //Caso o usuário seja a barbearia, ele exibe o link para a barbearia.php
                            echo '<li><a class="dropdown-item" href="barbearia.php">Barbearia</a></li>';
                        } elseif ($tipo == 'cliente') { //Caso seja cliente, ele exibe o link para o cliente.php
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
                    } else {
                        header('Location:entrar.php');//Caso por algum motivo o usuário acesse essa página sem estar logado, ele é redirecionado para o Login
                        die;
                    }
                    ?>
                </div>
            </div>
        </nav>
    </header>


    <div>
        <h1 id="titulo">Alterar dados</h1>
    </div>

    <div class="container-fluid p-5 pt-5">

        <div class="card bg-light card-register mx-auto col-8 px-0">

            <div class="card-body">

                <form action="php/alterarDados.php" method="POST">

                    <div class="form-group">

                        <div class="form-row">

                            <div class="col-12">
                                <label class="form-label" for="nome" id="nomeidLabel">Digite o nome da Barbearia</label>
                                <?php
                                /*Bom, se o usuário chegou até aqui ele com certeza está logado, então ele vai exibir todas as informações dele nos campos corretos.
                                Isso também facilita na hora de alterar eles, já que não preciso ficar verificando se estão vazios (a nao ser o email e senha)*/
                                echo '<input type="text" name="nome" class="form-control" id="nomeidInput" required value="', $dadosBarbearia['nome'], '" placeholder="Digite o nome da barbearia">';
                                ?>

                            </div>

                            <div class="col-12">
                                <label class="form-label" for="horarioAtendimento" id="horarioidLabel">Horario de atendimento</label>
                                <?php
                                echo '<input type="text" name="horarioAtendimento" class="form-control" value="', $dadosBarbearia['horarioAtendimento'], '" placeholder="Exemplo: 08:00 - 12:00 e 14:00 - 18:00" id="horarioidInput" required>'
                                ?>
                            </div>
                            <div class="col-12">
                                <label class="form-label" for="servicos" id="servicosidLabel">Serviços</label>
                                <?php
                                echo '<input type="text" name="servicos" class="form-control" value="', $dadosBarbearia['serviços'], '" placeholder="Descreva brevemente seus tipos de serviços" id="servicosidInput" required>'
                                ?>
                            </div>

                            <div class="col-12">
                                <label class="form-label" for="telefone">Telefone</label>
                                <?php
                                echo '<input type="tel" name="telefone" class="form-control" value="', $dadosBarbearia['telefone'], '" required placeholder="Digite seu telefone">'
                                ?>
                            </div>

                            <div class="col-12">
                                <label class="form-label" for="endereco" id="enderecoidLabel">Endereço</label>
                                <?php
                                echo '<input type="text" name="endereco" id="enderecoidInput" class="form-control" value="', $dadosBarbearia['endereço'], '" placeholder="Digite o endereço">'
                                ?>

                            </div>

                            <div class="row">
                                <div class="col-3">
                                    <label class="form-label" for="Complemento" id="complementoidLabel">Complemento</label>
                                    <?php
                                    echo '<input type="text" name="complemento" class="form-control" value ="', $dadosBarbearia['complemento'], '" id="complementoidInput" placeholder="Opcional">'
                                    ?>

                                </div>

                                <div class="col-3">
                                    <label class="form-label" id="cepidLabel" for="cep">CEP</label>
                                    <?php
                                    

                                    echo '<input type="zip" name="cep" class="form-control" id="cepidInput" value="', $dadosBarbearia['cep'], '" placeholder="Digite seu CEP">'
                                    ?>

                                </div>
                                
                                <div class="col-3">
                                    <label class="form-label" for="estado" id="estadoidLabel">Estado</label>
                                    <select name="estado" class="form-control" id="uf">
                                        <?php
                                        echo '<option value="', $dadosBarbearia['estado'], '">', strtoupper($dadosBarbearia['estado']), '</option>';
                                        ?>
                                    </select>
                                </div>

                                <div class="col-3">
                                    <label class="form-label" for="cidade" id="cidadeidLabel">Cidade</label>
                                    <select name="cidade" class="form-control" id="cid">
                                        <?php
                                        echo '<option value="', $dadosBarbearia['cidade'], '">', $dadosBarbearia['cidade'], '</option>';
                                        ?>
                                    </select>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <label class="form-label" for="email">Novo Email</label>
                                    <input type="email" name="email" class="form-control" aria-required="true" placeholder="name@example.com">
                                </div>
                                <div class="col-6">
                                    <label for="" class="form-label" style="margin-bottom: 2px;">Nova Senha</label>
                                    <input type="password" name="senha" class="form-control" placeholder="123Abc@#$">
                                    <div class="form-text">A senha deve ter entre 6 e 16 caracteres.</div>
                                </div>
                                <div class="col-6">
                                    <?php

                                    /*Bom, aqui é basicamente um tratamento de erro do alterarDados.php.
                                    Caso através do método GET seja encontrado a variável 'erro', ele exibe que esse email já foi cadastrado.*/
                                    if (isset($_GET['erro'])) {
                                        $emailError = $_GET['erro'];
                                        if ($emailError) {
                                            echo '<p style="color: red;">Esse e-mail já existe!</p>';
                                        } else {
                                            echo '<p style="color: red;">Erro desconhecido.</p>';
                                        }
                                    }
                                    ?>

                                </div>



                                <!-- Adicione os scripts do Bootstrap -->
                                <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
                                <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
                                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
                            </div>

                            <div>
                                <label class="form-label" for="telefone">Foto da Barbearia -> </label>
                                <input type="file" name="foto">
                            </div>

                            <div class="text-center p-4">
                                <input type="submit" value="Alterar" class="btn btn-dark" style="--bs-btn-padding-x: .5rem">
                                <a href="index.php"><button type="button" class="btn btn-dark" style="--bs-btn-padding-x: .5rem">Voltar</button></a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

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
<script src="js/script.js"></script>
<script src="js/barbearia.js"></script>
<script src="js/ibgeAPI.js"></script>
</html>