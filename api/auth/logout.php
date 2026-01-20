<?php
/**
 * LOGOUT DE USUARIO
 * Método: POST
 * Destruye la sesión
 */
require_once '../../system/init.php';
require_once '../../libs/Response.php';

session_unset();
session_destroy();

Response::success('Sesión cerrada correctamente');
