<?php 
  include("include/cabecalho.php"); 
  include("include/conexao.php"); 
  include('include/banco-produto.php'); 
     
  $nome = $_POST["nome"];
  $preco = $_POST["preco"];
  $descricao = $_POST["descricao"];
  $quantidade = $_POST["quantidade"];
  $categoria_id = $_POST["categoria_id"];
  if(array_key_exists('usado', $_POST)) {
    $usado = "true";
  } else {
    $usado = "false";
  }  

  if(insereProduto($conexao, $nome, $preco, $descricao,$quantidade, $categoria_id, $usado)) { 
?>

  <p class="alert-success">Produto <?= $nome; ?>, <?= $preco; ?>, <?= $descricao ?> foi adicionado com sucesso!</p>
  
  <?php
    } else { 
      $msg = mysqli_error($conexao);
  ?>
    
  <p class="alert-danger">O Produto <?= $nome; ?>, não foi adicionado:  <?= $msg ?></p>

  <?php       
    }
  ?>
  


<?php include("./include/rodape.php") ?>