<?php
/**
 * ImageElement.php
 * Implementa un imagen IMG
 * @version     1.0
 * @author      Code Develium
 * @since       25/12/2019
 */

namespace App\Librerias\UI;

/**
 * Class ImageElement
 * @package App\Controladores
 */
class ImageUIElement extends BaseUIElement implements IUIElement
{
    /**
     * @var string
     */
    private $src;

    /**
     * ImageElement constructor.
     *
     * @param string $src
     */
    public function __construct($src)
    {
        parent::__construct();
        $this->src = $src;
        return $this;
    }

    /**
     * Alto de la imagen
     *
     * @param int $n
     *
     * @return $this
     */
    public function set_height($n)
    {
        $this->tags_html .= " height='{$n}'";
        return $this;
    }

    /**
     * Texto alternativo para cuando no se muestran imágenes
     *
     * @param $texto_alternativo
     *
     * @return $this
     */
    public function set_alt($texto_alternativo)
    {
        $texto_alternativo = $this->sanitize($texto_alternativo);
        $this->tags_html   .= " alt='{$texto_alternativo}'";
        return $this;
    }

    /**
     * Ancho de la imagen
     *
     * @param int $n
     *
     * @return $this
     */
    public function set_width($n)
    {
        $this->tags_html .= " width='{$n}'";
        return $this;
    }

    /**
     * Devuelve el tag html como un string
     * @return string
     */
    public function __toString()
    {
        $html = parent::__toString();
        return "<img src='{$this->src}' {$html}>";
    }

}
