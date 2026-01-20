<?php
/**
 * Control de autenticación
 */
class Auth {

    public static function check() {
        if (!isset($_SESSION['user_id'])) {
            http_response_code(403);
            echo json_encode(['error' => 'Acceso no autorizado']);
            exit;
        }
    }
}
