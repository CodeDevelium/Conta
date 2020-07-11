<?php
/**
 * LabelErrorUIElement.php
 * Label de al lado de un input donde ha habido un error
 * @version     1.0
 * @author      Code Develium
 * @since       25/12/2019
 */

namespace App\Librerias\UI;

/**
 * Class LabelErrorUIElement
 * @package App\Controladores
 */
class LabelErrorUIElement extends BaseUIElement implements IUIElement
{
    /**
     * @var string
     */
    private $id_target;

    /**
     * LabelErrorUIElement constructor.
     *
     * @param $id_target
     */
    public function __construct($id_target)
    {
        parent::__construct();
        $this->id_target = $id_target;
    }

    /**
     * Devuelve el tag html como un string
     * @return string
     */
    public function __toString()
    {
        $html = parent::__toString();
        return "<label id='{$this->id_target}-error' class='error' for='{$this->id_target}' {$html}></label>";
    }
}
