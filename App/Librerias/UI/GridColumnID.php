<?php
/**
 * GridColumnID.php
 * Columna del grid que contiene el ID
 * @version     1.0
 * @author      Code Develium
 * @since       25/12/2019
 */

namespace App\Librerias\UI;

/**
 * Class GridColumnID
 * @package App\Controladores
 */
class GridColumnID extends GridColumnElement implements IUIElement
{
    /**
     * GridColumnID constructor.
     */
    public function __construct()
    {
        parent::__construct('ID')->set_style('width:50px');
              //->className('my-col-id');
        return $this;
    }
}
