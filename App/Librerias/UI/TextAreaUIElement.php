<?php
/**
 * TextAreaElement.php
 * Text Area
 * @version     1.0
 * @author      Code Develium
 * @since       25/12/2019
 */

namespace App\Librerias\UI;

/**
 * Class TextAreaElement
 * @package App\Controladores
 */
class TextAreaUIElement extends BaseUIElement implements IUIElement
{
    /**
     * @var string
     */
    private $texto;

    /**
     * TextAreaElement constructor.
     *
     * @param string $texto
     */
    public function __construct($texto)
    {
        parent::__construct();
        $this->class_name = ' form-control ';
        $this->texto      = $this->sanitize($texto);
        return $this;
    }

    /**
     * Asigna la longitud máxima
     *
     * @param int $num
     *
     * @return $this
     */
    public function set_max_length($num)
    {
        $this->tags_html .= ' maxlength="'.$num.'"';
        return $this;
    }

    /**
     * Número de filas
     *
     * @param int $num
     *
     * @return $this
     */
    public function set_rows($num)
    {
        $this->tags_html .= " rows='{$num}'";
        return $this;
    }

    /**
     * Valiación: Hace que el input sea obligatorio
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
        return "<textarea {$html}>{$this->texto}</textarea>";
    }

}
