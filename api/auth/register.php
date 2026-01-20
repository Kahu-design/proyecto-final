<?php
/**
 * REGISTRO DE USUARIO
 * Método: POST
 * Retorna: JSON
 */
require_once '../../system/init.php';
require_once '../../system/database.php';
require_once '../../libs/Response.php';
require_once '../../libs/Validator.php';

/* Leer JSON de forma segura */
$raw = file_get_contents("php://input");
$data = json_decode($raw, true);

/* Validar que el JSON sea válido */
if (!$data) {
    Response::error('JSON inválido', 400);
}

/* Validaciones seguras */
$name     = $data['name']     ?? '';
$email    = $data['email']    ?? '';
$password = $data['password'] ?? '';

if (
    !Validator::required($name) ||
    !Validator::email($email) ||
    !Validator::minLength($password, 6)
) {
    Response::error('Datos inválidos', 400);
}

$passwordHash = password_hash($password, PASSWORD_DEFAULT);

/* Insertar usuario */
$stmt = $mysqli->prepare(
    "INSERT INTO users (name, email, password) VALUES (?, ?, ?)"
);

if (!$stmt) {
    Response::error('Error en la consulta', 500);
}

$stmt->bind_param("sss", $name, $email, $passwordHash);

if ($stmt->execute()) {
    Response::success('Usuario registrado correctamente', 201);
}

/* Email duplicado */
Response::error('El email ya existe', 400);
