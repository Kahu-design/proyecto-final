<?php
/**
 * API - Registro de Usuario
 *
 * Descripción:
 * Este endpoint permite registrar un nuevo usuario en el sistema.
 * Valida los datos recibidos y almacena la contraseña de forma segura
 * utilizando hash.
 *
 * Método HTTP:
 * POST
 *
 * URL:
 * /api/auth/register.php
 *
 * Parámetros de entrada (JSON):
 * {
 *   "name": "string",     // Nombre del usuario (obligatorio)
 *   "email": "string",    // Correo electrónico válido (obligatorio)
 *   "password": "string" // Contraseña (mínimo 6 caracteres, obligatoria)
 * }
 *
 * Respuestas:
 *
 * 201 Created
 * {
 *   "status": "success",
 *   "message": "Usuario registrado correctamente"
 * }
 *
 * 400 Bad Request
 * {
 *   "status": "error",
 *   "message": "JSON inválido" | "Datos inválidos" | "El email ya existe"
 * }
 *
 * 500 Internal Server Error
 * {
 *   "status": "error",
 *   "message": "Error en la consulta"
 * }
 */

require_once '../../system/init.php';
require_once '../../system/database.php';
require_once '../../libs/Response.php';
require_once '../../libs/Validator.php';

/**
 * Lectura segura del cuerpo de la petición (JSON)
 */
$raw = file_get_contents("php://input");
$data = json_decode($raw, true);

/**
 * Validación del JSON
 */
if (!$data) {
    Response::error('JSON inválido', 400);
}

/**
 * Parámetros recibidos
 */
$name     = $data['name']     ?? '';
$email    = $data['email']    ?? '';
$password = $data['password'] ?? '';

/**
 * Validación de datos
 */
if (
    !Validator::required($name) ||
    !Validator::email($email) ||
    !Validator::minLength($password, 6)
) {
    Response::error('Datos inválidos', 400);
}

/**
 * Encriptación segura de la contraseña
 */
$passwordHash = password_hash($password, PASSWORD_DEFAULT);

/**
 * Inserción del usuario en la base de datos
 */
$stmt = $mysqli->prepare(
    "INSERT INTO users (name, email, password) VALUES (?, ?, ?)"
);

if (!$stmt) {
    Response::error('Error en la consulta', 500);
}

$stmt->bind_param("sss", $name, $email, $passwordHash);

/**
 * Ejecución de la consulta
 */
if ($stmt->execute()) {
    Response::success('Usuario registrado correctamente', 201);
}

/**
 * Error por email duplicado
 */
Response::error('El email ya existe', 400);
