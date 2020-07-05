<?php
/**
 * SqlDelete.php
 * Sentencia SQL DELETE
 * @version     1.0
 * @author      Code Develium
 * @since       15/12/2019
 */

namespace App\Librerias\Database\Sql;


use Exception;

/**
 * Class SqlDelete
 * @package App\Database\MySQL
 */
class SqlDelete extends BaseWhere
{
    /**
     * SqlDelete constructor.
     *
     * @param string $tabla
     *
     * @throws Exception
     */
    public function __construct(string $tabla)
    {
        parent::__construct();
        $this->query = "DELETE FROM {$tabla} ";
    }
}
