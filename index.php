<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Home</title>
</head>
<body>
    <header>
        <div class="container">
            <h1>Sistema de Clientes</h1>
            <nav>
                <a href="index.php">Home</a>
                <a href="html/cadastro.html">Cadastro</a>
                <?php if (isset($_SESSION['adm']) && $_SESSION['adm']): ?>
                    <a href="php/lista_clientes.php">Editar Clientes</a>
                <?php endif; ?>
                <?php if (isset($_SESSION['id'])): ?>
                    <a href="php/logout.php">Logout</a>
                <?php else: ?>
                    <a href="html/login.html">Login</a>
                <?php endif; ?>
            </nav>
        </div>
    </header>
    <main>
        <?php if (isset($_SESSION['nome'])): ?>
            <h2>Bem-vindo, <?php echo htmlspecialchars($_SESSION['nome']); ?>!</h2>
        <?php else: ?>
            <h2>Bem-vindo ao nosso sistema!
                Faça login para continuar.
            </h2>
           
        <?php endif; ?>

        <!-- Iframe centralizado -->
        <div class="iframe-container">
            <iframe src="html/iframe-content.html" frameborder="0" style="width: 100%; height: 500px; overflow: hidden;" scrolling="no"></iframe>

        </div>
    </main>
    <footer>
        <div class="container">
            <p>Trabalho final de Programação para Internet - Kalleby Schultz</p>
        </div>
    </footer>
</body>
</html>
