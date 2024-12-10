<?php
session_start();

// Verifica se o usuário está logado e é administrador
if (!isset($_SESSION['id']) || !isset($_SESSION['adm']) || !$_SESSION['adm']) {
    // Caso contrário, redireciona para a página de login
    header('Location: ../html/login.html');
    exit;
}

// Conexão com o banco de dados
require 'conexao.php';

// Consulta para obter os clientes
$sql = "SELECT * FROM clientes";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Lista de Clientes</title>
</head>
<body>
    <header>
        <div class="container">
            <h1>Sistema de Clientes</h1>
            <nav>
                <a href="../index.php">Home</a>
                <a href="logout.php">Logout</a>
            </nav>
        </div>
    </header>

    <main>
        <h2>Clientes Cadastrados</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Sobrenome</th>
                <th>Email</th>
                <th>Ações</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['id']); ?></td>
                    <td><?php echo htmlspecialchars($row['nome']); ?></td>
                    <td><?php echo htmlspecialchars($row['sobrenome']); ?></td> <!-- Exibe sobrenome -->
                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                    <td>
                        <a href="edita.php?id=<?php echo $row['id']; ?>">Editar</a>
                        <a href="deleta_ok.php?id=<?php echo $row['id']; ?>">Deletar</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    </main>

    <footer>
        <div class="container">
        <p> Trabalho final de Programação para internet - Kalleby Schultz</p>
        </div>
    </footer>
</body>
</html>
