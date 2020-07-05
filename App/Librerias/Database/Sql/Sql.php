<?php
/**
 * Sql.php
 * Comandos sql
 * @version     1.0
 * @author      Code Develium
 * @since       20/12/2019
 */

namespace App\Librerias\Database\Sql;

use App\App;

/**
 * Class Sql
 * Comandor SQL
 * @package App\Controladores
 */
class Sql
{
    /**
     * Sql constructor.
     */
    public function __construct()
    {
    }

    /**
     * Reemplace un string por otro dentro de un string
     *
     * @param string $field
     * @param string $origen
     * @param string $destino
     *
     * @return string
     */
    public static function replace(string $field, string $origen, string $destino): string
    {
        return ' REPLACE('.$field.',"'.$origen.'","'.$destino.'") ';
    }

    /**
     * Trunca a un número determinado de decimales
     *
     * @param string $field
     * @param int    $num_decimales
     *
     * @return string
     */
    public static function truncate_decimals(string $field, int $num_decimales = 2): string
    {
        return ' TRUNCATE('.$field.','.$num_decimales.') ';
    }

    /**
     * Devuelve los num caracteres de la izquierda
     *
     * @param string $field
     * @param int    $num
     *
     * @return string
     */
    public static function left_num(string $field, int $num): string
    {
        return ' (LEFT('.$field.','.$num.')) ';
    }

    /**
     * Devuelve la sentencia de transformar a minúscula: LCASE( field )
     *
     * @param string $field
     *
     * @return string
     */
    public static function to_lower_case(string $field): string
    {
        return ' LCASE('.$field.')';
    }

    /**
     * Devuelve la sentencia de transformar a mayúsculas: UCASE( field )
     *
     * @param string $field
     *
     * @return string
     */
    public static function to_upper_case(string $field): string
    {
        return ' UCASE('.$field.')';
    }

    /**
     * Devuelve un número máximo de caracteres, si tiene más se añade '...'
     *
     * @param string $field
     * @param int    $num
     * @param string $final
     *
     * @return string
     */
    public static function left_num_max($field, $num, $final = '...'): string
    {
        return ' IF(LENGTH('.$field.')>'.$num.',CONCAT( LEFT('.$field.','.$num.'),"'.$final.'"),'.$field.') ';
    }

    /**
     * Devuelve la longitud del valor del campo
     *
     * @param string $field
     *
     * @return string
     */
    public static function length(string $field): string
    {
        return ' (LENGTH('.$field.')) ';
    }

    /**
     * Devuelve la condición like: LIKE, la condición NO incluye %_
     *
     * @param string $field
     * @param string $condicion
     *
     * @return string
     */
    public static function like(string $field, string $condicion): string
    {
        return ' '.$field.' LIKE "'.$condicion.'" ';
    }

    /**
     * Devuelve el valor máximo de un campo
     *
     * @param string $string
     *
     * @return string
     */
    public static function max($string): string
    {
        return ' MAX('.$string.') ';
    }

    /**
     * Devuelve el valor mínimo de un campo
     *
     * @param string $field
     *
     * @return string
     */
    public static function min(string $field): string
    {
        return ' MIN('.$field.') ';
    }

    /**
     * Devuelve la condición de negación: NOT field
     *
     * @param string $field
     *
     * @return string
     */
    public static function not(string $field): string
    {
        return ' NOT '.$field.' ';
    }

    /**
     * Devuelve la sentencia de ordenacion ascendente: ASC
     *
     * @param string $string
     *
     * @return string
     */
    public static function order_asc(string $string): string
    {
        return $string.' ASC ';
    }

    /**
     * Devuelve la sentencia de ordenacion descendente: DESC
     *
     * @param string $string
     *
     * @return string
     */
    public static function order_desc(string $string): string
    {
        return $string.' DESC ';
    }

    /**
     * Redondea un valor a un número determinado de decimales
     *
     * @param string $field
     * @param int    $decimals
     *
     * @return string
     */
    public static function round(string $field, int $decimals = 2)
    {
        return ' ROUND('.$field.', '.$decimals.') ';
    }

    /**
     * Devuelve una condición de redondeo a enteros: FLOOR( field )
     *
     * @param string $field
     *
     * @return string
     */
    public static function floor(string $field): string
    {
        return ' FLOOR( '.$field.') ';
    }

    /**
     * Devuelve el sumatorio de un campo
     *
     * @param string $field
     *
     * @return string
     */
    public static function sum(string $field): string
    {
        return ' SUM('.$field.')';
    }

    /**
     * Devuelve la condición de media de un campo: AVG( field )
     *
     * @param string $field
     *
     * @return string
     */
    public static function avg(string $field): string
    {
        return ' AVG('.$field.') ';
    }

