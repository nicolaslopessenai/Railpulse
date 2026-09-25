<?php
include 'conexao.php';
include 'auth.php';

$nome        = $_POST['snr_nome'];
$tipo        = $_POST['snr_tipo'];
$localizacao = $_POST['snr_localizacao'];
$status      = $_POST['snr_status'];
$descricao   = $_POST['snr_descricao'];
$id_trem     = $_POST['snr_id_trem'];
$id_rota     = $_POST['snr_id_rota'];
$id_sensor   = $_POST['snr_id_sensor'];

if ($id_sensor !== '') {
    $sql = "UPDATE sensores
            SET nome = '$nome', tipo_dado = '$tipo', localizacao = '$localizacao', status = '$status',
                descricao = '$descricao', id_trem = '$id_trem', id_rota = '$id_rota'
            WHERE id_sensor = '$id_sensor'";
} else {
    $sql = "INSERT INTO sensores (nome, tipo_dado, localizacao, status, descricao, id_trem, id_rota)
            VALUES ('$nome', '$tipo', '$localizacao', '$status', '$descricao', '$id_trem', '$id_rota')";
}

if (mysqli_query($conexao, $sql)) {
    header("Location: ../private/sensores.php");
    exit;
} else {
    echo "Erro ao cadastrar no banco: " . mysqli_error($conexao);
}
?>
