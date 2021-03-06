<?php
/**
 * Convert.php
 * @version     1.0
 * @author      Code Develium
 */

namespace App\Librerias;

/**
 * Conversiones de formatos
 * Class Convert
 * @package App\Librerias
 */
abstract class Convert
{

    /**
     * Convierte un elemento a un array
     *
     * @param $element
     *
     * @return array
     */
    public static function to_array($element): array
    {
        if (is_array($element)) {
            return $element;
        } elseif (Validate::is_empty($element)) {
            return [];
        } elseif (is_object($element)) {
            return ( array )$element;
        } else {
            return array($element);
        }
    }

    /**
     * Transforma un string SI/NO-YES/NO-Y/S-S/N-1/0 a bool.
     * Si el valor está vacío o null, devuelve null.
     * Devuelve -1 si no se puede convertir a true o false.
     *
     * @param string $str_bool
     *
     * @return bool
     * @see validar_is_empty()
     */
    public static function to_bool($str_bool)
    {
        $ret = -1;
        if (Validate::is_empty($str_bool)) {
            $ret = null;
        } else {
            if (is_string($str_bool)) {
                $name = strtolower(strtr($str_bool, 'ÍÓíó', 'ioio'));

                $sn = preg_replace('/[^\da-z]/i', '', strtoupper(trim($name)));
                if ($sn == 'S' || $sn == 'Y' || $sn == 'SI' || $sn == 'YES' || $sn == '1') {
                    $ret = true;
                } else {
                    if ($sn == 'N' || $sn == 'NO' || $sn == '0') {
                        $ret = false;
                    } else {
                        $ret = -1;
                    }
                }
            } else {
                if (is_numeric($str_bool)) {
                    if ($str_bool === 1) {
                        $ret = true;
                    } else {
                        if ($str_bool === 0) {
                            $ret = false;
                        } else {
                            $ret = -1;
                        }
                    }
                } else {
                    if (is_bool($str_bool)) {
                        return $str_bool;
                    }
                }
            }
        }

        return $ret;
    }

    /**
     * Devuelve un texto sin especiales HTML y sustitutyendo los CRLF por <br />
     * Si es blanco o null devuelve '&nbsp;'
     *
     * @param $txt
     *
     * @return string
     * @see validar_is_empty()
     */
    public static function to_html($txt)
    {
        if (Validate::is_empty($txt)) {
            return '&nbsp;';
        }

        return nl2br(htmlspecialchars($txt));
    }

    /**
     * Decodifica los caracteres especiales a html
     * &quot; => "
     * @param $txt
     *
     * @return string
     */
    public static function to_decode($txt){
        return html_entity_decode($txt);
    }

    /**
     * Convierte una fecha dd/mm/yyyy a yyyy-mm-dd
     *
     * @param $date
     *
     * @return string
     */
    public static function to_date_mysql($date)
    {
        list($d, $m, $y) = explode('/', $date);
        return "$y-$m-$d";
    }

    /**
     * Convierte una fecha yyyy-mm-dd a dd/mm/yyyy
     *
     * @param $date
     *
     * @return string
     */
    public static function to_date_std($date)
    {
        list($y, $m, $d) = explode('-', $date);
        return "$d/$m/$y";
    }
}