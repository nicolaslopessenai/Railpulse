<?php
include 'conexao.php';
include 'auth.php';

$nome       = $_POST['trn_nome'];
$modelo     = $_POST['trn_modelo'];
$status     = $_POST['trn_status'];
$velocidade = $_POST['trn_velocidade'] === '' ? 'NULL' : "'" . $_POST['trn_velocidade'] . "'";
$latitude   = $_POST['trn_latitude'] === '' ? 'NULL' : "'" . $_POST['trn_latitude'] . "'";
$longitude  = $_POST['trn_longitude'] === '' ? 'NULL' : "'" . $_POST['trn_longitude'] . "'";
$id_rota    = $_POST['trn_id_rota'];

$sql = "INSERT INTO trens (nome, modelo, status_operacional, velocidade_atual, latitude, longitude, id_rota)
        VALUES ('$nome', '$modelo', '$status', $velocidade, $latitude, $longitude, '$id_rota')";

if (mysqli_query($conexao, $sql)) {
    header("Location: ../private/trens.php");
} else {
    echo "Erro ao cadastrar no banco: " . mysqli_error($conexao);
}
?>