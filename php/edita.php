<?php
session_start();
require 'conexao.php';

// Verifica se o usuário tem permissão (se é administrador)
if (!isset($_SESSION['adm']) || !$_SESSION['adm']) {
    echo "<p>Você não tem permissão para acessar esta página.</p>";
    exit;
}

// Verifica se o ID do cliente foi passado
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "SELECT nome, sobrenome, email, senha FROM clientes WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $cliente = $result->fetch_assoc();
    } else {
        echo "<p>Cliente não encontrado.</p>";
        exit;
    }
} else {
    echo "<p>ID do cliente não fornecido.</p>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Editar Cliente</title>
</head>
<body>
    <header>
        <div class="container">
            <h1>Sistema de Clientes</h1>
            <nav>
                <a href="../index.php">Home</a>
                <?php if (isset($_SESSION['adm']) && $_SESSION['adm']): ?>
                    <a href="lista_clientes.php">Editar Clientes</a>
                <?php endif; ?>
                <a href="../php/logout.php">Logout</a>
            </nav>
        </div>
    </header>
    <main>
        <h2>Editar Dados do Cliente</h2>
        <form action="edita_ok.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            
            <!-- Campo para o Nome -->
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" value="<?php echo $cliente['nome']; ?>" required>
            
            <!-- Campo para o Sobrenome -->
            <label for="sobrenome">Sobrenome:</label>
            <input type="text" id="sobrenome" name="sobrenome" value="<?php echo $cliente['sobrenome']; ?>" required>
            
            <!-- Campo para o E-mail -->
            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" value="<?php echo $cliente['email']; ?>" required>
            
            <!-- Campo para a Senha -->
            <label for="senha">Nova Senha:</label>
            <input type="password" id="senha" name="senha">
            
            <button type="submit">Salvar Alterações</button>
        </form>
    </main>
    <footer>
        <div class="container">
            <p>&copy; 2024 Sistema de Clientes. Todos os direitos reservados.</p>
        </div>
    </footer>
</body>
</html>
