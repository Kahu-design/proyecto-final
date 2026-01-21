<?php
/**
 * API - Login de Usuario
 *
 * Descripción:
 * Este endpoint permite autenticar a un usuario mediante su correo electrónico
 * y contraseña. Si las credenciales son correctas, se crea una sesión de usuario.
 *
 * Método HTTP:
 * POST
 *
 * URL:
 * /api/auth/login.php
 *
 * Parámetros de entrada (JSON):
 * {
 *   "email": "string",    // Correo electrónico del usuario (obligatorio)
 *   "password": "string" // Contraseña del usuario (obligatoria)
 * }
 *
 * Respuestas:
 *
 * 200 OK
 * {
 *   "status": "success",
 *   "message": "Login correcto"
 * }
 *
 * 400 Bad Request
 * {
 *   "status": "error",
 *   "message": "JSON inválido" | "Datos inválidos"
 * }
 *
 * 401 Unauthorized
 * {
 *   "status": "error",
 *   "message": "Credenciales incorrectas"
 * }
 */

require_once '../../system/init.php';
require_once '../../system/database.php';
require_once '../../libs/Response.php';
require_once '../../libs/Validator.php';

/**
 * Obtiene los datos enviados en formato JSON
 */
$data = json_decode(file_get_contents("php://input"), true);

if (!$data) {
    Response::error('JSON inválido', 400);
}

/**
 * Parámetros recibidos
 */
$email    = $data['email']    ?? '';
$password = $data['password'] ?? '';

/**
 * Validación de datos
 */
if (
    !Validator::email($email) ||
    !Validator::required($password)
) {
    Response::error('Datos inválidos', 400);
}

/**
 * Consulta del usuario por email
 */
$stmt = $mysqli->prepare(
    "SELECT id, name, password FROM users WHERE email = ?"
);
$stmt->bind_param("s", $email);
$stmt->execute();

$user = $stmt->get_result()->fetch_assoc();

/**
 * Verificación de credenciales
 */
if (!$user || !password_verify($password, $user['password'])) {
    Response::error('Credenciales incorrectas', 401);
}

/**
 * Creación de sesión
 */
$_SESSION['user_id']   = $user['id'];
$_SESSION['user_name'] = $user['name'];

/**
 * Respuesta exitosa
 */
Response::success('Login correcto');
