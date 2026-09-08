<?php
session_start();

include '../infra/conexao.php';

$email_digitado = "";
$senha_digitada = "";

if (isset($_POST['email'])) {
    $email_digitado = $_POST['email'];
}

// ...e se o formulário foi enviado com a senha
if (isset($_POST['senha'])) {
    $senha_digitada = $_POST['senha'];
}


$sql = "SELECT * FROM usuarios WHERE email = '$email_digitado'";
$query = mysqli_query($conexao, $sql);

# Verifica se retorna linhas por isso == 1, se sim, pega a senha do banco e compara com a digitada
if (mysqli_num_rows($query) == 1) {
    $usuario = mysqli_fetch_assoc($query);

    if ($senha_digitada == $usuario['senha']) {
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


?>
