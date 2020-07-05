<?php
/**
 * GridColumnElement.php
 * Colimna de un Grid
 * @version     1.0
 * @author      Code Develium
 * @since       25/12/2019
 */

namespace App\Librerias\UI;


/**
 * Class GridColumnElement
 * @package App\Controladores
 */
class GridColumnElement extends BaseUIElement implements IUIElement
{

    /**
     * @var string
     */
    private $texto_columna;

    /**
     * GridColumnElement constructor.
     *
     * @param string $texto_columna
     */
    public function __construct($texto_columna)
    {
        parent::__construct();
        $this->texto_columna = $texto_columna;
        return $this;
    }

    /**
     * Ancho de la columna
     *
     * @param $px
     *
     * @return $this
     */
    public function set_width($px)
    {
        $this->style .= " width:{$px}px;";
        return $this;
    }

    /**
     * Devuelve el tag html como un string
     * @return string
     */
    public function __toString()
    {
        $html = parent::__toString();
        return "<th {$html}>{$this->texto_columna}</th>";
    }
}
