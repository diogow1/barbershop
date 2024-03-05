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
    <title>Formulário de Cadastro</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/criar_conta.css">
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
                <a class="navbar-brand" href="index.php"><img id="imgLogo" src="images/barber.png" class="img-thumbnail" alt="..." width="50" height="60"></a>

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
        <h1 id="titulo">Criar conta</h1>
    </div>

    <div class="container-fluid p-5 pt-5">

        <div class="card bg-light card-register mx-auto col-8 px-0">

            <div class="card-body">

                <form action="php/cria_contaBD.php" method="POST">

                    <div class="form-group">

                        <div class="form-row">

                            <div class="col-12">
                                <label class="form-label" for="nome" id="nomeidLabel">Nome completo</label>
                                <input type="text" name="nome" class="form-control" id="nomeidInput" required placeholder="Digite seu nome completo">
                            </div>

                            <div class="col-12">
                                <label class="form-label" for="nascimento" id="nascimentoidLabel">Nascimento</label>
                                <input type="date" name="nascimento" class="form-control" placeholder="dd/mm/aaaa" id="nascimentoidInput" required>
                            </div>

                            <div class="col-12">
                                <label class="form-label" for="telefone">Telefone</label>
                                <input type="tel" name="telefone" class="form-control" required placeholder="Digite seu telefone">
                            </div>

                            <div class="col-12">
                                <label class="form-label" for="endereco" id="enderecoidLabel">Endereço</label>
                                <input type="text" name="endereco" id="enderecoidInput" class="form-control" placeholder="Digite seu endereço">
                            </div>

                            <div class="row">
                                <div class="col-3">
                                    <label class="form-label" for="Complemento" id="complementoidLabel">Complemento</label>
                                    <input type="text" name="complemento" class="form-control" id="complementoidInput" placeholder="Opcional">
                                </div>

                                <div class="col-3">
                                    <label class="form-label" id="cepidLabel" for="cep">CEP</label>
                                    <input type="zip" name="cep" class="form-control" id="cepidInput" placeholder="Digite seu CEP">
                                </div>

                                <div class="col-3">
                                    <label class="form-label" for="estado" id="estadoidLabel">Estado</label>
                                    <select name="estado" class="form-control" id="uf">
                                        <option>Selecione um estado</option>
                                    </select>
                                </div>

                                <div class="col-3">
                                    <label class="form-label" for="cidade" id="cidadeidLabel">Cidade</label>
                                    <select name="cidade" class="form-control" id="cid">
                                        <option>Selecione uma Cidade</option>
                                    </select>
                                </div>


                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <label class="form-label" for="email">Email</label>
                                    <input type="email" name="email" class="form-control" aria-required="true" placeholder="name@example.com" required>
                                </div>
                                <div class="col-6">
                                    <label for="" class="form-label" style="margin-bottom: 2px;">Senha</label>
                                    <input type="password" name="senha" class="form-control" placeholder="123Abc@#$" required>
                                    <div class="form-text">A senha deve ter entre 6 e 16 caracteres.</div>
                                </div>
                                <?php
                                    /*Bom, aqui é basicamente um tratamento de erro do criar_contaDB.php.
                                    Caso através do método GET seja encontrado a variável 'erro', ele exibe que esse email já foi cadastrado.
                                    Para entender melhor recomendo verificar o arquivo entrarDB.php.*/
                                    if (isset($_GET['erro'])) {
                                        $emailError = $_GET['erro'];
                                        if ($emailError) {
                                            echo '<p style="color: red;">Esse e-mail já existe!</p>';
                                        } else {
                                            echo '<p style="color: red;">Erro desconhecido.</p>';
                                        }
                                    }
                                    ?>


                                <div class="col-6" id="check">
                                    Usuário:
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="opcao" id="opcao1" value="opcao1" onclick="mostrarCliente()" checked>
                                        <label class="form-check-label" for="opcao1">
                                            Cliente
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="opcao" id="opcao2" value="opcao3" onclick="mostrarEstabelecimento()">
                                        <label class="form-check-label" for="opcao2">
                                            Estabelecimento
                                        </label>
                                    </div>
                                </div>
                                <div class="col-6">

                                </div>




                                <!-- Adicione os scripts do Bootstrap -->
                                <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
                                <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
                                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
                            </div>

                            <div class="text-center p-4">
                                <input type="submit" value="Cadastrar" class="btn btn-dark" style="--bs-btn-padding-x: .5rem">
                                <a href="index.php"><button type="button" class="btn btn-dark" style="--bs-btn-padding-x: 1.305rem">Voltar</button></a>
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
<script src="js/criar_conta.js"></script>
<script src="js/ibgeAPI.js"></script>

</html>