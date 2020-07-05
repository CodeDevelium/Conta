<?php
/**
 * LinkUIElement.php
 * Implementa un link A
 * @version     1.0
 * @author      Code Develium
 * @since       25/12/2019
 */

namespace App\Librerias\UI;

use App\Librerias\Encriptador;

/**
 * Class LinkUIElement
 * @package App\Controladores
 */
class LinkUIElement extends BaseUIElement implements IUIElement
{
    /**
     * @var string
     */
    private $texto_link;

    /**
     * Constructor. Si el link es un objeto, no ha realizarse el sanitize
     *
     * @param string $texto_link
     * @param bool   $sanitize
     *
     * @return $this
     */
    public function __construct($texto_link, $sanitize = true)
    {
        parent::__construct();
        if ($sanitize) {
            $this->texto_link = $this->sanitize($texto_link);
        } else {
            $this->texto_link = $texto_link;
        }

        return $this;
    }

    /**
     * Asigna la url del link
     *
     * @param             $url
     * @param string|null $id
     * @param null $token
     *
     * @return $this
     */
    public function set_href($url, $id = null, $token = null)
    {

        if (!empty($id)) {
            $id = Encriptador::get_valor_encriptado($id);
            $url = $url.'/'.$id;
        }
//        if (!empty($token)) {
//            $url = $url.'/'.Url::parametroEncriptar($token);
//        }
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
     * No se bloquea la pantalla al hacer click en el link
     * @return $this
     */
    public function set_no_lock_screen()
    {
        alert("Pendiente");
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
        return "<a {$html}>{$this->texto_link}</a>";
    }
}
