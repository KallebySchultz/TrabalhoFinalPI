<?php
session_start();
require 'conexao.php';

// Verifica se os dados do formulário foram enviados
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $sobrenome = $_POST['sobrenome'];
    $email = $_POST['email'];

    // Consulta no banco de dados para verificar se o nome, sobrenome e e-mail correspondem
    $sql = "SELECT senha FROM clientes WHERE nome = '$nome' AND sobrenome = '$sobrenome' AND email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Se o usuário for encontrado, exibe a senha
        $user = $result->fetch_assoc();
        $senha = $user['senha'];  // Senha encontrada no banco
        echo "
        <!DOCTYPE html>
        <html lang='pt-br'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <link rel='stylesheet' href='../css/style.css'>
            <title>Senha Recuperada</title>
        </head>
        <body>
            <header>
                <div class='container'>
                    <h1>Recuperação de Senha</h1>
                    <nav>
                        <a href='../index.php'>Home</a>
                        <a href='../html/login.html'>Login</a>
                    </nav>
                </div>
            </header>
            <main>
                <div class='recuperar-senha'>
                    <h2>Sua Senha foi Recuperada</h2>
                    <p><strong>Senha:</strong> " . htmlspecialchars($senha) . "</p>
                </div>
            </main>
            <footer>
                <div class='container'>
                     <p> Trabalho final de Programação para internet - Kalleby Schultz</p>
                </div>
            </footer>
        </body>
        </html>";
    } else {
        echo "
        <!DOCTYPE html>
        <html lang='pt-br'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <link rel='stylesheet' href='../css/style.css'>
            <title>Erro na Recuperação</title>
        </head>
        <body>
            <header>
                <div class='container'>
                    <h1>Recuperação de Senha</h1>
                    <nav>
                        <a href='../html/index.php'>Home</a>
                        <a href='../html/login.html'>Login</a>
                    </nav>
                </div>
            </header>
            <main>
                <div class='erro-recuperacao'>
                    <h2>Erro ao Recuperar Senha</h2>
                    <p>Usuário não encontrado. Verifique as informações fornecidas.</p>
                    <a href='../html/recuperar_senha.html' class='btn-voltar'>Tentar Novamente</a>
                </div>
            </main>
            <footer>
                <div class='container'>
                     <p> Trabalho final de Programação para internet - Kalleby Schultz</p>
                </div>
            </footer>
        </body>
        </html>";
    }
} else {
    echo "<p>Método inválido.</p>";
}
?>
