
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Clientes</title>
    <style>
        /* Estilos gerais */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #b0bc83;
        }

        /* Estilos da caixa principal */
        .box {
            color: green;
            background-color: white;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 20px;
            border-radius: 15px;
            width: 90%;
            max-width: 400px;
            text-align: center;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
        }

        /* Estilos para o formulário */
        fieldset {
            border: 2px solid black;
            padding: 20px;
            border-radius: 20px;
            margin-bottom: 15px;
            background-color: lightyellow;
        }

        legend {
            padding: 10px 20px;
            text-align: center;
            background-color: yellow;
            color: black;
            border-radius: 9px;
            font-size: 20px;
            font-weight: bold;
        }

        /* Estilos para os inputs */
        .inputBox {
            position: relative;
            margin-bottom: 20px;
        }

        .inputUser {
            background: none;
            border: none;
            border-bottom: 2px solid green;
            outline: none;
            color: black;
            font-size: 16px;
            width: 100%;
            padding: 6px 0;
            transition: border-bottom-color 0.3s;
        }

        .inputUser:focus {
            border-bottom-color: green;
        }

        .labelInput {
            position: absolute;
            top: 8px;
            left: 0;
            color: rgba(255, 255, 255, 0.7);
            transition: top 0.3s, font-size 0.3s, color 0.3s;
            pointer-events: none;
        }

        .inputUser:focus ~ .labelInput,
        .inputUser:not(:placeholder-shown) ~ .labelInput {
            top: -12px;
            font-size: 12px;
            color: black;
        }

        /* Estilos para o campo de data */
        #data_nascimento {
            background: none;
            border: 1px solid black;
            outline: none;
            color: black;
            font-size: 16px;
            padding: 8px;
            border-radius: 10px;
            width: 100%;
            transition: border-color 0.3s;
        }

        /* Estilos para os radio buttons */
        .radioContainer {
            display: flex;
            justify-content: space-around;
            margin-top: 10px;
        }

        .radioContainer label {
            color: black;
            margin-left: 5px;
            font-size: 16px;
        }

        /* Estilos para o botão de submit */
        #submit {
            background-color: yellow;
            width: 100%;
            border: none;
            padding: 15px;
            color: black;
            font-size: 16px;
            cursor: pointer;
            border-radius: 10px;
            transition: background-image 0.3s;
            margin-top: 20px;
        }

        /* Estilos adicionais conforme necessário */
    </style>
</head>
<body>
    <div class="box">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        
        <div class="campo">
            <h1 id="título">FORMULÁRIO DE CLIENTES</h1>
            <p id="subtítulo">Complete suas informações</p>
            <br>
        </div>

        <form>
            <fieldset class="grupo">
                <div class="campo">
                    <label for="nome"><strong>Nome</strong></label>
                    <input type="text" name="nome" id="nome" required>
                </div>
                <div class="campo">
                    <label for="senha"><strong>Senha</strong></label>
                    <input type="password" name="senha" id="senha" required>
                </div>
            </fieldset>

            <div class="campo">
                <label for="email"><strong>Email</strong></label>
                <input type="email" name="email" id="email" required>
            </div>
            <div class="campo">
                <label for="text"><strong>Telefone</strong></label>
                <input type="telefone" name="telefone" id="telefone" required>
            </div><br>


            <div class="campo">
                <label><strong>Sexo</strong></label>
                <label>
                    <input type="radio" name="devweb" value="frontend">Masculino
                </label>
                <label>
                    <input type="radio" name="devweb" value="backend">Feminino
                </label>
                <label>
                    <input type="radio" name="devweb" value="fullstack">Outros
                </label>
            </div>
            <label for="data_nascimento"><b>Data de Nascimento:</b></label>
                <input type="date" name="data_nascimento" id="data_nascimento" required>
                <br><br>
                <div class="campo">
                    <label for="cidade"><strong>Cidade</strong></label>
                    <input type="text name="cidade" id="cidade" required>
                </div>
                <div class="campo">
                    <label for="Estado"><strong>Estado</strong></label>
                    <input type="text" name="Estado" id="Estado" required>
                </div>
                <div class="campo">
                    <label for="endereço"><strong>Endereço</strong></label>
                    <input type="text" name="endereço" id="endereço" required>
                </div>
                



            

            
            
            


        </form>
</body>
        
    </div>

    <?php
    // Verifica se o formulário foi enviado
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Conexão com o banco de dados (substitua com suas credenciais)
        $servername = "localhost";
        $username = "seu_usuario";
        $password = "sua_senha";
        $dbname = "seu_banco_de_dados";

        // Cria a conexão
        $conexao = new mysqli($servername, $username, $password, $dbname);

        // Verifica a conexão
        if ($conexao->connect_error) {
            die("Conexão falhou: " . $conexao->connect_error);
        }

        // Prepara e executa a inserção no banco de dados
        $nome = $_POST['nome'];
        $senha = $_POST['senha'];
        $email = $_POST['email'];
        $telefone = $_POST['telefone'];
        $sexo = $_POST['genero'];
        $data_nasc = $_POST['data_nascimento'];
        $cidade = $_POST['cidade'];
        $estado = $_POST['estado'];
        $endereco = $_POST['endereco'];

        $sql = "INSERT INTO clientes (nome, senha, email, telefone, sexo, data_nasc, cidade, estado, endereco)
                VALUES ('$nome', '$senha', '$email', '$telefone', '$sexo', '$data_nasc', '$cidade', '$estado', '$endereco')";

        if ($conexao->query($sql) === TRUE) {
            echo "<script>alert('Registro inserido com sucesso!');</script>";
        } else {
            echo "Erro: " . $sql . "<br>" . $conexao->error;
        }

        // Fecha a conexão
        $conexao->close();
    }
    ?>
</body>
</html>
