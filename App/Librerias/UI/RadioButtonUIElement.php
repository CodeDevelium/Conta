<?php
/**
 * RadioButtonElement.php
 * Radio Button
 * @version     1.0
 * @author      Code Develium
 * @since       25/12/2019
 */

namespace App\Librerias\UI;

/**
 * Class RadioButtonElement
 * @package App\Controladores
 */
class RadioButtonUIElement extends BaseUIElement implements IUIElement
{

    /**
     * @var string
     */
    private $texto_radio;

    /**
     * @var string
     */
    private $valor;

    /**
     * RadioButtonElement constructor.
     *
     * @param string $valor
     * @param string $texto_radio
     */
    public function __construct($valor, $texto_radio)
    {
        parent::__construct();
        $this->valor       = $valor;
        $this->texto_radio = $this->sanitize($texto_radio);
        return $this;
    }

    /**
     * Indica si se muestra seleccionado
     *
     * @param bool $seleccionado
     *
     * @return $this
     */
    public function set_checked($seleccionado)
    {
        if ($seleccionado) {
            $this->tags_html .= ' checked';
        }
        return $this;
    }

    /**
     * ValidacióN: Hace que el input sea obligatorio
     * @return $this
     */
    public function set_validacion_obligatorio()
    {
        $this->tags_html .= ' data-rule-required="true" data-msg-required="Valor obligatorio"';
        return $this;
    }

    /**
     * Devuelve el tag html como un string
     * @return string
     */
    public function __toString()
    {
        $html = parent::__toString();
        return "<input type='radio' value='{$this->valor}' {$html}> {$this->texto_radio}&nbsp;&nbsp;&nbsp;";
    }

}
