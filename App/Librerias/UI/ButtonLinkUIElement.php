<?php
/**
 * ButtonLinkUIElement.php
 * Button del tipo link
 * @version     1.0
 * @author      Code Develium
 * @since       25/12/2019
 */

namespace App\Librerias\UI;

use App\Librerias\Encriptador;

/**
 * Class ButtonLinkUIElement
 * @package App\Controladores
 */
class ButtonLinkUIElement extends BaseUIElement implements IUIElement
{
    /**
     * @var string
     */
    private $texto_link;

    /**
     * ButtonLinkElement constructor.
     *
     * @param string $text_link
     */
    public function __construct($text_link)
    {
        parent::__construct();
        $this->class_name = ' btn ';

        $this->texto_link = $this->sanitize($text_link);
        return $this;
    }

    /**
     * Texto para pregeuntar al usaurio. Si selecciona "SI" se ejecita el href, sino no hace nada
     *
     * @param string $texto_pregunta
     *
     * @return $this
     */
    public function set_pregunta($texto_pregunta)
    {
        $this->class_name .= '  my-pregunta ';

        $texto_pregunta   = $this->sanitize($texto_pregunta);
        $this->tags_html  .= " data-preg='{$texto_pregunta}'";

        return $this;
    }

    /**
     * Asigna la url del link. El parámetro no ha de ser encriptado
     *
     * @param string      $url
     * @param int|null    $parametro
     * @param string|null $token
     *
     * @return $this
     */
    public function set_href($url, $parametro = null, $token = null)
    {
        if (!empty($parametro)) {
            if(  $parametro[0] != '/'){
                $url .= '/';
            }
            $parametro = Encriptador::get_valor_encriptado($parametro);
            $url .= $parametro;
        }
        if (!empty($token)) {
            $url = $url.'/'.$token; //.Url::parametroEncriptar($token);
        }
        $this->tags_html .= " href='{$url}'";
        return $this;
    }

    /**
     * Asigna el target en donde se abrirá el link.
     *
     * @param string $target
     *
     * @return $this
     */
    public function set_target($target)
    {
        $this->tags_html .= " target='{$target}'";
        return $this;
    }

    /**
     * Button verde (primario)
     * @return $this
     */
    public function set_primario()
    {
        $this->class_name .= ' btn-primary';
        return $this;
    }

    /**
     * Button Gris (Secundario)
     * @return $this
     */
    public function set_secundario()
    {
        $this->class_name .= ' default';
        return $this;
    }

    /**
     * No se bloquea la pantalla al hacer click en el link
     * @return $this
     */
    public function set_no_lock_screen()
    {
        $this->class_name .= ' my-no-lockscreen';
        return $this;
    }

    /**
     * Devuelve el tag html como un string
     * @return string
     */
    public function __toString()
    {
        $html = parent::__toString();
        return "<a {$html}>{$this->texto_link}</a>&nbsp;";
    }

}
