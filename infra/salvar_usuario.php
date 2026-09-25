<?php
include 'conexao.php';
include 'auth.php';

$nome      = $_POST['usr_nome'];
$email     = $_POST['usr_email'];
$senha     = $_POST['usr_senha'];
$matricula = $_POST['usr_matricula'];
$cargo     = $_POST['usr_cargo'];

$sql = "INSERT INTO usuarios (nome, email, senha, matricula, cargo)
        VALUES ('$nome', '$email', '$senha', '$matricula', '$cargo')";

if (mysqli_query($conexao, $sql)) {
    header("Location: ../private/usuarios.php");
} else {
    echo "Erro ao cadastrar no banco: " . mysqli_error($conexao);
}
?>