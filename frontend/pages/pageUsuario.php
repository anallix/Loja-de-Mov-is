<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Área do Cliente - Minha Loja de Móveis</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #a4ad8b; /* Cor de fundo mais escura */
            color: #000000; /* Cor do texto preto */
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        header {
            text-align: center;
            margin-bottom: 20px;
        }

        .profile, .orders {
            background-color: #dcffb0; /* Fundo mais claro */
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .profile h2, .orders h2 {
            color: #000000; /* Título preto */
        }

        .profile p {
            color: #000000; /* Texto preto */
        }

        .orders ul {
            list-style-type: none;
            padding: 0;
        }

        .orders ul li {
            margin-bottom: 20px;
            border-bottom: 1px solid #84a9ac; /* Linha separadora */
            padding-bottom: 15px;
        }

        .orders ul li:last-child {
            border-bottom: none; /* Remover borda da última linha */
        }

        .orders ul li strong {
            display: block;
            font-size: 18px;
            margin-bottom: 10px;
            color: #000000; /* Texto preto */
        }

        .orders ul li ul {
            padding-left: 20px;
        }

        .orders ul li ul li {
            color: #000000; /* Texto preto */
        }
        .link-voltar {
            display: inline-block;
            padding: 10px 20px;
            background-color: #ffc107; /* Amarelo */
            color: #000000; /* Texto preto */
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .link-voltar:hover {
            background-color: #ffca28; /* Amarelo mais claro ao passar o mouse */
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>Área do Cliente</h1>
        </header>
        
        <?php
        // Variáveis para a conexão com BD
        $dbHost = 'localhost';
        $dbUsername = 'root';
        $dbPassword = '';
        $dbName = 'loja_moveis';

        // Conectar ao banco de dados
        $conexao = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

        // Verificar conexão
        if ($conexao->connect_error) {
            die("Erro na conexão: " . $conexao->connect_error);
        }

        // Consulta SQL para obter informações do cliente
        session_start(); // Iniciar sessão para acessar variáveis de sessão
        if (isset($_SESSION['email'])) {
            $email = $_SESSION['email'];
            $sql = "SELECT * FROM clientes WHERE email = ?";
            $stmt = $conexao->prepare($sql);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

            // Verificar se encontrou algum cliente com o email
            if ($result->num_rows > 0) {
                $cliente = $result->fetch_assoc();
                $id =$cliente['id'];
                $sql = "SELECT *,date_format(dataPedido,'%d/%m/%Y %H:%i:%s')dataFormatada  
                            FROM pedido as P
                            inner Join clientes as C on C.id=P.clientes_id  
                            WHERE clientes_id=$id
                            ORDER BY idPedido ASC";
                            
                            $result = $conexao->query($sql);
                ?>
                <div class="profile">
                    <h2>Informações do Cliente</h2>
                    <p>Email: <?php echo $cliente['email']; ?></p>
                    <p>Nome: <?php echo $cliente['nome']; ?></p>
                    <p>Endereço: <?php echo $cliente['endereco']; ?></p>
                    <p>Telefone: <?php echo $cliente['telefone']; ?></p>
                    <a href="http://localhost/loja_moveis2/frontend/pages/home/" class="link-voltar">Voltar</a>
                </div>
                <div class="profile">
            <h2>Seus Pedidos</h2>
            <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Pedido N°</th>
                <th scope="col">Nome Cliente</th>
                <th scope="col">Produto(s)</th>
                <th scope="col">Valor Total</th>
                <th scope="col">Data do Pedido</th>
                <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($user_data = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td></td>";
                echo "<td>" . $user_data['idPedido'] . "</td>";
                echo "<td>" . $user_data['nome'] . "</td>";
                echo "<td>" . $user_data['produtos'] . "</td>";
                echo "<td>" . $user_data['valorTotal'] . "</td>";
                echo "<td>" . $user_data['dataFormatada'] . "</td>";
                echo "<td>" . $user_data['statusPedido'] . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
        </div>
        
                <?php
            } else {
                echo "<p>Nenhum cliente encontrado para o email: $email</p>";
            }

            // Fechar consulta
            $stmt->close();
        } else {
            echo "<p>Sessão não iniciada ou email não definido.</p>";
        }
        ?>
    </div>
</body>
</html>

