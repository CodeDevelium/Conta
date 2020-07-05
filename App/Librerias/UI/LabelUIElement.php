<?php
/**
 * LabelUIElement.php
 * Label de al lado de un input
 * @version     1.0
 * @author      Code Develium
 * @since       25/12/2019
 */

namespace App\Librerias\UI;

/**
 * Class LabelUIElement
 * @package App\Controladores
 */
class LabelUIElement extends BaseUIElement implements IUIElement
{
    private $obligatorio = false;

    /**
     * @var string
     */
    private $texto_label;

    /**
     * LabelUIElement constructor.
     *
     * @param string $texto_label
     */
    public function __construct($texto_label)
    {
        parent::__construct();
        $this->class_name  = 'control-label';
        $this->texto_label = $this->sanitize($texto_label);
        return $this;
    }

    public function set_obligatorio()
    {
        $this->obligatorio = true;
        return $this;
    }
    /**
     * Input asociado al label
     *
     * @param string $input_id
     *
     * @return $this
     */
    public function set_for($input_id)
    {
        $this->tags_html .= " for='{$input_id}'";
        return $this;
    }

    /**
     * Devuelve el tag html como un string
     * @return string
     */
    public function __toString()
    {
        $tagObligatorio = '';
        if ($this->obligatorio) {
            $tagObligatorio = ' <span style="color:red;font-size: smaller">*</span>';
        }
        $html = parent::__toString();
        return "<label style='word-wrap: break-word;' {$html}>{$this->texto_label}{$tagObligatorio}</label>";
    }
}
