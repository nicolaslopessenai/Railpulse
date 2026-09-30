<?php
include 'conexao.php';
include 'auth.php';

$id_usuario = isset($_POST['id_usuario']) ? (int) $_POST['id_usuario'] : 0;

$stmt = $conexao->prepare("DELETE FROM usuarios WHERE id_usuario = ?");
$stmt->bind_param("i", $id_usuario);

if ($stmt->execute()) {
    header("Location: ../private/usuarios.php");
    exit;
} else {
    echo "Erro ao excluir do banco: " . $stmt->error;
}
?>