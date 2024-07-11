
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho de Compras</title>
    <link rel="stylesheet" href="../css/carrinho.css">
</head>
<body>
    
    </header>
    <!-- <button id="dark-mode-toggle">Modo Escuro</button> -->
    <button id="dark-mode-toggle" class="dark-mode-toggle">Modo Escuro</button>

   
    <div id="produtos">
        <!-- Os produtos ficam entre esses comentários -->
        <div class="produto">
            <img src="../img/imgcarrinho/cabeceira_branca.jpg" alt="Periférico 1">
            <h2><B></B>CABECEIRA BRANCA</B></h2>
            <p>R$ 800</p>
            <div class="controles">
                <button onclick="incrementarQuantidade('quantidadeProduto1')">+</button>
                <input type="number" id="quantidadeProduto1" value="1" min="1">
                <button onclick="decrementarQuantidade('quantidadeProduto1')">-</button>
            </div>
            <button onclick="adicionarAoCarrinho('Cabeceira', 800, 'quantidadeProduto1')">Adicionar ao Carrinho</button>
        </div>
        <div class="produto">
            <img src="../img/imgcarrinho/escrivaninha branca.jpeg" alt="Periférico 2">
            <h2><b>CADEIRA MADEIRA</b></h2>
            <p>R$ 100</p>
            <div class="controles">
                <button onclick="incrementarQuantidade('quantidadeProduto2')">+</button>
                <input type="number" id="quantidadeProduto2" value="1" min="1">
                <button onclick="decrementarQuantidade('quantidadeProduto2')">-</button>
            </div>
                    
            <button onclick="adicionarAoCarrinho('Cadeira Madeira', 1200, 'quantidadeProduto2')">Adicionar ao Carrinho</button>
            
        </div>
        <div class="produto">
            <img src="../img/imgcarrinho/escrivaninha pequena.jpg" alt="Periférico 3">
            <h2><B>CADEIRA</B></h2>
            <p>R$ 100,99</p>
            <div class="controles">
                <button onclick="incrementarQuantidade('quantidadeProduto3')">+</button>
                <input type="number" id="quantidadeProduto3" value="1" min="1">
                <button onclick="decrementarQuantidade('quantidadeProduto3')">-</button>
            </div>
            <button onclick="adicionarAoCarrinho('Cadeira', 899.99, 'quantidadeProduto3')">Adicionar ao Carrinho</button>
        </div>
        <div class="produto">
            <img src="../img/imgcarrinho/guarda roupa 1.jpg" alt="Periférico 4">
            <h2><B>GUARDA ROUPA</B></h2>
            <p>R$ 700</p>
            <div class="controles">
                <button onclick="incrementarQuantidade('quantidadeProduto4')">+</button>
                <input type="number" id="quantidadeProduto4" value="1" min="1">
                <button onclick="decrementarQuantidade('quantidadeProduto4')">-</button>
            </div>
            <button onclick="adicionarAoCarrinho('Guarda Roupa', 350, 'quantidadeProduto4')">Adicionar ao Carrinho</button>
        </div>
        <div class="produto">
            <img src="../img/imgcarrinho/e79923de5ef8ccee3714814f3efbd3f9.webp" alt="Periférico 5">
            <h2><B>MESA BRANCA</B></h2>
            <p>R$ 2.500</p>
            <div class="controles">
                <button onclick="incrementarQuantidade('quantidadeProduto5')">+</button>
                <input type="number" id="quantidadeProduto5" value="1" min="1">
                <button onclick="decrementarQuantidade('quantidadeProduto5')">-</button>
            </div>
            <button onclick="adicionarAoCarrinho('Mesa Branca', 4500, 'quantidadeProduto5')">Adicionar ao Carrinho</button>
        </div>
        <div class="produto">
            <img src="../img/imgcarrinho/penteadeira marrom.png" alt="Periférico 6">
            <h2><B>PENTEADEIRA</B></h2>
            <p>R$ 150</p>
            <div class="controles">
                <button onclick="incrementarQuantidade('quantidadeProduto6')">+</button>
                <input type="number" id="quantidadeProduto6" value="1" min="1">
                <button onclick="decrementarQuantidade('quantidadeProduto6')">-</button>
            </div>
            <button onclick="adicionarAoCarrinho('Penteadeira', 750, 'quantidadeProduto6')">Adicionar ao Carrinho</button>
        </div>
        <div class="produto">
            <img src="../img/imgcarrinho/Mesa-Para-Computador-Escrivaninha-Home-Office-Estudos-2-Gavetas-1-Nicho-Escrit-rio-Quarto-Preta_1690387139_g.jpg" alt="Periférico 7">
            <h2><B>MESA PRETA</B></h2>
            <p>R$ 199</p>
            <div class="controles">
                <button onclick="incrementarQuantidade('quantidadeProduto7')">+</button>
                <input type="number" id="quantidadeProduto7" value="1" min="1">
                <button onclick="decrementarQuantidade('quantidadeProduto7')">-</button>
            </div>
            <button onclick="adicionarAoCarrinho('Mesa Preta', 199, 'quantidadeProduto7')">Adicionar ao Carrinho</button>
        </div>
        <div class="produto">
            <img src="../img/imgcarrinho/1xg.avif" alt="Periférico 8">
            <h2><B>CADEIRA ROSA</B></h2>
            <p>R$ 200</p>
            <div class="controles">
                <button onclick="incrementarQuantidade('quantidadeProduto8')">+</button>
                <input type="number" id="quantidadeProduto8" value="1" min="1">
                <button onclick="decrementarQuantidade('quantidadeProduto8')">-</button>
            </div>
            <button onclick="adicionarAoCarrinho('Cadeira Rosa', 45, 'quantidadeProduto8')">Adicionar ao Carrinho</button>
        </div>
        
        
            
        <!-- Só adicione produtos daqui pra cima -->
    </div>

    <div id="carrinho-lateral">
        <h2>Itens no Carrinho</h2>
        <ul id="carrinho-lateral-lista">
            <!-- Itens do Carrinho serão adicionados aqui dinamicamente -->
        </ul>
        <div id="total-carrinho-lateral">Total: R$ 0,00</div>
        <button onclick="limparCarrinho()" id="botao-carrinho">Limpar Carrinho</button>
    </div>

    <div id="carrinho-icon"onclick="abrirOuFecharCarrinho()">0</div>
    <div class="footer-bottom">
        
        <p>&copy; 2024 <br> Escola Técnica da Ceilândia - ETC <br>Todos os direitos reservados aos desenvolvedores desta página</p>
    </div>
<script src="../js/scriptcarrinho.js"></script>
</body>
</html>

