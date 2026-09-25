<?php
include 'conexao.php';
include 'auth.php';

$nome      = $_POST['usr_nome'];
$email     = $_POST['usr_email'];
$senha     = $_POST['usr_senha'];
$matricula = $_POST['usr_matricula'];
$cargo     = $_POST['usr_cargo'];
$id_usuario = '';

if (isset($_POST['usr_id'])) {
    $id_usuario = $_POST['usr_id'];
}

if ($id_usuario !== '') {
    if ($senha !== '') {
        $sql = "UPDATE usuarios
                SET nome = '$nome', email = '$email', senha = '$senha', matricula = '$matricula', cargo = '$cargo'
                WHERE id_usuario = '$id_usuario'";
    } else {
        $sql = "UPDATE usuarios
                SET nome = '$nome', email = '$email', matricula = '$matricula', cargo = '$cargo'
                WHERE id_usuario = '$id_usuario'";
    }
} else {
    $sql = "INSERT INTO usuarios (nome, email, senha, matricula, cargo)
            VALUES ('$nome', '$email', '$senha', '$matricula', '$cargo')";
}

if (mysqli_query($conexao, $sql)) {
    header("Location: ../private/usuarios.php");
    exit;
} else {
    echo "Erro ao cadastrar no banco: " . mysqli_error($conexao);
}
?>