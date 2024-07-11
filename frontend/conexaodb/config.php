<?php

//Variaveis para a conexão com BD

$dbHost = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'loja_moveis';

//Variavel para a conexão
$conexao = new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);


// Validação para verificar se a configuração está tudo certo!!!!!



 if($conexao->connect_errno){
    echo "Erro";
}
 else{
     echo "Conexão efetuada com sucesso";
 }


?>