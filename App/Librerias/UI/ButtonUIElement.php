<?php
/**
 * ButtonLinkUIElement.php
 * Button del tipo link
 * @version     1.0
 * @author      Code Develium
 * @since       25/12/2019
 */

namespace App\Librerias\UI;

use App\Librerias\Encriptador;

/**
 * Class ButtonUIElement
 * @package App\Controladores
 */
class ButtonUIElement extends BaseUIElement implements IUIElement
{
    /**
     * @var string
     */
    private $texto;

    /**
     * @var string
     */
    private $modal;

    /**
     * ButtonLinkElement constructor.
     *
     * @param string $text
     */
    public function __construct($text)
    {
        parent::__construct();
        $this->class_name = ' btn btn-flat';

        $this->texto = $this->sanitize($text);
        return $this;
    }

    /**
     * Button verde (primario)
     * @return $this
     */
    public function set_primario()
    {
        $this->class_name .= ' btn-primary';
        return $this;
    }


    /**
     * Button Gris (Secundario)
     * @return $this
     */
    public function set_secundario()
    {
        $this->class_name .= ' default';
        return $this;
    }

    /**
     * Asigna un icono
     *
     * @param $fa_icon
     *
     * @return $this
     */
    public function set_icon($fa_icon)
    {
        $this->texto .= "<i class=\"fa {$fa_icon}\"></i>";
        return $this;
    }

    /**
     * Devuelve el tag html como un string
     * @return string
     */
    public function __toString()
    {
        $html = parent::__toString();
        return "<a {$html}{$this->modal}>{$this->texto}</a>&nbsp;";
    }

}
