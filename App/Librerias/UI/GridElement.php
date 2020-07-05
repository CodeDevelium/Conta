<?php
/**
 * GridElement.php
 * Un Grid
 * @version     1.0
 * @author      Code Develium
 * @since       25/12/2019
 */

namespace App\Librerias\UI;

/**
 * Class GridElement
 * @package App\Controladores
 */
class GridElement extends BaseUIElement implements IUIElement
{

    /**
     * @var string
     */
    private $columnas;

    /**
     * GridElement constructor.
     * Define la tabla de una grid DateTable
     *
     * @param $idGrid
     */
    public function __construct($idGrid)
    {
        parent::__construct();
        $this->set_id($idGrid);
        $this->class_name = ' table table-hover table-bordered table-striped table-sm table-condensed flip-content';
        return $this;

        //table table-bordered table-striped
    }

    /**
     * Añade una columna UIGridColumn
     *
     * @param string $UIElement
     *
     * @return $this
     */
    public function set_columna($UIElement)
    {
        $this->columnas .= $UIElement;
        return $this;
    }

    /**
     * Devuelve el tag html como un string
     * @return string
     */
    public function __toString()
    {
        $html = parent::__toString();
        return "<div class='table-responsive'><table {$html} style='width:100%'><thead><tr>{$this->columnas}</tr></thead><tbody></tbody></table></div>";
    }

}
