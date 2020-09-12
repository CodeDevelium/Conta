<?php
/**
 * BaseSql.php
 * Base para todos las sentencias SQL
 * @version     1.0
 * @author      Code Develium
 * @since       15/12/2019
 */

namespace App\Librerias\Database;

use Exception;
use PDO;
use PDOStatement;

/**
 * Class BaseSql
 * Contiene el resultado de una sentencia sql
 * @package App\Database\MySQL
 */
class Query extends DbConnection
{
    /**
     * Resultado de la ejecución de una sentencia sql
     * @var PDOStatement
     */
    protected $stmt;

    /**
     * String donde construir la sentencia SQL
     * @var string
     */
    protected $query = '';

    /**
     * BaseSql constructor.
     * @throws Exception
     */
    public function __construct()
    {
        parent::__construct();
        // NO se necesita abrir una conexión con la base de datos
        // EL modelo ya l aha abierto
    }

    /**
     * Devuelve la conuslta como un string
     * @return string
     */
    public function _toString()
    {
        return $this->query;
    }

    /**
     * Devuelve la conuslta como un string
     * @return string
     */
    public function trace_log()
    {
        \App\Librerias\Log::save_trace($this->query);
    }

    /**
     * Ejecuta una query y devuelve el numero de registros afectados
     *
     * @param      $sql
     * @param null $array_bind
     *
     * @return int
     * @throws Exception
     */
    public function execute($sql, $array_bind = null): int
    {
        $this->query = $sql;
        $this->stmt  = $this->execute_query($sql, $array_bind);    // DbConnection

        if (null == $this->stmt) {
            return 0;
        }
        return $this->stmt->rowCount(); // Número de registros afectados
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

}
