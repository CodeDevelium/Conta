<?php
/**
 * IconUIElement.php
 * Icono awesame
 * @version     1.0
 * @author      Code Develium
 * @since       25/12/2019
 */

namespace App\Librerias\UI;

/**
 * Class IconUIElement
 * @package App\Controladores
 */
class IconUIElement extends BaseUIElement implements IUIElement
{

    /**
     * IconElement constructor.
     *
     * @param string $fa_icon
     */
    public function __construct($fa_icon)
    {
        parent::__construct();
        $this->class_name = "fa {$fa_icon}";
        return $this;
    }

    /**
     * Devuelve el tag html como un string
     * @return string
     */
    public function __toString()
    {
        $html = parent::__toString();
        return "<i {$html}></i>";
    }

}
