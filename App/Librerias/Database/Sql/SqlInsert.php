<?php
/**
 * SqlInsert.php
 * @version     1.0
 * @author      Code Develium
 * @since       15/12/2019
 */

namespace App\Librerias\Database\Sql;

use App\Librerias\Validate;
use Exception;

/**
 * Class SqlInsert
 * @package App\Database\MySQL
 */
class SqlInsert extends BaseSql
{
    /**
     * @var bool
     */
    private $query_con_valores = false;

    /**
     * SqlInsert constructor.
     *
     * @param string $tabla
     *
     * @throws Exception
     */
    public function __construct(string $tabla)
    {
        parent::__construct();
        $this->query .= "INSERT INTO {$tabla} ";
    }

    /**
     * Crea una sentencia SQL SET para un array de claves/valor
     *
     * @param array $array_fields_value
     *
     * @return SqlInsert
     */
    public function &set(array $array_fields_value): SqlInsert
    {
        foreach ($array_fields_value as $field => $value) {

            if ($this->query_con_valores) {
                $this->query .= ', ';
            } else {
                $this->query .= ' SET ';
            }
            $this->query_con_valores = true;


            if (is_string($value)) { // Incluye los strings date i datetime

                //$value = addslashes($value);
                $value = filter_var($value, FILTER_SANITIZE_STRING);

                if( ':' != $value[0]){
                    $this->query .= $field.'="'.$value.'" ';    // Añado entre comillas dobles
                }
                else{
                    $this->query .= $field.'='.$value.' ';    // Añado entre comillas dobles
                }

            } elseif (is_bool($value)) {

                if (empty($value)) {
                    $value = 0;
                } else {
                    $value = 1;
                }

                $this->query .= $field.'='.$value;

            } elseif (is_numeric($value)) {

                // Permitimos el cero
                if ($value !== 0 && empty($value)) {
                    $value = 'NULL';
                }

                if (empty($value)) {
                    $value = 0;
                }

                $this->query .= $field.'='.$value;
            }
            elseif( Validate::is_empty($value)){
                $this->query .= $field.'=NULL';
            }
        }

        return $this;
    }
}
