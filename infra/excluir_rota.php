<?php
include 'conexao.php';
include 'auth.php';

$id_rota = (int) $_POST['id_rota'];

try {
    $sql = "DELETE FROM rotas WHERE id_rota = $id_rota";
    mysqli_query($conexao, $sql);
    header("Location: ../private/rotas.php");
    exit;
} catch (mysqli_sql_exception $erro) {
    header("Location: ../private/rotas.php?erro=em_uso");
    exit;
}
?>