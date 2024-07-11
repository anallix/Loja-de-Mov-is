<?php
session_start();
include_once('../conexaodb/config.php');

// Verifica se o usuário está logado
if ((!isset($_SESSION['email']) || empty($_SESSION['email'])) && (!isset($_SESSION['senha']) || empty($_SESSION['senha']))) {
    header('Location: login.php');
    exit;
}

$logado = $_SESSION['email'];

// Processamento da pesquisa
if (!empty($_GET['search'])) {
    $data = $_GET['search'];
    $sql = "SELECT * FROM clientes WHERE nome LIKE '%$data%' ORDER BY id DESC";
} else {
    $sql = "SELECT * FROM clientes ORDER BY id DESC";
}

$result = $conexao->query($sql);
?>
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

        .navbar-nav .nav-item .nav-link {
            color: black;
            font-weight: bold;
            margin-right: 1rem;
        }

        .navbar-nav .nav-item .nav-link:hover {
            color: #ffc107;
        }

        .btn-sair {
            color: #fff;
            background-color: #dc3545;
            border-color: #dc3545;
            font-weight: bold;
        }

        .btn-sair:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }

       /* Estilos para a caixa de pesquisa */
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


        /* Estilos para a tabela */
table {
    width: 80%; /* Ajustado para ocupar mais da largura disponível */
    margin: 20px auto;
    background-color: #fff;
    border-collapse: collapse;
    border-radius: 20px;
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

.btn-editar, .btn-excluir {
    padding: 5px 10px;
    margin-right: 5px;
    color: #fff;
    text-decoration: none;
    cursor: pointer;
    border-radius: 20px; 
}

.btn-editar {
    background-color: grey;
}

.btn-excluir {
    background-color: #dc3545;
}

.btn-sair {
    padding: 10px 20px;
    background-color: rgb(254, 255, 214);
    color: black;
    text-decoration: none;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.btn-sair:hover {
    background-color: #c82333;
}

.nav-link {
    padding: 10px 20px;
    background-color: rgb(254, 255, 214);
    color: black;
    text-decoration: none;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.nav-link:hover {
    color: black;
    border-color: #007bff;
}

.box {
    width: 180px;
    padding: 15px;
    background-color: rgb(254, 255, 214);
    border: 1px solid #ccc;
    border-radius: 10px;
    text-align: center;
    margin: 0 auto;
}

h5 {
    margin: 0;
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
<br>
<div class="navbar-nav">
    <a class="nav-link" href="./produtos">Produtos</a>
</div>

<br>
<div class="box">
    <h5>ADMINISTRADOR<br><u><?php echo $logado; ?></u></h5>
</div>

<br>
<div class="box-search">
        <input type="search" class="form-control w-25" placeholder="Pesquisar" id="pesquisar">
        <button onclick="searchData()" class="btn btn-primary">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
            </svg>
        </button>
    </div>
</form>

<div class="m-5">
    <table>
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Senha</th>
                <th scope="col">Email</th>
                <th scope="col">Telefone</th>
                <th scope="col">Sexo</th>
                <th scope="col">Data de nascimento</th>
                <th scope="col">Cidade</th>
                <th scope="col">Estado</th>
                <th scope="col">Endereço</th>
                <th scope="col">Pedidos</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($user_data = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $user_data['id'] . "</td>";
                echo "<td>" . $user_data['nome'] . "</td>";
                echo "<td>" . $user_data['senha'] . "</td>";
                echo "<td>" . $user_data['email'] . "</td>";
                echo "<td>" . $user_data['telefone'] . "</td>";
                echo "<td>" . $user_data['sexo'] . "</td>";
                echo "<td>" . $user_data['data_nasc'] . "</td>";
                echo "<td>" . $user_data['cidade'] . "</td>";
                echo "<td>" . $user_data['estado'] . "</td>";
                echo "<td>" . $user_data['endereco'] . "</td>";
                echo "<td><a class='btn-editar' href='pageAdminCliente.php?id={$user_data['id']}'>Pedidos</a> </td>";
                echo "<td>
                        <a class='btn-editar' href='edit.php?id={$user_data['id']}'>Editar</a>
                        <br><br>
                        <a class='btn-excluir' href='delete.php?id={$user_data['id']}' title='Deletar'>Excluir</a>
                    </td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>
<script type="text/javascript" src="../js/script.js"></script>

</body>
</html>
