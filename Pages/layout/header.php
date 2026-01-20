<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Task Manager</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<?php
// Inicia sesión si no se ha iniciado
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<div class="navbar">
    <a href="dashboard.php">Dashboard</a>

    <?php if (isset($_SESSION['user_id'])): ?>
        <!-- Solo se muestra si hay sesión -->
        <button onclick="logout()" style="float: right;
    position: fixed;
    width: auto;
    right: 1%;">Logout</button>
    <?php endif; ?>
</div>
