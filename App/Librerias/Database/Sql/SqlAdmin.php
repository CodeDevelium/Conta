<?php
/**
 * SqlAdmin.php
 * Comandos de administración en SQL
 * @version     1.0
 * @author      Code Develium
 * @since       21/12/2019
 */

namespace App\Librerias\Database\Sql;

use App\App;
use App\Librerias\Database\DbConnection;
use Exception;
use PDO;

/**
 * Class SqlAdmin
 * @package App\Controladores
 */
class SqlAdmin extends DbConnection
{
    /**
     * SqlAdmin constructor.
     * SqlAdmin constructor.
     * @throws Exception
     */
    public function __construct()
    {
        parent::__construct();
        $this->open_conection();
    }

    /**
     * Asigna un nuevo valor para el auto_increment
     *
     * @param string $tabla
     * @param int    $num
     *
     * @throws Exception
     */
    public function set_auto_increment(string $tabla, int $num): void
    {
        $query = "ALTER TABLE {$tabla} AUTO_INCREMENT = {$num}";
        $this->execute_query($query);
    }

    /**
     * Devuelve el valor autoincrement de una tabla. Sólo si tiene un campo auto_increment
     * si no lo tiene devuelve null
     *
     * @param string $tabla
     *
     * @return mixed
     * @throws Exception
     */

    public function get_auto_increment(string $tabla)
    {
        $query = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '".App::$Config->get_servidor_db_name()."' AND  TABLE_NAME = '{$tabla}'";
        $stmt  = $this->execute_query($query);
        $row   = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row[ 'AUTO_INCREMENT' ];
    }

    /**
     * Devuelve las características de una tabla
     *
     * @param string $tabla
     *
     * @return mixed
     * @throws Exception
     */
    public function get_status_table(string $tabla)
    {
        $query = "SHOW TABLE STATUS FROM ".App::$Config->get_servidor_db_name()." WHERE name LIKE '{$tabla}'";
        $stmt  = $this->execute_query($query);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


}
