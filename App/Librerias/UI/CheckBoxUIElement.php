<?php
/**
 * CheckBoxElement.php
 * CheckBox
 * @version     1.0
 * @author      Code Develium
 * @since       25/12/2019
 */

namespace App\Librerias\UI;

/**
 * Class CheckBoxElement
 * @package App\Controladores
 */
class CheckBoxUIElement extends BaseUIElement implements IUIElement
{
    /**
     * @var string
     */
    private $texto_checkbok;

    /**
     * @var string
     */
    private $valor;

    /**
     * CheckBoxElement constructor.
     *
     * @param string $value
     * @param string $texto_checkbox
     */
    public function __construct($value, $texto_checkbox)
    {
        parent::__construct();
        $this->valor          = $value;
        $this->texto_checkbok = $this->sanitize($texto_checkbox);
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
     * Valiación: Hace que el input sea obligatorio
     * @return $this
     */
    public function set_validacion_obligatorio()
    {
        $this->tags_html .= ' data-rule-required="true" data-msg-required="'._t('Valor obligatorio').'"';
        return $this;
    }

    /**
     * Devuelve el tag html como un string
     * @return string
     */
    public function __toString()
    {
        $html = parent::__toString();
        return "<input type='checkbox' value='{$this->valor}' {$html}> {$this->texto_checkbok}&nbsp;&nbsp;&nbsp;";
    }
}
