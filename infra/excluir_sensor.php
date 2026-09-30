<?php
include 'conexao.php';
include 'auth.php';

$id_sensor = isset($_POST['id_sensor']) ? (int) $_POST['id_sensor'] : 0;

$stmt = $conexao->prepare("DELETE FROM sensores WHERE id_sensor = ?");
$stmt->bind_param("i", $id_sensor);

if ($stmt->execute()) {
    header("Location: ../private/sensores.php");
    exit;
} else {
    echo "Erro ao excluir do banco: " . $stmt->error;
}
?>