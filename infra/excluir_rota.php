<?php
include 'conexao.php';
include 'auth.php';

$id_rota = isset($_POST['id_rota']) ? (int) $_POST['id_rota'] : 0;

try {
    $stmt = $conexao->prepare("DELETE FROM rotas WHERE id_rota = ?");
    $stmt->bind_param("i", $id_rota);
    $stmt->execute();

    header("Location: ../private/rotas.php");
    exit;
} catch (mysqli_sql_exception $erro) {
    header("Location: ../private/rotas.php?erro=em_uso");
    exit;
}
?>