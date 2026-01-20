<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
require_once 'layout/header.php';
?>

<?php require_once 'layout/header.php'; ?>

<div class="container">
    <div class="card">
        <h2>Mis Tareas</h2>

        <input type="text" id="title" placeholder="Título de la tarea">
        <textarea id="description" placeholder="Descripción"></textarea>
        <button onclick="createTask()">Agregar Tarea</button>
        <button onclick="updateTask()">Actualizar Tarea</button>    


        <div id="taskList"></div>
    </div>
</div>

<script src="../assets/js/tasks.js"></script>
<?php require_once 'layout/footer.php'; ?>
