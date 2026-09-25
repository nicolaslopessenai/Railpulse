<?php
include 'conexao.php';
include 'auth.php';

$nome       = $_POST['trn_nome'];
$modelo     = $_POST['trn_modelo'];
$status     = $_POST['trn_status'];
$velocidade = $_POST['trn_velocidade'];
$latitude   = $_POST['trn_latitude'];
$longitude  = $_POST['trn_longitude'];
$id_rota    = $_POST['trn_id_rota'];
$id_trem    = $_POST['trn_id_trem'];

if ($id_trem !== '') {
    $sql = "UPDATE trens
            SET nome = '$nome', modelo = '$modelo', status_operacional = '$status',
                velocidade_atual = '$velocidade', latitude = '$latitude', longitude = '$longitude',
                id_rota = '$id_rota'
            WHERE id_trem = '$id_trem'";
} else {
    $sql = "INSERT INTO trens (nome, modelo, status_operacional, velocidade_atual, latitude, longitude, id_rota)
            VALUES ('$nome', '$modelo', '$status', '$velocidade', '$latitude', '$longitude', '$id_rota')";
}

if (mysqli_query($conexao, $sql)) {
    header("Location: ../private/trens.php");
    exit;
} else {
    echo "Erro ao cadastrar no banco: " . mysqli_error($conexao);
}
?>