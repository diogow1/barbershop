<?php
include("conexao.php");

//Uso o método GET para acessar o URL e extrair o ID da barbearia
if (isset($_GET['id_barber'])) {

    $barbeariaId = intval($_GET['id_barber']); //Aqui eu armazeno o ID dentro de uma variável e com o atributo intval eu converto a string para int

    $consulta = "SELECT * FROM estabelecimento WHERE id_barber = $barbeariaId"; //Consulta no MySQLi
    $resultado = $mysqli->query($consulta);

    //O num_rows é uma função do php que retorna o número de linhas da consulta MySQLi
    if ($resultado->num_rows > 0) { //Se for maior que 0, quer dizer que ele encontrou linhas com informações na consulta
        $barbearia = $resultado->fetch_assoc(); 
        /*O fetch_assoc é um método que é usado para recuperar uma linha de resultados de uma consulta MySQLi e converter ele em uma array associativo
        Para ficar mais fácil o entendimento, a variável $barbearia ficaria assim:
            Array (
                'id_barber' => x,
                'nome' => 'Nome da barbearia',
                'endereço' => 'Rua A'
                etc...
                )
        */ 

        $nomeBarbearia = $barbearia['nome'];//Por fim, eu armazeno o nome da barbearia acessando a informação dentro do array


        echo "<h1>Agendar na Barbearia: $nomeBarbearia</h1>";
    } else {
        echo "Barbearia não encontrada.";
    }
} else {
    echo "ID da barbearia não especificado.";
}
$mysqli->close();
?>