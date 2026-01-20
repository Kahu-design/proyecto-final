<?php
/**
 * ACTUALIZAR TAREA
 * ----------------
 * Método: PUT
 */
require_once '../../system/init.php';
require_once '../../system/database.php';
require_once '../../libs/Auth.php';
require_once '../../libs/Response.php';

Auth::check();

$data = json_decode(file_get_contents("php://input"), true);

$stmt = $mysqli->prepare(
    "UPDATE tasks SET title=?, description=? WHERE id=? AND user_id=?"
);
$stmt->bind_param(
    "ssii",
    $data['title'],
    $data['description'],
    $data['id'],
    $_SESSION['user_id']
);

$stmt->execute()
    ? Response::success('Actualizada')
    : Response::error('Error', 500);
