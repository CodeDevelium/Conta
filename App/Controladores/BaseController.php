<?php
/**
 * BaseController.php
 * @version     1.0
 * @author      Code Develium
 * @since       24/06/2020
 */

namespace App\Controladores;

use App\App;
use App\Factory;
use App\Librerias\Database\DbConnection;
use App\View;
use Exception;

/**
 * Class BaseController
 * @package App\Controladores
 */
class BaseController extends DbConnection
{

    /**
     * @var View
     */
    protected $View;


    protected $Modelo;

    /**
     * BaseController constructor.
     * @throws Exception
     */
    public function __construct()
    {
        parent::__construct();
        $this->open_conection();
        $this->View = Factory::View();
    }

    /**
     * Asigan el error ocurrido
     *
     * @param $error_texto
     */
    protected function set_error_texto($error_texto)
    {
        App::$Session->save_error_texto($error_texto);
    }

    /**
     * Assigna un mensja de texto
     *
     * @param $ok_texto
     */
    protected function set_ok_texto($ok_texto)
    {
        App::$Session->save_ok_texto($ok_texto);
    }

    /**
     * Devuelve una array JSON indicando que ha habido un error.
     * Por defecto el código de error es 1
     * El código de error puede ser positivo o negativo, pero nunca 0 para indicar que ha habido un error
     * Claves en minúsculas
     *
     * @param string $texto
     * @param int    $codigoError
     *
     * @return string
     */
    public function json_error(string $texto = 'ERROR', $codigoError = 1)
    {
        $arr = ['error' => $codigoError, 'mensaje' => $texto];

        header('Content-type: application/json');
        return json_encode($arr);
    }

    /**
     * Devuelve una array JSON indicando que NO ha habido error.
     * Por defecto el código de error es 0.
     * Cualquier valor diferente de 0 (positivos o negativos) indica que SÍ que hay error
     * Claves en minúsculas
     *
     * @param string $texto
     * @param int    $codigoOk
     *
     * @return string
     */
    public function json_ok(string $texto = "OK", $codigoOk = 0)
    {
        $arr = ['error' => $codigoOk, 'mensaje' => $texto];

        header('Content-type: application/json');
        return json_encode($arr);
    }

    /**
     * Devuelve una array JSON indicando que NO ha habido error añadiendo un array de datos
     * Por defecto el código de error es 0.
     * Cualquier valor diferente de 0 (positivos o negativos) indica que SÍ que hay error
     * Claves en minúsculas
     *
     * @param string $texto
     * @param array  $datos
     * @param int    $codigoOk
     *
     * @return string
     */
    public function json_ok_datos(string $texto = "OK", $datos = [], $codigoOk = 0)
    {
        $arr = array(
            'error'   => $codigoOk,        // No hay error => 0
            'mensaje' => $texto,
            'datos'   => $datos
        );

        header('Content-type: application/json');
        return json_encode($arr);
    }
}
