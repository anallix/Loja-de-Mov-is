<?php 

  include("include/conexao.php");
  include("include/banco-categoria.php");

  $categorias = listaCategorias($conexao);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Formulário de Cadastro</title>
  <style>
    /* Estilos básicos */
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color:  #b0bc83;
    }

    /* Estilos para o cabeçalho */
    h1 {
      text-align: center;
      margin-top: 20px;
    }

    /* Estilos para o formulário */
    form {
      margin: 20px auto;
      width: 26%;
      background-color: rgb(244, 255, 201);
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    table {
      width: 90%;
    }

    table tr td {
      padding: 10px;
    }

    input[type="text"],
    input[type="number"],
    textarea {
      width: calc(100% - 20px);
      padding: 8px;
      border: 1px solid #ccc;
      border-radius: 5px;
      margin-bottom: 10px;
    }

    select {
      width: calc(100% - 22px);
      padding: 8px;
      border: 1px solid #ccc;
      border-radius: 5px;
      margin-bottom: 10px;
    }

    .btn-submit {
      background-color: grey;
      color: #fff;
      border: none;
      border-radius: 5px;
      padding: 10px 20px;
      cursor: pointer;
    }

    
  </style>
</head>
<body>

<h1>Formulário de Cadastro</h1>
<form action="adiciona-produto.php" method="post">
  <table>
    <tr>
      <td>Nome:</td>
      <td><input type="text" name="nome"/></td>
    </tr>
    <tr>
      <td>Preço</td>
      <td><input type="number" name="preco"/></td>
    </tr>
    <tr>
      <td>Descrição</td>
      <td><textarea name="descricao"></textarea></td>
    </tr>
    <tr>
      <td>Quantidade</td>
      <td><input type="number" name="quantidade"/></td>
    </tr>
    <tr>
      <td></td>
      <td>
        <input type="checkbox" name="usado" value="true"> Usado
      </td>
    </tr>
    <tr>
      <td>Categorias</td>
      <td>
        <select name="categoria_id">
          <?php foreach($categorias as $categoria) : ?>
            <option value="<?= $categoria['id'] ?>">
              <?= $categoria['nome'] ?><br>
            </option>
          <?php endforeach ?>
        </select>
      </td>
    </tr>
    <tr>
      <td></td>
      <td><input class="btn-submit" type="submit" value="Cadastrar"></td>
    </tr>
  </table>
</form>

<?php include("include/rodape.php") ?>
</body>
</html>
