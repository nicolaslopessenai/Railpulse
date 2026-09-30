<?php
include 'conexao.php';
include 'auth.php';

$nome       = $_POST['usr_nome'] ?? '';
$email      = $_POST['usr_email'] ?? '';
$senha      = $_POST['usr_senha'] ?? '';
$matricula  = $_POST['usr_matricula'] ?? '';
$cargo      = $_POST['usr_cargo'] ?? '';
$id_usuario = isset($_POST['usr_id']) && $_POST['usr_id'] !== '' ? (int) $_POST['usr_id'] : null;

if ($id_usuario !== null) {
    if ($senha !== '') {
        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
        $sql = "UPDATE usuarios SET nome = ?, email = ?, senha = ?, matricula = ?, cargo = ? WHERE id_usuario = ?";
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param("sssssi", $nome, $email, $senha_hash, $matricula, $cargo, $id_usuario);
    } else {
        $sql = "UPDATE usuarios SET nome = ?, email = ?, matricula = ?, cargo = ? WHERE id_usuario = ?";
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param("ssssi", $nome, $email, $matricula, $cargo, $id_usuario);
    }
} else {
    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
    $sql = "INSERT INTO usuarios (nome, email, senha, matricula, cargo) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("sssss", $nome, $email, $senha_hash, $matricula, $cargo);
}

if ($stmt->execute()) {
    header("Location: ../private/usuarios.php");
    exit;
} else {
    echo "Erro ao cadastrar no banco: " . $stmt->error;
}
?>