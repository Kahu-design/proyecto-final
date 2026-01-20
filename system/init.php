<?php
session_start();

/* Forzar respuestas JSON */
header('Content-Type: application/json; charset=utf-8');

/* Evitar que PHP imprima HTML de errores */
ini_set('display_errors', 0);
error_reporting(E_ALL);
