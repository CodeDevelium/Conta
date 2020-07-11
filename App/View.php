<?php
/**
 * View.php
 * @version     1.0
 * @author      Code Develium
 * @since       24/06/2020
 */

namespace App;

use App\Librerias\Log;

/**
 * Class View
 * @package App\Controladores
 */
class View
{
    /**
     * @var string
     */
    private $file_js;

    /**
     * View constructor.
     */
    public function __construct()
    {
    }

    /**
     * Renderiza (Muestra) los datos
     *
     * @param string $vista
     * @param null   $datos
     */
    public function render($vista, $datos = null)
    {

        if ('/' == $vista[ 0 ]) {
            $vista = substr($vista, 1);
        }

        $this->file_js = "/scripts/Base/{$vista}.js";
        $contenido = "../App/Vistas/Base/{$vista}.php";
        if (!file_exists($contenido)) {
            $contenido = "../App/Vistas/{$vista}.php";
            $this->file_js = "/scripts/{$vista}.js";
        }
        if (!file_exists($contenido)) {
            Log::save_error('No exista la viata: '.$contenido);
            return;
        }

        require_once '../App/Vistas/header.php';
        require_once '../App/Vistas/menu.php';
        require_once "../App/Vistas/{$vista}.php";
        require_once '../App/Vistas/footer.php';

        $this->mostrar_mensajes();

    }

    /**
     * Devuevle el path al archivo js
     * @return string
     */
    public function get_file_js(){
        return $this->file_js;
    }

    /**
     * Redirecciona a una location
     *
     * @param $url
     */
    public function render_location($url)
    {
        echo "<script>window.location.href = '{$url}';</script>";
        die();
    }

    /**
     * Renderiza (Muestra) los datos
     *
     * @param string    $vista
     */
    public function render_vacio($vista)
    {
        if ('/' == $vista[ 0 ]) {
            $vista = substr($vista, 1);
        }

        require_once "../App/Vistas/headerSimple.php";
        require_once "../App/Vistas/{$vista}.php";
        require_once "../App/Vistas/footerSimple.php";

        $this->mostrar_mensajes();

    }

    /**
     *
     */
    private function mostrar_mensajes()
    {
        $error = App::$Session->read_error_texto();
        if (!empty($error)) {
               $this->alert_error($error);
        }
        $ok = App::$Session->read_ok_texto();
        if (!empty($ok)) {
            $this->alert_ok($ok);
        }
    }

    /**
     * @param $texto_error
     */
    private function alert_error($texto_error)
    {
        echo "<script>Swal.fire({
                              icon: 'error',
                              animation:false,
                              title: '".htmlspecialchars($texto_error)."'
                        });</script>";

    }

    /**
     * @param $texto_ok
     */
    private function alert_ok($texto_ok)
    {
        echo "<script>Swal.fire({
                              icon: 'success',
                              animation:false,
                              title: '".htmlspecialchars($texto_ok)."'
                        });</script>";

    }
}
