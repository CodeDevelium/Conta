<?php
/**
 * SqlUpdate.php
 * Sentencia SQL UPDATE
 * @version     1.0
 * @author      Code Develium
 * @since       15/12/2019
 */

namespace App\Librerias\Database\Sql;


use App\Librerias\Validate;
use Exception;

/**
 * Class SqlUpdate
 * @package App\Database\MySQL
 */
class SqlUpdate extends BaseWhere
{
    /**
     * @var bool
     */
    private $query_con_valores = false;

    /**
     * SqlUpdate constructor.
     *
     * @param string $tabla
     * @param string $alias
     *
     * @throws Exception
     */
    public function __construct(string $tabla, string $alias = '')
    {
        parent::__construct();
        $this->query .= "UPDATE {$tabla} ";
        if (!empty($alias)) {
            $this->query .= " AS {$alias} ";
        }
    }

    /**
     * Crea una sentencia SQL SET para un array de claves/valor
     *
     * @param array $array_fields_value
     *
     * @return SqlUpdate
     */
    public function &set(array $array_fields_value): SqlUpdate
    {
        foreach ($array_fields_value as $field => $value) {

            if ($this->query_con_valores) {
                $this->query .= ', ';
            } else {
                $this->query .= ' SET ';
            }
            $this->query_con_valores = true;

            if (is_string($value)) { // Incluye los strings date i datetime

                $value = addslashes($value);

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
            } elseif (Validate::is_empty($value)) {
                $this->query .= $field.'=NULL';
            }
        }

        return $this;
    }

}
