<?php 
  function insereProduto($conexao, $nome, $preco, $descricao,$quantidade, $categoria_id, $usado) {   
    $query = "insert into produtos (nome, preco, descricao, quantidade,categoria_id, usado) values ('{$nome}', {$preco},'{$descricao}','{$quantidade}',{$categoria_id}, {$usado})"; 
    // echo $query;
    $resultadoDaInsercao = mysqli_query($conexao, $query);     
    return $resultadoDaInsercao;
  }

  function listaProdutos($conexao) {
    $produtos = array();
    $resultado = mysqli_query($conexao, "select p.*, c.nome as categoria_nome from produtos as p join categorias as c on p.categoria_id = c.id WHERE p.quantidade > 0");

    while($produto = mysqli_fetch_assoc($resultado)) {
      array_push($produtos, $produto);
    }
    return $produtos;
  }

  function listaProdutosPorCategoria($conexao, $categoriaSelecionada) {
    $produtos = array();
    $query = "SELECT p.*, c.nome as categoria_nome 
              FROM produtos as p 
              JOIN categorias as c ON p.categoria_id = c.id 
              WHERE p.quantidade > 0 AND c.nome = '{$categoriaSelecionada}'";
    $resultado = mysqli_query($conexao, $query);

    while($produto = mysqli_fetch_assoc($resultado)) {
        array_push($produtos, $produto);
    }
    return $produtos;
}


  function buscaProduto($conexao, $id) {
    $query = "select * from produtos where id = {$id}";
    $resultado = mysqli_query($conexao, $query);
    return mysqli_fetch_assoc($resultado);
  }

  function alteraProduto($conexao, $id, $nome, $preco, $descricao,$quantidade, $categoria_id, $usado) {
    $query = "update produtos set nome = '{$nome}', preco = {$preco}, descricao = '{$descricao}',quantidade = '{$quantidade}',  categoria_id= {$categoria_id}, usado = {$usado} where id = '{$id}'";
    return mysqli_query($conexao, $query);
  }

  function removeProduto($conexao, $id) {
    $query = "delete from produtos where id = {$id}";
    return mysqli_query($conexao, $query);
  }
  
