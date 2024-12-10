<?php
session_start();
require 'conexao.php'; // Conexão com o banco de dados

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Prevenir SQL Injection (recomenda-se usar prepared statements em vez disso, mas para simplicidade, vamos seguir assim)
    $sql = "SELECT * FROM clientes WHERE email = '$email' AND senha = '$senha'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        // Armazenar os dados do usuário na sessão
        $_SESSION['id'] = $user['id'];
        $_SESSION['nome'] = $user['nome'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['adm'] = $user['adm']; // Variável para identificar se é administrador

        // Se for administrador, redireciona para a página inicial com as opções de admin
        if ($_SESSION['adm']) {
            header('Location: ../index.php');
        } else {
            header('Location: ../index.php'); // Redireciona para a página inicial para usuários comuns
        }
        exit;
    } else {
        // Se não encontrar o usuário ou senha, exibe uma mensagem
        echo "<p>Usuário ou senha inválidos.</p>";
        echo "<a href='../html/login.html'>Voltar ao login</a>";
    }
} else {
    echo "<p>Método inválido.</p>";
}
?>
