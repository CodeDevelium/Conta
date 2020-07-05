<?php
/**
 * HomeController.php
 * @version     1.0
 * @author      Code Develium
 */

namespace App\Controladores;

use App\App;
use App\Controladores\Base\BaseController;
use App\Librerias\Post;

/**
 * Class HomeController
 * @package App\Controladores
 */
class HomeController extends BaseController
{

    /**
     * Constructor HomeController.php
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Index
     */
    public function index_action()
    {
        $this->View->render('home/index');
    }

    /**
     * Mostrar el login
     */
    public function login_action()
    {
        $this->View->render_vacio('/home/login');
    }

    /**
     * Validamos el formulario d elogin
     */
    public function login_validar_action()
    {

        $user = Post::get_str('user');
        $psw  = Post::get_str('psw');

        if ($user == 'webmaster' && $psw == 'malevaje') {
            // OK
            App::$Session->save_usuario_loreado('Webmaster');
            $this->View->render_location('/home/index');

        } else {
            $this->set_error_texto('Usuario y/o contraseña incorrectos');
            $this->View->render_location('/home/login');
        }

    }

}