<?php
session_start();
require 'conexao.php';

// Verifica se o usuário está logado e é administrador
if (!isset($_SESSION['adm']) || !$_SESSION['adm']) {
    echo "<p>Você não tem permissão para acessar esta página.</p>";
    exit;
}

// Verifica se o ID do cliente foi enviado e se todos os dados foram fornecidos
if (isset($_POST['id']) && isset($_POST['nome']) && isset($_POST['sobrenome']) && isset($_POST['email'])) {
    $id = intval($_POST['id']);
    $nome = $conn->real_escape_string($_POST['nome']);
    $sobrenome = $conn->real_escape_string($_POST['sobrenome']);
    $email = $conn->real_escape_string($_POST['email']);
    $senha = $_POST['senha'] ? $conn->real_escape_string($_POST['senha']) : null;

    // Se a senha for fornecida, a atualiza. Caso contrário, mantém a original.
    if ($senha) {
        $senhaQuery = ", senha = '$senha'";
    } else {
        $senhaQuery = "";
    }

    // Atualiza os dados do cliente no banco
    $sql = "UPDATE clientes SET nome = '$nome', sobrenome = '$sobrenome', email = '$email' $senhaQuery WHERE id = $id";
    
    if ($conn->query($sql) === TRUE) {
        echo "<p>Dados do cliente atualizados com sucesso!</p>";
        echo "<a href='lista_clientes.php'>Voltar para a lista de clientes</a>";
    } else {
        echo "<p>Erro ao atualizar dados: " . $conn->error . "</p>";
        echo "<a href='lista_clientes.php'>Voltar para a lista de clientes</a>";
    }
} else {
    echo "<p>Dados incompletos. Tente novamente.</p>";
    echo "<a href='lista_clientes.php'>Voltar para a lista de clientes</a>";
}
?>
