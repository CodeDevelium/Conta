<?php
/**
 * IUIElement.php
 * Interface a cumplir para todos elementos de la UI
 * @version     1.0
 * @author      Code Develium
 * @since       25/12/2019
 */


namespace App\Librerias\UI;

interface IUIElement
{


    /**
     * Devuelve el tag html completo como un string
     * @return string
     */
    public function __toString();
}
