<?php
include 'conexao.php';
include 'auth.php';

$nome        = $_POST['snr_nome'];
$tipo        = $_POST['snr_tipo'];
$localizacao = $_POST['snr_localizacao'];
$status      = $_POST['snr_status'];
$descricao   = $_POST['snr_descricao'];

$sql = "INSERT INTO sensores (nome, tipo_dado, localizacao, status, descricao) 
        VALUES ('$nome', '$tipo', '$localizacao', '$status', '$descricao')";

if (mysqli_query($conexao, $sql)) {
    header("Location: ../private/sensores.php");
} else {
    echo "Erro ao cadastrar no banco: " . mysqli_error($conexao);
}
?>
