<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <style>
        /* Estilos básicos */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #b0bc83;
        }

        /* Estilos para a barra de navegação */
        .navbar {
            background-color: green;
            padding: 1rem;
            color: #fff;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar-brand {
            font-size: 1.5rem;
            font-weight: bold;
            text-decoration: none;
            color: #fff;
        }

        .navbar-brand span {
            color: #ffc107;
        }

        .d-flex {
            display: flex;
        }

        .btn-sair {
            color: #fff;
            background-color: #dc3545;
            border-color: #dc3545;
            font-weight: bold;
            padding: 10px 20px;
            border-radius: 5px;
            margin-right: 15px;
        }

        .btn-sair:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }

        /* Estilos para a tabela */
        table {
            width: 80%; 
            border-collapse: collapse;
            margin: 20px auto; 
            background-color: #fff;
            border-radius: 20px; 
            overflow: hidden; 
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); 
        }

        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: rgb(254, 255, 214);
            color: black;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }

        .btn-alterar {
            padding: 8px 16px;
            background-color: grey;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            margin-right: 5px;
        }

        

        .btn-remover {
            padding: 8px 16px;
            background-color: #dc3545;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
        }

        .btn-remover:hover {
            background-color: #c82333;
        }

        .link-voltar {
            padding: 10px 20px;
            background-color: lightyellow;
            color: black;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
            display: inline-block;
        }

        .link-voltar:hover {
            background-color: #ffca28;
        }

        .box-search {
    margin-top: 20px;
    display: flex;
    align-items: center;
    justify-content: center; /* Centraliza horizontalmente */
    border-radius: 18px;
}

.box-search input[type="search"] {
    width: 200px;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 12px;
    margin-right: 10px;
}

.box-search button {
    padding: 8px 16px;
    background-color: rgb(254, 255, 214);
    color: black;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

    /* Estilo para o link do relatório */
    .link-relatorio {
        padding: 10px 20px;
            background-color: lightyellow;
            color: black;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
            display: inline-block;
            float: right; /* Posiciona à direita */
    }

    .link-relatorio:hover {
        background-color: #ffca28;
    }


        
    </style>
</head>
<body>
<nav class="navbar">
    <div class="container-fluid">
        <a class="navbar-brand" href="../../index.php">ofz<span>Móveis</span></a>
    </div>
    <div class="d-flex">
        <a href="sair.php" class="btn btn-sair">Sair</a>
    </div>
</nav>

<?php
include("include/conexao.php");
include("include/banco-produto.php");

if(array_key_exists("removido", $_GET) && $_GET["removido"] == true) :
?>
    <p class="alert-success">Produto apagado com sucesso</p>
<?php
endif;
?>
<a href="relatorio_produtos_cadastrados.php" target="_blank" class="link-relatorio">Gerar Relatório</a>

<a href="http://localhost/loja_moveis2/frontend/pages/home/" class="link-voltar">Voltar</a>
<div class="box-search">
<input type="search" class="form-control w-25" placeholder="Pesquisar" id="pesquisar">

        <button onclick="searchData()" class="btn btn-primary">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
            </svg>
        </button>
    </div>

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Nome</th>
            <th>Preço</th>
            <th>Descrição</th>
            <th>Quantidade</th>
            <th>Categoria</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $produtos = listaProdutos($conexao);
        foreach($produtos as $produto) :
        ?>
        <tr>
            <td><?= $produto['nome'] ?></td>
            <td><?= $produto['preco'] ?></td>
            <td><?= substr($produto['descricao'], 0, 500) ?></td>
            <td><?= $produto['quantidade'] ?></td>
            <td><?= $produto['categoria_nome'] ?></td>
            <td>
                <a class="btn btn-alterar" href="produto-altera-formulario.php?id=<?= $produto['id'] ?>">Alterar</a>
                <form style="display: inline;" action="remove-produto.php" method="post">
                    <input type="hidden" name="id" value="<?= $produto['id'] ?>" />
                    <button class="btn btn-remover">Remover</button>
                </form>
            </td>
        </tr> 
        <?php
        endforeach;
        ?>  
       <script>
    function searchData() {
        // Captura o valor digitado no campo de pesquisa
        var input = document.getElementById('pesquisar');
        var filter = input.value.toUpperCase();
        
        // Seleciona a tabela e as linhas de dados
        var table = document.querySelector('table');
        var rows = table.getElementsByTagName('tr');
        
        // Itera pelas linhas da tabela, começando pelo índice 1 (ignorando o cabeçalho)
        for (var i = 0; i < rows.length; i++) {
            var cells = rows[i].getElementsByTagName('td');
            var found = false;
            
            // Itera pelas células de cada linha
            for (var j = 0; j < cells.length; j++) {
                var cell = cells[j];
                
                // Se o texto da célula contém o texto pesquisado, exibe a linha; caso contrário, esconde
                if (cell) {
                    var textValue = cell.textContent || cell.innerText;
                    if (textValue.toUpperCase().indexOf(filter) > -1) {
                        found = true;
                        break;
                    }
                }
            }
            
            // Exibe ou esconde a linha com base na busca
            if (found) {
                rows[i].style.display = '';
            } else {
                rows[i].style.display = 'none';
            }
        }
        
        // Verifica se o campo de pesquisa está vazio e exibe todas as linhas novamente
        if (filter === '') {
            for (var i = 0; i < rows.length; i++) {
                rows[i].style.display = '';
            }
        }
    }
</script>


    </tbody>
</table>



</body>
</html>
