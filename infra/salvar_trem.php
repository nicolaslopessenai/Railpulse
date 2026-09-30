<?php
include 'conexao.php';
include 'auth.php';

$nome       = $_POST['trn_nome'] ?? '';
$modelo     = $_POST['trn_modelo'] ?? '';
$status     = $_POST['trn_status'] ?? '';
$velocidade = (float) ($_POST['trn_velocidade'] ?? 0);
$latitude   = (float) ($_POST['trn_latitude'] ?? 0);
$longitude  = (float) ($_POST['trn_longitude'] ?? 0);
$id_rota    = isset($_POST['trn_id_rota']) && $_POST['trn_id_rota'] !== '' ? (int) $_POST['trn_id_rota'] : 0;
$id_trem    = isset($_POST['trn_id_trem']) && $_POST['trn_id_trem'] !== '' ? (int) $_POST['trn_id_trem'] : null;

if ($id_trem !== null) {
    $sql = "UPDATE trens SET nome = ?, modelo = ?, status_operacional = ?, velocidade_atual = ?, latitude = ?, longitude = ?, id_rota = ? WHERE id_trem = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("sssdddii", $nome, $modelo, $status, $velocidade, $latitude, $longitude, $id_rota, $id_trem);
} else {
    $sql = "INSERT INTO trens (nome, modelo, status_operacional, velocidade_atual, latitude, longitude, id_rota) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("sssdddi", $nome, $modelo, $status, $velocidade, $latitude, $longitude, $id_rota);
}

if ($stmt->execute()) {
    header("Location: ../private/trens.php");
    exit;
} else {
    echo "Erro ao cadastrar no banco: " . $stmt->error;
}
?>