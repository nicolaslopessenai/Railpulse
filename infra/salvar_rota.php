<?php
include 'conexao.php';
include 'auth.php';

$nome         = trim((string) ($_POST['rta_nome'] ?? $_POST['rota_nome'] ?? ''));
$origem       = trim((string) ($_POST['rta_origem'] ?? $_POST['rota_origem'] ?? ''));
$destino      = trim((string) ($_POST['rta_destino'] ?? $_POST['rota_destino'] ?? ''));
$distancia_km = (float) ($_POST['rta_distancia_km'] ?? $_POST['rota_distancia_km'] ?? 0);
$id_rota      = isset($_POST['rta_id_rota']) && $_POST['rta_id_rota'] !== '' ? (int) $_POST['rta_id_rota'] : (isset($_POST['rota_id_rota']) && $_POST['rota_id_rota'] !== '' ? (int) $_POST['rota_id_rota'] : null);
$id_trem      = isset($_POST['rta_id_trem']) && $_POST['rta_id_trem'] !== '' ? (int) $_POST['rta_id_trem'] : (isset($_POST['rota_id_trem']) && $_POST['rota_id_trem'] !== '' ? (int) $_POST['rota_id_trem'] : 0);

if ($id_rota !== null) {
    $sql = "UPDATE rotas SET nome = ?, origem = ?, destino = ?, distancia_km = ? WHERE id_rota = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("ssdsi", $nome, $origem, $destino, $distancia_km, $id_rota);
    $stmt->execute();
    $rota_id = $id_rota;
} else {
    $sql = "INSERT INTO rotas (nome, origem, destino, distancia_km) VALUES (?, ?, ?, ?)";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("sssd", $nome, $origem, $destino, $distancia_km);
    $stmt->execute();
    $rota_id = $conexao->insert_id;
}

if ($rota_id > 0) {
    $limpar_vinculos = $conexao->prepare("DELETE FROM rota_trem WHERE id_rota = ?");
    $limpar_vinculos->bind_param("i", $rota_id);
    $limpar_vinculos->execute();

    if ($id_trem > 0) {
        $vinculo = $conexao->prepare("INSERT INTO rota_trem (id_rota, id_trem) VALUES (?, ?) ON DUPLICATE KEY UPDATE id_rota_trem = id_rota_trem");
        $vinculo->bind_param("ii", $rota_id, $id_trem);
        $vinculo->execute();
    }
}

header("Location: ../private/rotas.php");
exit;
