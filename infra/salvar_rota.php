<?php
include 'conexao.php';
include 'auth.php';

$nome         = $_POST['rta_nome'];
$origem       = $_POST['rta_origem'];
$destino      = $_POST['rta_destino'];
$distancia_km = $_POST['rta_distancia_km'];

$sql = "INSERT INTO rotas (nome, origem, destino, distancia_km)
        VALUES ('$nome', '$origem', '$destino', '$distancia_km')";

if (mysqli_query($conexao, $sql)) {
    header("Location: ../private/rotas.php");
} else {
    echo "Erro ao cadastrar no banco: " . mysqli_error($conexao);
}
?>