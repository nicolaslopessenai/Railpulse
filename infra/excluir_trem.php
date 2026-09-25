<?php
include 'conexao.php';
include 'auth.php';

$id_trem = (int) $_POST['id_trem'];

$sql = "DELETE FROM trens WHERE id_trem = $id_trem";

if (mysqli_query($conexao, $sql)) {
    header("Location: ../private/trens.php");
    exit;
} else {
    echo "Erro ao excluir do banco: " . mysqli_error($conexao);
}
?>