<?php
/**
 * BaseRepositorio.php
 * @version     1.0
 * @author      Code Develium
 * @since       24/06/2020
 */

namespace App\Repositorios;

use App\Librerias\Database\DbConnection;
use Exception;

/**
 * Class BaseRepositorio
 * @package App\Controladores
 */
class BaseRepositorio extends DbConnection
{

    /**
     * BaseRepositorio constructor.
     * @throws Exception
     */
    public function __construct()
    {
        parent::__construct();
        $this->open_conection();

    }

}
