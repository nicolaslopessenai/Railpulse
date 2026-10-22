<?php
session_start();

if (!isset($_SESSION['id'])) {
    header('Location: ../public/login.php');
    exit;
}

$script_path = $_SERVER['SCRIPT_NAME'] ?? '';
$is_admin_area = strpos($script_path, '/private/') !== false || strpos($script_path, '/infra/') !== false;

if ($is_admin_area && (!isset($_SESSION['cargo']) || $_SESSION['cargo'] !== 'admin')) {
    header('Location: ../public/dashboard.php');
    exit;
}

?>
