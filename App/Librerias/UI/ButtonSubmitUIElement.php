<?php
/**
 * ButtonSubmitElement.php
 * Button del tipo Submit
 * @version     1.0
 * @author      Code Develium
 * @since       25/12/2019
 */

namespace App\Librerias\UI;


/**
 * Class ButtonSubmitElement
 * @package App\Controladores
 */
class ButtonSubmitUIElement extends BaseUIElement implements IUIElement
{
    /**
     * @var string
     */
    private $texto_button;

    /**
     * ButtonSubmitElement constructor.
     *
     * @param string $texto_button
     */
    public function __construct($texto_button)
    {
        parent::__construct();
        $this->class_name   = ' btn btn-flat';

        $this->texto_button = $texto_button;
        return $this;
    }

    /**
     * Asigna la url del link
     *
     * @param             $url
     *
     * @return $this
     */
    public function set_href($url)
    {
        $this->tags_html .= " href='{$url}'";
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
    public function ser_secundario()
    {
        $this->class_name .= ' btn-secondary';
        return $this;
    }

    /**
     * Devuelve el elemento como un string
     * @return string
     */
    public function __toString()
    {
        $html = parent::__toString();
        return "<button type='submit' {$html}>{$this->texto_button}</button>&nbsp;";
    }

}
