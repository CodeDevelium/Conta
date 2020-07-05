<?php
/**
 * GridColumnDateTimeElement.php
 * Columna del Grid que contiene una fecha y hora
 * @version     1.0
 * @author      Code Develium
 * @since       25/12/2019
 */

namespace App\Librerias\UI;

/**
 * Class GridColumnDateTimeElement
 * @package App\Controladores
 */
class GridColumnDateTimeElement extends GridColumnElement implements IUIElement
{
    /**
     * GridColumnDateTimeElement constructor.
     *
     * @param string $titulo_columna
     */
    public function __construct($titulo_columna)
    {
        parent::__construct($titulo_columna)
              ->set_class_name('my-col-datetime');
        return $this;
    }

}