    /**
     * Devuelve la sentencia TRIM
     *
     * @param string $field
     *
     * @return string
     */
    public static function trim(string $field): string
    {
        return ' TRIM('.$field.') ';
    }

    /**
     * Develve la sentencia que detecta si un campo es nulo: field IS NULL
     *
     * @param string $field
     *
     * @return string
     */
    public static function is_null(string $field): string
    {
        return '('.$field.' IS NULL) ';
    }

    /**
     * Develve la sentencia que detecta si un campo NO es nulo: field IS NOT NULL
     *
     * @param string $field
     *
     * @return string
     */
    public static function is_not_null(string $field): string
    {
        return '('.$field.' IS NOT NULL) ';
    }

    /**
     * Devuelva la sentencia IN (val1,val2,,,valN) con enteros
     *
     * @param array $arr
     *
     * @return string
     */

    public static function inInt(Array $arr): string
    {
        return ' IN('.join(',', $arr).')';
    }

    /**
     * Devuelva la sentencia IN ("val1","val2",,,"valN") con strings
     *
     * @param array $arr
     *
     * @return string
     */
    public static function inStr($arr)
    {
        return ' IN("'.join('","', $arr).'")';
    }

    /**
     * Devuelve la sentencia IF( cond, $ret, $ret_else )
     *
     * @param string $condicion
     * @param string $ret
     * @param string $ret_else
     *
     * @return string
     */
    public static function if_(string $condicion, string $ret, string $ret_else): string
    {
        if (empty($ret)) {
            $ret = '""';
        }
        if (empty($ret_else)) {
            $ret_else = '""';
        }
        return ' IF('.$condicion.','.$ret.','.$ret_else.') ';
    }

    /**
     * Devuelve una división en coma flotante
     *
     * @param string $field_numerador
     * @param string $field_dividendo
     *
     * @return string
     * @version     3.0        => 24-06-2008
     */
    public static function division_float(string $field_numerador, string $field_dividendo): string
    {
        return ' ('.$field_numerador.')/('.$field_dividendo.') ';
    }

    /**
     * Devuelve una división en enteros
     *
     * @param string $field_numerador
     * @param string $field_dividendo
     *
     * @return string
     */
    public static function division_int(string $field_numerador, string $field_dividendo): string
    {
        return ' FLOOR(('.$field_numerador.')/('.$field_dividendo.')) ';
    }

    /**
     * Devuelve una fecha de un campo con un formato deseado
     *
     * @param        $sField
     * @param string $format
     *
     * @return string
     */
    public static function date_format($sField, $format = '%d/%m/%Y')
    {
        $date_format = str_replace(['dd', 'mm', 'yyyy'], ['%d', '%m', '%Y'], $format);

        return ' DATE_FORMAT('.$sField.',\''.$date_format.'\') ';
    }

    /**
     * Devuelve una fecha y hora de un campo con un formato deseado
     *
     * @param        $sField
     * @param string $format
     *
     * @return string
     * @throws \Exception
     */
    public static function datetime_format($sField, $format = '%d/%m/%Y')
    {
        $timezone_actual = App::$Config->get_timezone_actual();

        $zone_gmt      = new \DateTimeZone('GMT');
        $now_gmt       = new \DateTime("now", $zone_gmt);

        $zone_actual      = new \DateTimeZone($timezone_actual);
        $offset =       $zone_actual->getOffset($now_gmt);

        $datetime_format = str_replace(['dd', 'mm', 'yyyy'], ['%d', '%m', '%Y'], $format);
        $datetime_format .= '  %H:%i:%s';
        return  ' DATE_FORMAT( DATE_ADD('.$sField.', INTERVAL '.$offset.' SECOND),\''.$datetime_format.'\') ';
    }

    /**
     * Devuelve una setencia de concatenación CONCAT( val1, val1,,,valN )
     *
     * @param array $arr
     *
     * @return string
     */
    public static function concat(Array $arr): string
    {
        return ' CONCAT( '.join(',', $arr).') ';
    }

    /**
     * Devuelve el primer valor no null
     *
     * @param array $arr
     *
     * @return string
     */
    public static function coalesce(Array $arr): string
    {
        return ' COALESCE('.join(',', $arr).') ';
    }

    /**
     * Devuelve una setencia COUNT
     *
     * @param string $field
     *
     * @return string
     */
    public static function count(string $field): string
    {
        return ' COUNT('.$field.') ';
    }

    /**
     * Devuelve una sentencia BETWEEN.
     *
     * @param string $field
     * @param mixed  $value1
     * @param mixed  $value2
     *
     * @return string
     */
    public static function between(string $field, string $value1, string $value2): string
    {
        return '('.$field.' BETWEEN '.$value1.' AND '.$value2.') ';
    }


}
