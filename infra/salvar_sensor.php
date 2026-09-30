<?php
include 'conexao.php';
include 'auth.php';

$nome        = $_POST['snr_nome'] ?? '';
$tipo        = $_POST['snr_tipo'] ?? '';
$localizacao = $_POST['snr_localizacao'] ?? '';
$status      = $_POST['snr_status'] ?? '';
$descricao   = $_POST['snr_descricao'] ?? '';
$id_trem     = isset($_POST['snr_id_trem']) && $_POST['snr_id_trem'] !== '' ? (int) $_POST['snr_id_trem'] : 0;
$id_rota     = isset($_POST['snr_id_rota']) && $_POST['snr_id_rota'] !== '' ? (int) $_POST['snr_id_rota'] : 0;
$id_sensor   = isset($_POST['snr_id_sensor']) && $_POST['snr_id_sensor'] !== '' ? (int) $_POST['snr_id_sensor'] : null;

if ($id_sensor !== null) {
    $sql = "UPDATE sensores SET nome = ?, tipo_dado = ?, localizacao = ?, status = ?, descricao = ?, id_trem = ?, id_rota = ? WHERE id_sensor = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("sssssiii", $nome, $tipo, $localizacao, $status, $descricao, $id_trem, $id_rota, $id_sensor);
} else {
    $sql = "INSERT INTO sensores (nome, tipo_dado, localizacao, status, descricao, id_trem, id_rota) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("sssssii", $nome, $tipo, $localizacao, $status, $descricao, $id_trem, $id_rota);
}

if ($stmt->execute()) {
    header("Location: ../private/sensores.php");
    exit;
} else {
    echo "Erro ao cadastrar no banco: " . $stmt->error;
}
?>