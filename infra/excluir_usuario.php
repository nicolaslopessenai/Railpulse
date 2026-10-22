<?php
include 'conexao.php';
include 'auth.php';

$id_usuario = isset($_POST['id_usuario']) ? (int) $_POST['id_usuario'] : 0;

if ($id_usuario <= 0) {
    header("Location: ../private/usuarios.php?erro=em_uso");
    exit;
}

$verifica = $conexao->prepare("SELECT COUNT(*) FROM trens WHERE id_usuario = ?");
$verifica->bind_param("i", $id_usuario);
$verifica->execute();
$verifica->bind_result($total_vinculos);
$verifica->fetch();
$verifica->close();

if ($total_vinculos > 0) {
    header("Location: ../private/usuarios.php?erro=em_uso");
    exit;
}

$stmt = $conexao->prepare("DELETE FROM usuarios WHERE id_usuario = ?");
$stmt->bind_param("i", $id_usuario);

if ($stmt->execute()) {
    header("Location: ../private/usuarios.php");
    exit;
} else {
    echo "Erro ao excluir do banco: " . $stmt->error;
}
?>