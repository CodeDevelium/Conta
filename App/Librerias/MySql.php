<?php
/**
 * MySql.php
 * @version     1.0
 * @author      Code Develium
 * @since       26/06/2020
 */

namespace App\Librerias;

/**
 * Class MySql
 * @package App\Controladores
 */
abstract class MySql
{

    /**
     * Indica si un string en formato fecha es válido para ser guardado en una campo date de una base de datos Mysql.
     * Si el campo es obligatorio, ha de existir un valor no vacío.
     * Formato de fecha: yyyy-mm-dd
     *
     * @param string $valor
     * @param bool   $obligatorio
     * @param null   $error_msg
     *
     * @return bool
     */
    public static function is_date($valor, $obligatorio = false, &$error_msg = null)
    {
        if ($obligatorio && Validate::is_empty($valor)) {
            $error_msg = 'Campo obligatorio';
            return false;
        }

        if( Validate::is_empty($valor)){
            return true;
        }

        $valid = Validate::is_date($valor);
        if (!$valid) {
            $error_msg = 'Formato de fecha incorrecto: '.$valor;
        }
        return $valor;

    }

    /**
     * Indica si un string en formato fecha y hora es válido para ser guardado en una campo datetime
     * de una base de datos Mysql.
     * Si el campo es obligatorio, ha de existir un valor no vacío.
     * Formato de fecha: yyyy-mm-dd hh:mm:ss
     *
     * @param string $valor
     * @param bool   $obligatorio
     * @param null   $error_msg
     *
     * @return bool
     */
    public static function is_datetime($valor, $obligatorio = false, &$error_msg = null)
    {
        if ($obligatorio && Validate::is_empty($valor)) {
            $error_msg = 'Campo obligatorio';
            return false;
        }

        if( Validate::is_empty($valor)){
            return true;
        }

        $valid = Validate::is_date_time($valor);
        if (!$valid) {
            $error_msg = 'Formato de fecha y hora incorrecto: '.$valor;
        }
        return $valor;
    }

    /**
     * Indica si un double es válido para ser guardado en una campo double de una base de datos Mysql.
     * Si el campo es obligatorio, ha de existir un valor no vacío, pero SI puede ser cero.
     *
     * @param double|int $valor
     * @param bool       $obligatorio
     * @param null       $error_msg
     *
     * @return bool
     */
    public static function is_double($valor, $obligatorio = false, &$error_msg = null)
    {
        if (!filter_var($valor, FILTER_VALIDATE_FLOAT)) {
            $error_msg = "No es un valor float válido";
            return false;
        }

        if ($valor != 0) { /* 0 es un valor válido */
            if ($obligatorio && Validate::is_empty($valor)) {
                $error_msg = 'Campo obligatorio';
                return false;
            }
        }

        return true;
    }

    /**
     * Indica si es un número de mysql int unsigned (0,4294967295)
     *
     * @param      $num
     * @param bool $obligatorio
     * @param bool $es_id
     * @param null $error_msg
     *
     * @return bool
     */
    public static function is_int($num, $obligatorio = false, $es_id = false, &$error_msg = null)
    {
        /* Si es ID, no puede ser cero */
        if ($es_id && $obligatorio ) {
            if ($num === 0 || $num == '0') {
                $error_msg = 'El identificador int no puede ser 0';
                return false;
            }
            if (Validate::is_empty($num)) {
                $error_msg = 'El identificador no puede estar vacío';
                return false;
            }
        }

        if ($obligatorio && Validate::is_empty($num)) {
            $error_msg = 'Campo obligatorio';
            return false;
        }

        $valid = Validate::is_between_num($num, 0, 4294967295);
        if (!$valid) {
            $error_msg = 'Int fuera de rango: '.$num;
        }
        return $valid;
    }

    /**
     * Indica si es un número de mysql small int unsigned (0,65535)
     *
     * @param      $num
     * @param bool $obligatorio
     * @param bool $es_id
     * @param null $error_msg
     *
     * @return bool
     */
    public static function is_small_int($num, $obligatorio = false, $es_id = false, &$error_msg = null)
    {
        /* Si es ID, no puede ser cero */
        if ($es_id && $obligatorio ) {
            if ($num === 0 || $num == '0') {
                $error_msg = 'El identificador small int no puede ser 0';
                return false;
            }
            if (Validate::is_empty($num)) {
                $error_msg = 'El identificador no puede estar vacío';
                return false;
            }
        }

        if ($obligatorio && Validate::is_empty($num)) {
            $error_msg = 'Campo obligatorio';
            return false;
        }

        $valid = Validate::is_between_num($num, 0, 65535);
        if (!$valid) {
            $error_msg = 'Small int fuera de rango: '.$num;
        }
        return $valid;
    }

    /**
     * Indica si un string es válido para ser guardado en una campo string de una base de datos Mysql.
     * La longitud del campo no puede superar un número máximo de carcateres.
     * Si el campo es obligatorio, ha de existir un valor no vacío.
     *
     * @param string $valor
     * @param int    $len
     * @param bool   $obligatorio
     * @param null   $error_msg
     *
     * @return bool
     */
    public static function is_str($valor, $len, bool $obligatorio = false, &$error_msg = null)
    {
        if (Validate::is_empty($valor) && $obligatorio) {
            $error_msg = 'Campo obligatorio';
            return false;
        }
        $valido = (strlen(''.$valor) <= $len);
        if (!$valido) {
            $error_msg = "Máximo {$len} caracteres";
        }
        return $valido;
    }

    /**
     * Indica si es un número de mysql tiny int unsigned (0,255)
     *
     * @param      $num
     * @param bool $obligatorio
     * @param bool $es_id
     * @param null $error_msg
     *
     * @return bool
     */
    public static function is_tiny_int($num, $obligatorio = false, $es_id = false, &$error_msg = null)
    {
        /* Si es ID, no puede ser cero */
        if ($es_id && $obligatorio ) {
            if ($num === 0 || $num == '0') {
                $error_msg = 'El identificador tiny int no puede ser 0';
                return false;
            }
            if (Validate::is_empty($num)) {
                $error_msg = 'El identificador no puede estar vacío';
                return false;
            }
        }

        if ($obligatorio && Validate::is_empty($num)) {
            $error_msg = 'Campo obligatorio';
            return false;
        }

        $valid = Validate::is_between_num($num, 0, 255);
        if (!$valid) {
            $error_msg = 'Tiny int fuera de rango: '.$num;
        }
        return $valid;
    }

    /**
     * Devuelve true si es un valor bool. Puede ser obligatorio.
     *
     * @param      $valor
     * @param      $obligatorio
     * @param null $error_msg
     *
     * @return bool
     */
    public static function is_bool($valor, $obligatorio, &$error_msg = null): bool
    {
        if ($obligatorio && Validate::is_empty($valor)) {
            $error_msg = 'Campo obligatorio';
            return false;
        }

        if (!is_bool($valor)) {
            $error_msg = 'Valor bool fuera de rango: '.$valor;
            return false;
        }
        return true;
    }
}
