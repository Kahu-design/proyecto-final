<?php require_once 'layout/header.php'; ?>

<div class="container">
    <div class="card">
        <h2>Registro</h2>

        <div id="message" class="message"></div>

        <input type="text" id="name" placeholder="Nombre">
        <input type="email" id="email" placeholder="Email">
        <input type="password" id="password" placeholder="Contraseña">
        <button onclick="register()">Registrarse</button>

        <p><a href="login.php">Volver al login</a></p>
    </div>
</div>


<script src="../assets/js/auth.js"></script>
<?php require_once 'layout/footer.php'; ?>
