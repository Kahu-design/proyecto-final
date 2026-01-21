<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header('Location: dashboard.php');
    exit;
}
require_once 'layout/header.php';
?>


<?php require_once 'layout/header.php'; ?>

<div class="container">
    <div class="card">
        <h2>Iniciar Sesión</h2>

        <div id="message" class="message"></div>

        <input type="email" id="email" placeholder="Email">
        <input type="password" id="password" placeholder="Contraseña">
        <button onclick="login()">Ingresar</button>

        <p>¿No tienes cuenta? <a href="register.php">Registrarse</a></p>
    </div>
</div>


<script src="../assets/js/auth.js"></script>
<?php require_once 'layout/footer.php'; ?>
