<?php
include 'conexao.php';
include 'auth.php';

$id_rota = isset($_POST['id_rota']) ? (int) $_POST['id_rota'] : 0;

if ($id_rota <= 0) {
    header("Location: ../private/rotas.php?erro=em_uso");
    exit;
}

$verifica_trens = $conexao->prepare("SELECT COUNT(*) FROM trens WHERE id_rota = ?");
$verifica_trens->bind_param("i", $id_rota);
$verifica_trens->execute();
$verifica_trens->bind_result($total_trens);
$verifica_trens->fetch();
$verifica_trens->close();

$verifica_sensores = $conexao->prepare("SELECT COUNT(*) FROM sensores WHERE id_rota = ?");
$verifica_sensores->bind_param("i", $id_rota);
$verifica_sensores->execute();
$verifica_sensores->bind_result($total_sensores);
$verifica_sensores->fetch();
$verifica_sensores->close();

if ($total_trens > 0 || $total_sensores > 0) {
    header("Location: ../private/rotas.php?erro=em_uso");
    exit;
}

$stmt = $conexao->prepare("DELETE FROM rotas WHERE id_rota = ?");
$stmt->bind_param("i", $id_rota);

if ($stmt->execute()) {
    header("Location: ../private/rotas.php");
    exit;
} else {
    echo "Erro ao excluir do banco: " . $stmt->error;
}
?>