<?php
/**
 * API - Logout de Usuario
 *
 * Descripción:
 * Este endpoint cierra la sesión del usuario autenticado,
 * eliminando todos los datos de sesión activos.
 *
 * Método HTTP:
 * POST
 *
 * URL:
 * /api/auth/logout.php
 *
 * Parámetros de entrada:
 * No recibe parámetros.
 *
 * Respuestas:
 *
 * 200 OK
 * {
 *   "status": "success",
 *   "message": "Sesión cerrada correctamente"
 * }
 */

require_once '../../system/init.php';
require_once '../../libs/Response.php';

/**
 * Destruye la sesión activa del usuario
 */
session_unset();
session_destroy();

/**
 * Respuesta exitosa
 */
Response::success('Sesión cerrada correctamente');
