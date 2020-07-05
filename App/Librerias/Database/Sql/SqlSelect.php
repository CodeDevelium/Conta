<?php
/**
 * SqlSelect.php
 * SQL SELECT
 * @version     1.0
 * @author      Code Develium
 * @since       15/12/2019
 */

namespace App\Librerias\Database\Sql;

use App\Librerias\Convert;
use Exception;
use PDO;


/**
 * Class SqlSelect
 * @package App\Controladores
 */
class SqlSelect extends BaseWhere
{
    /**
     * @var bool
     */
    private $query_con_valores = false;

    /**
     * NOmbre de la tabla principal en donde ejecutar el select
     * @var
     */
    private $tabla;

    /**
     * Query del select hasta el FROM
     * @var string
     */
    private $query_select;


    /**
     * SqlSelect constructor.
     *
     * @param string $tabla
     * @param string $alias
     *
     * @throws Exception
     */
    public function __construct(string $tabla, string $alias = '')
    {
        parent::__construct();
        $this->tabla = " FROM {$tabla} ";
        if (!empty($alias)) {
            $this->tabla .= " AS {$alias} ";
        }
        $this->query_select = 'SELECT ';
    }

    /**
     * Inseta la sentencia DISTINCT en un select
     * @return SqlSelect
     */
    public function &distinct(): SqlSelect
    {
        $this->query_select .= ' DISTINCT ';
        return $this;
    }

    /**
     * Establece un bloque de los registros afectados en el select
     * @return SqlSelect
     */
    public function lock_for_update(): SqlSelect
    {
        $this->query .= ' FOR UPDATE '; //NOWAIT';
        return $this;
    }

    /**
     * Group By
     *
     * @param string $field
     *
     * @return SqlSelect
     */
    public function &group_by(string $field): SqlSelect
    {
        $this->query .= " GROUP BY {$field} ";
        return $this;
    }

    /**
     * Otros grupos
     *
     * @param string $field
     *
     * @return SqlSelect
     */
    public function &then_group_by(string $field): SqlSelect
    {
        $this->query .= " {$field} ";
        return $this;
    }

    /**
     * Sentencia COUNT para un select
     *
     * @param string $what
     *
     * @return SqlSelect
     */
    public function &count(string $what = '*'): SqlSelect
    {
        $this->query_select .= ' COUNT("'.$what.'")';
        return $this;
    }

    /**Devuelve todos los valores que queremos devilver en un select
     *
     * @param $array_fields
     *
     * @return SqlSelect
     */
    public function &get($array_fields): SqlSelect
    {
        $array_fields = Convert::to_array($array_fields);
        foreach ($array_fields as $field) {

            if ($this->query_con_valores) {
                $this->query_select .= ',';
            }
            $this->query_con_valores = true;

            $this->query_select .= ' '.$field;
        }

        $this->query = $this->query_select.$this->tabla; // . $this->query;
        return $this;
    }

    /**
     * Devuelve todos los campos de la tabla. No transforma fechas
     * @return SqlSelect
     */
    public function &get_all(): SqlSelect
    {
        $this->query_select .= ' * ';

        $this->query = $this->query_select.$this->tabla; // . $this->query;
        return $this;
    }

    /**
     * Añade una sentencia HAVING
     *
     * @param string $fields
     *
     * @return SqlSelect
     */
    public function &having($fields): SqlSelect
    {
        $this->query .= " HAVING {$fields} ";
        return $this;
    }

    /**
     * Devuelve una úncia fila de un resultado con las claves del array los nombres de laa columnas de la base de datos
     * @return array
     */
    public function fetch_array()
    {
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Devuelve un array con todas las filas con las claves del array los nombres de las columnas de la base de datos
     * @return mixed
     */
    public function fetch_array_all()
    {
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Devuelve una fila de un resultado con las claves del array con números
     * @return array
     */
    public function fetch_num()
    {
        return $this->stmt->fetch(PDO::FETCH_NUM);
    }

    /**
     * Devuelve un único valor como un int
     * @return int
     */
    public function fetch_int()
    {
        $arr = $this->stmt->fetch(PDO::FETCH_NUM);
        if (is_array($arr)) {
            return intval($arr[ 0 ]);
        }
        return null;
    }

    /**
     * Devuelve un array con todas las filas con las claves del array los el número de posisicón de cada columna
     * @return mixed
     */
    public function fetch_num_all()
    {
        return $this->stmt->fetchAll(PDO::FETCH_NUM);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        $this->query = $this->query_select.parent::__toString();
        return $this->query;
    }

}
