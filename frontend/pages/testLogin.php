<?php
session_start();

if(isset($_POST['email']) && isset($_POST['senha'])) {
    include_once('../conexaodb/config.php');
    
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Consulta ao banco de dados para verificar se o e-mail fornecido está na tabela de administradores
    $sql = "SELECT * FROM administradores WHERE email = '$email'";
    $result = $conexao->query($sql);
    
    if(!$result) {
        // Se houver um erro na consulta SQL
        echo "Erro na consulta SQL: " . $conexao->error;
        exit; // Encerra o script para evitar mais execução
    }

    if($result->num_rows > 0){
        // Se o e-mail fornecido está na tabela de administradores, redirecione para a página de administração
        $_SESSION['email'] = $email;
        $_SESSION['senha'] = $senha;
        header('Location: pageAdmin.php');
        exit(); // Encerre o script após o redirecionamento
    }

    // Se o e-mail não estiver na tabela de administradores, continue com a verificação normal de login
    $sql = "SELECT * FROM clientes WHERE email = '$email' and senha = '$senha'";
    $result = $conexao->query($sql);
    
    if(!$result) {
        // Se houver um erro na consulta SQL
        echo "Erro na consulta SQL: " . $conexao->error;
        exit; // Encerra o script para evitar mais execução
    }

    if(mysqli_num_rows($result) < 1){
        // Se não houver nenhum cliente encontrado, exibir uma mensagem de erro
        $erro = "Email ou senha incorretos. Por favor, tente novamente.";
    } else {
        // Se o cliente for um usuário normal, redireciona para a página do usuário normal
        $_SESSION['email'] = $email;
        $_SESSION['senha'] = $senha;
        header('Location: pageUsuario.php');
        exit(); // Encerre o script após o redirecionamento
    }
} else {
    // Se os campos de email e senha não estiverem preenchidos
    $erro = "Por favor, preencha todos os campos.";
}

// Aqui estamos verificando se há uma mensagem de erro para exibir
if (isset($erro)) {
    echo "<script>alert('$erro');</script>"; // Exibindo a mensagem de erro em um alerta JavaScript
    // Redirecionando de volta para a página de login
    echo "<script>window.location.href = 'login.php';</script>";
}
?>
