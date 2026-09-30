<?php
include 'conexao.php';
include 'auth.php';

$id_trem = isset($_POST['id_trem']) ? (int) $_POST['id_trem'] : 0;

$stmt = $conexao->prepare("DELETE FROM trens WHERE id_trem = ?");
$stmt->bind_param("i", $id_trem);

if ($stmt->execute()) {
    header("Location: ../private/trens.php");
    exit;
} else {
    echo "Erro ao excluir do banco: " . $stmt->error;
}
?>