<?php
session_start();
if (isset($_SESSION['usuarioEmail'])) { //Verifico se há algum usuário em sessão
    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entrar</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/entrar.css">

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
                <div class=" collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav  ms-auto custom-ul">
                    </ul>
                    <ul class="navbar-nav ms-auto custom-login">
                        <li class="nav-item">
                            <a class="nav-link mx-2 text-uppercase text-white" href="entrar.php"><i class="fa-solid fa-cart-shopping"></i>Entrar</a>
                        </li>
                        <li class="nav-item custom-register ms-2 ">
                            <a class="nav-link mx-2 text-uppercase text-white" href="cria_conta.php"><i class="fa-solid fa-circle-user"></i>Criar conta</a>
                        </li>
                    </ul>
                </div>
                
            </div>
        </nav>
    </header>

    <div>
        <h1 id="titulo">Entrar</h1>
    </div>

    <div class="container-fluid custom-sectionLogin">
        <div class="row mt-3">
            <div class="col-sm-4 offset-sm-4 card bg-light p-5">
                <form action="php/entrarBD.php" method="POST">
                    <div class="mb-3">
                        <label for="" class="form-label" style="margin-bottom: 2px;">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="name@example.com">
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label" style="margin-bottom: 2px;">Senha</label>
                        <input type="password" name="senha" class="form-control" placeholder="123Abc@#$">
                        <div class="form-text"></div>
                    </div>
                    <div class="col-6">
                        <?php
                        /*Bom, aqui é basicamente um tratamento de erro do entrarDB.php.
                        Caso através do método GET seja encontrado a variável 'erro', ele exibe que esse email já foi cadastrado.
                        Para entender melhor recomendo verificar o arquivo entrarDB.php.*/
                        if (isset($_GET['erro'])) {
                            $emailError = $_GET['erro'];
                            if ($emailError) {
                                echo '<p style="color: red;">Email ou senha está incorreto.</p>';
                            } else {
                                echo '<p style="color: red;">Erro desconhecido.</p>';
                            }
                        }
                        ?>

                    </div>

                    <div class="text-center">
                        <input type="submit" value="Entrar" class="btn btn-dark">
                        <a href="index.php"><button type="button" class="btn btn-dark">Voltar</button></a>
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

</html>