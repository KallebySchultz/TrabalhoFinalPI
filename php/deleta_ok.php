<?php
require 'conexao.php';

$id = $_GET['id'];
$sql = "DELETE FROM clientes WHERE id = $id";

if ($conn->query($sql) === TRUE) {
    echo "Cliente deletado com sucesso!";
} else {
    echo "Erro ao deletar: " . $conn->error;
}
?>
