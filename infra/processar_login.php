<?php
session_start();

include '../infra/conexao.php';

$email_digitado = $_POST['email'] ?? '';
$senha_digitada = $_POST['senha'] ?? '';

$stmt = $conexao->prepare("SELECT id_usuario, nome, cargo, senha FROM usuarios WHERE email = ?");
$stmt->bind_param("s", $email_digitado);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows === 1) {
    $usuario = $result->fetch_assoc();
    $senha_armazenada = $usuario['senha'];

    if (password_verify($senha_digitada, $senha_armazenada) || $senha_digitada === $senha_armazenada) {
        $_SESSION['id'] = $usuario['id_usuario'];
        $_SESSION['nome'] = $usuario['nome'];
        $_SESSION['cargo'] = $usuario['cargo'];

        if ($usuario['cargo'] == 'admin') {
            header('Location: ../private/dashboard.php');
        } else {
            header('Location: ../public/dashboard.php');
        }
        exit;
    }
}

header('Location: ../public/login.php?erro=1');
exit;