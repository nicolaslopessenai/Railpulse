<?php
include 'conexao.php';
include 'auth.php';

$id_trem = isset($_POST['id_trem']) ? (int) $_POST['id_trem'] : 0;

if ($id_trem <= 0) {
    header("Location: ../private/trens.php?erro=em_uso");
    exit;
}

$verifica = $conexao->prepare("SELECT COUNT(*) FROM sensores WHERE id_trem = ?");
$verifica->bind_param("i", $id_trem);
$verifica->execute();
$verifica->bind_result($total_vinculos);
$verifica->fetch();
$verifica->close();

if ($total_vinculos > 0) {
    header("Location: ../private/trens.php?erro=em_uso");
    exit;
}

$stmt = $conexao->prepare("DELETE FROM trens WHERE id_trem = ?");
$stmt->bind_param("i", $id_trem);

if ($stmt->execute()) {
    header("Location: ../private/trens.php");
    exit;
} else {
    echo "Erro ao excluir do banco: " . $stmt->error;
}
?>