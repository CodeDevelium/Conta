<?php
/**
 * InputHiddenElement.php
 * Input hidden
 * @version     1.0
 * @author      Code Develium
 * @since       25/12/2019
 */

namespace App\Librerias\UI;

/**
 * Class InputHiddenElement
 * @package App\Controladores
 */
class InputHiddenUIElement extends BaseUIElement implements IUIElement
{
    /**
     * @var string
     */
    private $valor;

    /**
     * InputHiddenElement constructor.
     *
     * @param      $valor
     */
    public function __construct($valor)
    {
        parent::__construct();
        $this->valor = $valor;
        return $this;
    }

    /**
     * Devuelve el tag html como un string
     * @return string
     */
    public function __toString()
    {
        $html = parent::__toString();
        return "<input type='hidden' value='{$this->valor}' {$html}>";
    }
}
