<?php
/**
 * BaseUIElement.php
 * Clase base para todos los elementos UI
 * @version     1.0
 * @author      Code Develium
 * @since       25/12/2019
 */

namespace App\Librerias\UI;

/**
 * Class BaseUIElement
 * @package App\Controladores
 */
class BaseUIElement
{
    /**
     * @var string
     */
    protected $tags_html;

    /**
     * @var string
     */
    protected $class_name;

    /**
     * @var string
     */
    protected $style;

    private $titulo_asignado;

    /**
     * BaseUIElement constructor.
     */
    public function __construct()
    {
    }

    /**
     * Estilo en linea
     *
     * @param $texto_style
     *
     * @return $this
     */
    public function set_style($texto_style)
    {
        $this->style .= ' '.$texto_style.';';
        return $this;
    }


    /**
     * Añade  un tag
     * @param $tag
     * @param $tag_value
     * @return $this
     */
    public function set_tag($tag, $tag_value){
        $this->tags_html .= " {$tag}=\"{$tag_value}\"";
        return $this;
    }

    /**
     * Se asigna el focus al input al entrar en la página
     * @return $this
     */
    public function set_auto_focus()
    {
        $this->tags_html .= ' autofocus';
        return $this;
    }

    /**
     * Undica si el botón se ha de mostrar alineado a la derecha
     * @return $this
     */
    public function set_alineacion_derecha()
    {
        $this->class_name .= ' pull-right';
        return $this;
    }

    /**
     * Tabindex
     *
     * @param int $num
     *
     * @return $this
     */
    public function set_tab_index($num)
    {
        $this->tags_html .= " tabindex='{$num}'";
        return $this;
    }

    /**
     * Añade una clase
     *
     * @param string $class
     *
     * @return $this
     */
    public function set_class_name($class)
    {
        $this->class_name .= ' '.$class;
        return $this;
    }

    /**
     * Asigna el id
     *
     * @param string $id
     *
     * @return $this
     */
    public function set_id($id)
    {
        $this->tags_html .= " id='{$id}'";
        return $this;
    }

    /**
     * Asigna el nombre
     *
     * @param string $name
     *
     * @return $this
     */
    public function set_name($name)
    {
        $this->tags_html .= " name='{$name}'";
        return $this;
    }

    /**
     * Asigna el id y el nombre con el mismo valor
     *
     * @param string $id
     *
     * @return $this
     */
    public function set_id_name($id)
    {
        $this->set_id($id)
             ->set_name($id);
        return $this;
    }

    /**
     * Texto alternativo
     *
     * @param string $texto_alternativo
     *
     * @return $this
     */
    public function set_titulo($texto_alternativo)
    {
        $texto_alternativo = $this->sanitize($texto_alternativo);

        if ($this->titulo_asignado) {

            $str_ini = "title='";
            $str_fin = "'";
            alert("pendeiente BaseUIElement set_titulo");
            //$this->tags_html = Str::get_middle_str_str($this->tags_html, $texto_alternativo, $str_ini, $str_fin);
        } else {
            $this->tags_html .= " title='{$texto_alternativo}'";
        }

        $this->titulo_asignado = true;
        return $this;
    }

    /**
     * Tamaño mini (XS)
     * @return $this
     */
    public function set_size_xs()
    {
        $this->class_name .= ' btn-xs';
        return $this;
    }

    /**
     * Color verde (Success)
     * @return $this
     */
    public function set_color_verde()
    {
        $this->class_name .= ' btn-success';
        return $this;
    }

    /**
     * Color rojo (Danger)
     * @return $this
     */
    public function set_color_rojo()
    {
        $this->class_name .= ' btn-danger';
        return $this;
    }

    /**
     * Color naranja (Warning)
     * @return $this
     */
    public function set_color_naranja()
    {
        $this->class_name .= ' btn-warning';
        return $this;
    }


    /**
     * Devuevle el html_tag y class_name
     * @return string
     */
    public function __toString()
    {
        $tag_class_name = '';
        if (!empty($this->class_name)) {
            $tag_class_name = " class='{$this->class_name}'";
        }

        $tag_style = '';
        if (!empty($this->style)) {
            $tag_style = " style='{$this->style}'";
        }

        return $this->tags_html.$tag_class_name.$tag_style;
    }

    /**
     * Devuevle el campo en formato HTML
     * @return string
     */
    public function to_html()
    {
        return $this->__toString();
    }

    /**
     * Elimina caracteres que puedan modificar la visualizacón del texto en HTML
     *
     * @param $texto
     *
     * @return mixed
     */
    protected function sanitize($texto)
    {
        return htmlspecialchars($texto);
        //return str_replace(array("'", '"', '<', '>'), array('&#39;', '&#34;', '&#60;', '&#62;'), $texto);
    }
}
