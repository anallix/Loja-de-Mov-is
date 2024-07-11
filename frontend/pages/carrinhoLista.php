<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Carrinho de Compras</title>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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
            .produtos tbody {
                display: grid;
                grid-template-columns: repeat(4, 1fr);
                gap: 20px; /* Ajuste o valor conforme necessário para o espaçamento desejado */
                margin-top: 20px;
            }

            .produto-item {
                border: 1px solid #ddd;
                padding: 10px;
                background: #fff;
            }

            .produto-item td {
                display: block;
                margin-bottom: 10px;
            }

            .produto-item .btn {
                display: inline-block;
            }

            .produto-item form {
                display: inline-block;
            }
            .modal {
                display: none;
                position: fixed;
                z-index: 1;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                overflow: auto;
                background-color: rgba(0,0,0,0.4);
            }
            .modal-content {
                background-color: #fefefe;
                margin: 15% auto;
                padding: 20px;
                border: 1px solid #888;
                width: 80%;
            }
            .close {
                color: #aaa;
                float: right;
                font-size: 28px;
                font-weight: bold;
            }
            .close:hover,
            .close:focus {
                color: black;
                text-decoration: none;
                cursor: pointer;
            }


        </style>
    </head>
    <body>
        <nav class="navbar">
            <div class="container-fluid">
                <a class="navbar-brand" href="http://localhost/loja_moveis2/frontend/pages/home/#">ofz<span>Móveis</span></a>
            </div>
        </nav>
        <?php
        include("./produtos/include/conexao.php");
//        include("./produtos/include/finalizar_compra.php");
        include("./produtos/include/banco-produto.php");
        ?>
        <div class="box-search">
            <input type="search" class="form-control w-25" placeholder="Pesquisar" id="pesquisar">
            <button onclick="searchData()" class="btn btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                </svg>
            </button>
        </div>
        <table class="table table-striped table-bordered produtos">
            <tbody>
                <?php
                   // Verifica se o parâmetro de categoria está presente na URL
                if (isset($_GET['opc'])) {
                    $categoriaSelecionada = $_GET['opc'];
                    $produtos = listaProdutosPorCategoria($conexao, $categoriaSelecionada);
                } else {
                    // Se não houver parâmetro de categoria, lista todos os produtos
                    $produtos = listaProdutos($conexao);
                }
                foreach ($produtos as $produto) :
                    $nomeproduto = $produto['nome'];
                    $preco = $produto['preco'];
                    $quantidade = $produto['quantidade'];
                    $categoria = $produto['categoria_nome'];
                    if ($categoria == 'Quarto') {
                        $imagem = "<img src='../img/img/cabeceira branca.jpg' width='200' height='200'>";
                    } elseif ($categoria == 'Sala') {
                        $imagem = "<img src='../img/img/escrivaninha pequena.jpg' width='200' height='200'>";
                    } elseif ($categoria == 'Cozinha') {
                        $imagem = "<img src='../img/img/armariocozinha.jpeg' width='200' height='200'>";
                    } else {
                        $imagem = "<img src='../img/img/mangeira.jpeg' width='200' height='200'>";
                    }
                    ?>
                    <tr class="produto-item">
                        <td><?= "Categoria: $categoria" ?></td>
                        <td><?= $imagem ?></td>
                        <td><?= "Produto: $nomeproduto <br> Preço: $preco <br> Quantidade: $quantidade" ?></td>
                        <td>
                            <button class="btn btn-comprar" data-id="<?= $produto['id'] ?>" data-nome="<?= $produto['nome'] ?>" data-preco="<?= $produto['preco'] ?>">Adicionar ao Carrinho</button>
                        </td>
                    </tr>
                    <?php
                endforeach;
                ?>  
            </tbody>
        </table>
        <!-- Modal do Carrinho -->
        <div id="carrinhoModal" class="modal" >
            <div class="modal-content" style="width: 800px;">
                <button class="btn  btn-sm close">Fechar</button>
                <h2>Carrinho de Compras</h2>
                <table id="carrinhoTabela">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Preço</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Itens do carrinho serão adicionados aqui -->
                    </tbody>
                </table>
                <p>Total: R$ <span id="carrinhoTotal">0.00</span></p>
                <button id="btnFinalizarCompra">Finalizar Compra</button>
                <button id="btnVoltarComprar">Voltar a Comprar</button>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script>
                // Funções JavaScript para manipular o carrinho de compras
                let carrinho = [];

                document.querySelectorAll('.btn-comprar').forEach(button => {
                    button.addEventListener('click', () => {
                        const produtoId = button.getAttribute('data-id');
                        // Verificar se o produto já está no carrinho
                        const produtoExistente = carrinho.find(produto => produto.id === produtoId);
                        if (!produtoExistente) {
                            const produto = {
                                id: produtoId,
                                nome: button.getAttribute('data-nome'),
                                preco: parseFloat(button.getAttribute('data-preco'))
                            };
                            carrinho.push(produto);
                            atualizarCarrinho();
                            document.getElementById('carrinhoModal').style.display = "block";
                        } else {
                            alert('Este produto já está no carrinho.');
                        }
                    });
                });

                document.querySelector('.close').addEventListener('click', () => {
                    document.getElementById('carrinhoModal').style.display = "none";
                });

                document.getElementById('btnVoltarComprar').addEventListener('click', () => {
                    document.getElementById('carrinhoModal').style.display = "none";
                });

                document.getElementById('btnFinalizarCompra').addEventListener('click', () => {
                    finalizarCompra();
                });

                function atualizarCarrinho() {
                    const tbody = document.querySelector('#carrinhoTabela tbody');
                    tbody.innerHTML = '';
                    let total = 0;
                    carrinho.forEach((produto, index) => {
                        total += produto.preco;
                        const tr = document.createElement('tr');
                        tr.innerHTML = `
                    <td>${produto.nome}</td>
                    <td>R$ ${produto.preco.toFixed(2)}</td>
                    <td>
                        <button class="btn btn-danger" onclick="removerDoCarrinho(${index})">Remover</button>
                    </td>
                `;
                        tbody.appendChild(tr);
                    });
                    document.getElementById('carrinhoTotal').innerText = total.toFixed(2);
                }

                function removerDoCarrinho(index) {
                    carrinho.splice(index, 1);
                    atualizarCarrinho();
                }

                function finalizarCompra() {
                    const ids = carrinho.map(produto => produto.id);
                    $.ajax({
                        url: './produtos/include/finalizar_compra.php',
                        method: 'POST',
                        data: {ids: ids},
                        success: function (response) {
                            alert('Compra finalizada com sucesso!1');
                            carrinho = [];
                            atualizarCarrinho();
                            document.getElementById('carrinhoModal').style.display = "none";
                            location.reload(); // Recarrega a página
                        },
                        error: function () {
                            alert('Erro ao finalizar a compra.');
                        }
                    });
                }
        </script>
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
    </body>
</html>
