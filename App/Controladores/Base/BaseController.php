<?php
/**
 * BaseController.php
 * @version     1.0
 * @author      Code Develium
 * @since       24/06/2020
 */

namespace App\Controladores\Base;

use App\App;
use App\Factory;
use App\View;

/**
 * Class BaseController
 * @package App\Controladores
 */
class BaseController
{
    /**
     * @var View
     */
    protected $View;


    protected $Modelo;

    /**
     * BaseController constructor.
     */
    public function __construct()
    {
        $this->View = Factory::View();
    }

    protected function set_error_texto($error_texto){
        App::$Session->save_error_texto($error_texto);
    }

}
