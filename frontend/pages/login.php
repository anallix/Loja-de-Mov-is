<!-- Adicione este bloco PHP no início do seu arquivo HTML -->
<?php
    if (!empty($erro)) {
        echo '<div class="mensagem-erro">' . $erro . '</div>';
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de login</title>
    <link rel="stylesheet" href="../css/style_login.css">
</head>
<body>
    <form action="testLogin.php" method="POST">
        <div class="main-login">
            <div class="left-login">
                <h1>Faça Login<br> E decore a sua casa</h1>
                <img src="indoor plants-rafiki (1).svg" class="left-login-image" alt="plants-rafiki">
            </div>
            <div class="right-login">
                <div class="card-login">
                    <h1>LOGIN</h1>
                    
                    <!-- Adicione este bloco PHP para exibir a mensagem de erro -->
                    <?php
                        if (!empty($erro)) {
                            echo '<div class="mensagem-erro">' . $erro . '</div>';
                        }
                    ?>
                    
                    <div class="textfield">
                        <label for="email">Email</label>
                        <input type="text" name="email" placeholder="Email" style='color:black;'>
                    </div>
                    <div class="textfield">
                        <label for="senha">Senha</label>
                        <input type="password" name="senha" placeholder="Senha" style='color:black;'>
                    </div>
                    <!-- Adicionando campo oculto para enviar o valor do botão de login -->
                
                    <button type="submit" class="btn-login">Login</button>
                    <a href="formulario_clientes.php"class="btn-login-cadastro" >Cadastro</a>
                </div>
            </div>
        </div>
    </form>
</body>
</html>
