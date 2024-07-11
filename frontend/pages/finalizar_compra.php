<?php

include './produtos/include/conexao.php'; // ou onde seu arquivo de conexão estiver

function inserePedido($conexao, $produtos, $quantidades, $valorTotal, $dataPedido, $statusPedido, $Clientes_id) {
    $produtos_serializados = serialize($produtos);
    $quantidades_serializadas = serialize($quantidades);
    
    $query = "INSERT INTO Pedido (produtos, quantidades, valorTotal, dataPedido, statusPedido, Clientes_id) 
              VALUES ('{$produtos_serializados}', '{$quantidades_serializadas}', {$valorTotal}, '{$dataPedido}', '{$statusPedido}', {$Clientes_id})";
    return mysqli_query($conexao, $query);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ids = $_POST['ids'];
//    $cliente_id = $_POST['cliente_id']; // Supondo que o ID do cliente seja enviado no POST
    $cliente_id = 1; // Supondo que o ID do cliente seja enviado no POST

    $produtos = [];
    $quantidades = [];
    $valorTotal = 0;

    foreach ($ids as $id) {
        // Busca o produto para verificar a quantidade disponível
        $produto = buscaProduto($conexao, $id);
        if ($produto['quantidade'] > 0) {
            // Atualiza a quantidade do produto
            $novaQuantidade = $produto['quantidade'] - 1;
            alteraProduto($conexao, $id, $produto['nome'], $produto['preco'], $produto['descricao'], $novaQuantidade, $produto['categoria_id'], $produto['usado']);

            // Adiciona os detalhes do produto ao arrays
            $produtos[] = $produto['nome'];
            $quantidades[] = 1; // Considerando que cada pedido é de 1 unidade por item
            $valorTotal += $produto['preco'];
        } else {
            echo "Produto {$produto['nome']} está esgotado.";
            exit;
        }
    }

    // Insere o pedido no banco de dados
    $dataPedido = date('Y-m-d H:i:s');
    $statusPedido = 'Finalizado';
    inserePedido($conexao, $produtos, $quantidades, $valorTotal, $dataPedido, $statusPedido, $clientes_id);

    echo "Compra finalizada com sucesso!";
} else {
    echo "Método não permitido.";
}
?>
