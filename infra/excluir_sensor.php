<?php
include 'conexao.php';
include 'auth.php';

$id_sensor = (int) $_POST['id_sensor'];

$sql = "DELETE FROM sensores WHERE id_sensor = $id_sensor";

if (mysqli_query($conexao, $sql)) {
    header("Location: ../private/sensores.php");
    exit;
} else {
    echo "Erro ao excluir do banco: " . mysqli_error($conexao);
}
?>