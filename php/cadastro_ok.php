<?php
require 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $sobrenome = $_POST['sobrenome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "INSERT INTO clientes (nome, sobrenome, email, senha) VALUES ('$nome', '$sobrenome', '$email', '$senha')";

    if ($conn->query($sql) === TRUE) {
        echo "<h1>Cadastro realizado com sucesso!</h1>";
        echo "<p><a href='../html/login.html'>Clique aqui para fazer login</a></p>";
    } else {
        echo "Erro ao cadastrar: " . $conn->error;
    }
}
?>
