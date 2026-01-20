<?php
/**
 * CREAR TAREA
 * -----------
 * Método: POST
 */
require_once '../../system/init.php';
require_once '../../system/database.php';
require_once '../../libs/Auth.php';
require_once '../../libs/Response.php';
require_once '../../libs/Validator.php';

Auth::check();

$data = json_decode(file_get_contents("php://input"), true);

if (!Validator::required($data['title'])) {
    Response::error('Título obligatorio', 400);
}

$stmt = $mysqli->prepare(
    "INSERT INTO tasks (user_id, title, description) VALUES (?, ?, ?)"
);
$stmt->bind_param(
    "iss",
    $_SESSION['user_id'],
    $data['title'],
    $data['description']
);

$stmt->execute()
    ? Response::success('Tarea creada', 201)
    : Response::error('Error al crear', 500);
