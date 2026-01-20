<?php
/**
 * LISTAR TAREAS DEL USUARIO
 * ------------------------
 * Método: GET
 */
require_once '../../system/init.php';
require_once '../../system/database.php';
require_once '../../libs/Auth.php';
require_once '../../libs/Response.php';

Auth::check();

$stmt = $mysqli->prepare(
    "SELECT id, title, description, created_at FROM tasks WHERE user_id=?"
);
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();

$result = $stmt->get_result();
Response::success($result->fetch_all(MYSQLI_ASSOC));
