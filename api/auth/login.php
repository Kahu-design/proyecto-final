<?php
/**
 * LOGIN DE USUARIO
 * Método: POST
 */
require_once '../../system/init.php';
require_once '../../system/database.php';
require_once '../../libs/Response.php';
require_once '../../libs/Validator.php';

$data = json_decode(file_get_contents("php://input"), true);

if (!$data) {
    Response::error('JSON inválido', 400);
}

$email    = $data['email']    ?? '';
$password = $data['password'] ?? '';

if (
    !Validator::email($email) ||
    !Validator::required($password)
) {
    Response::error('Datos inválidos', 400);
}

$stmt = $mysqli->prepare(
    "SELECT id, name, password FROM users WHERE email = ?"
);
$stmt->bind_param("s", $email);
$stmt->execute();

$user = $stmt->get_result()->fetch_assoc();

if (!$user || !password_verify($password, $user['password'])) {
    Response::error('Credenciales incorrectas', 401);
}

/* Crear sesión */
$_SESSION['user_id']   = $user['id'];
$_SESSION['user_name'] = $user['name'];

Response::success('Login correcto');
