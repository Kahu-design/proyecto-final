<?php
/**
 * Clase de validación de datos
 */
class Validator {

    public static function required($value): bool {
        return isset($value) && trim($value) !== '';
    }

    public static function email($email): bool {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    public static function minLength($value, $length): bool {
        return strlen(trim($value)) >= $length;
    }

    public static function numeric($value): bool {
        return is_numeric($value);
    }
}
