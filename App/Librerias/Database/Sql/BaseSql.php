<?php
/**
 * BaseSql.php
 * Base para todos las sentencias SQL
 * @version     1.0
 * @author      Code Develium
 * @since       15/12/2019
 */

namespace App\Librerias\Database\Sql;

use App\Librerias\Database\DbConnection;
use Exception;
use PDOStatement;

/**
 * Class BaseSql
 * Contiene el resultado de una sentencia sql
 * @package App\Database\MySQL
 */
class BaseSql extends DbConnection
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
     * @param null $array_bind
     *
     * @return int
     * @throws Exception
     */
    public function execute($array_bind = null): int
    {
        $this->stmt = $this->execute_query($this->query, $array_bind);    // DbConnection

        if (null == $this->stmt) {
            return 0;
        }
        return $this->stmt->rowCount(); // Número de registros afectados
    }

}
