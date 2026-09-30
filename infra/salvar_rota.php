<?php
include 'conexao.php';
include 'auth.php';

$nome         = $_POST['rta_nome'] ?? '';
$origem       = $_POST['rta_origem'] ?? '';
$destino      = $_POST['rta_destino'] ?? '';
$distancia_km = (float) ($_POST['rta_distancia_km'] ?? 0);
$id_rota      = isset($_POST['rta_id_rota']) && $_POST['rta_id_rota'] !== '' ? (int) $_POST['rta_id_rota'] : null;

if ($id_rota !== null) {
    $sql = "UPDATE rotas SET nome = ?, origem = ?, destino = ?, distancia_km = ? WHERE id_rota = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("ssdsi", $nome, $origem, $destino, $distancia_km, $id_rota);
} else {
    $sql = "INSERT INTO rotas (nome, origem, destino, distancia_km) VALUES (?, ?, ?, ?)";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("sssd", $nome, $origem, $destino, $distancia_km);
}

if ($stmt->execute()) {
    header("Location: ../private/rotas.php");
    exit;
} else {
    echo "Erro ao cadastrar no banco: " . $stmt->error;
}
?>