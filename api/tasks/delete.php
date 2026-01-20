<?php
/**
 * ELIMINAR TAREA
 * --------------
 * Método: DELETE
 */
require_once '../../system/init.php';
require_once '../../system/database.php';
require_once '../../libs/Auth.php';
require_once '../../libs/Response.php';

Auth::check();

$data = json_decode(file_get_contents("php://input"), true);

$stmt = $mysqli->prepare(
    "DELETE FROM tasks WHERE id=? AND user_id=?"
);
$stmt->bind_param("ii", $data['id'], $_SESSION['user_id']);

$stmt->execute()
    ? Response::success('Eliminada')
    : Response::error('Error', 500);
