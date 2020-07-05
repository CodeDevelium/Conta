<?php
/**
 * SessionAdmin.php
 * @version     1.0
 * @author      Code Develium
 * @since       24/06/2020
 */

namespace App;

use App\Librerias\Session;
use App\Librerias\Valid;

/**
 * Class SessionAdmin
 * @package App\Controladores
 */
class SessionAdmin
{
    /**
     * SessionAdmin constructor.
     *
     * @param string $session_id
     */
    public function __construct($session_id = null)
    {
        Session::init($session_id);
    }

    /**
     * Guardamos la configuración actual de la aplicación
     *
     * @param Config $Config
     */
    public function save_config(Config $Config)
    {
        Session::set_value('_CONFIG_', $Config);
    }

    /**
     * Devuelve la configuración actual
     * @return Config
     */
    public function read_config()
    {
        return Session::get_value('_CONFIG_');
    }

    /**
     * Guarda el nombre del usuario logeado
     * @param $nombre
     */
    public function save_usuario_loreado($nombre){
        Session::set_value('_NOMBRE_USUARIO_', $nombre);
    }

    /**
     * Indica si el usuario esta logeado o no
     * @return bool
     */
    public function read_usuario_logeado(){
        return !Valid::is_empty(Session::get_str('_NOMBRE_USUARIO_')) ;
    }

    /**
     * Guarda un error para ser mostrado al usuario
     * @param $error_texto
     */
    public function save_error_texto($error_texto){
        Session::set_value('_ERROR_TEXTO_', $error_texto);
    }

    /**
     * Devuelve un error para ser mostrado al usuario
     */
    public function read_error_texto(){
        $str = Session::get_value('_ERROR_TEXTO_');
        Session::delete('_ERROR_TEXTO_');
        return $str;
    }

}
