<?php
include 'conexao.php';
include 'auth.php';

$id_usuario = (int) $_POST['id_usuario'];

$sql = "DELETE FROM usuarios WHERE id_usuario = $id_usuario";

if (mysqli_query($conexao, $sql)) {
    header("Location: ../private/usuarios.php");
    exit;
} else {
    echo "Erro ao excluir do banco: " . mysqli_error($conexao);
}
?>