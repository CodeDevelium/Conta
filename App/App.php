<?php
/**
 * App.php
 * @version     1.0
 * @author      Code Develium
 */

namespace App;

use App\Librerias\Get;
use Exception;

/**
 * Applicación
 * Class App
 * @package App
 */
class App
{

    /**
     * @var Config
     */
    public static $Config;

    /**
     * @var SessionAdmin
     */
    public static $Session;

    /**
     * Parámetros recibidos en la url
     * @var string
     */
    private $query_string = '';

    /**
     * Constructor App.php
     *
     * @param null $session_id
     */
    public function __construct($session_id = null)
    {
        // Obtener lov valores de la url
        $this->query_string = rtrim(Get::get_str('qs'));

        self::$Session = Factory::Session($session_id);

        self::$Config = self::$Session->read_config();
        if (empty(self::$Config)) {
            self::$Config = Factory::Config();
            self::$Session->save_config(self::$Config);
        }

    }

    /**
     * Redireccionar entorno MVC
     */
    public function redirecciona_mvc()
    {
        // Tratamos query string
        $array_query_string = explode('/', $this->query_string);

        // Elimina posibles espacios en blanco / nulos
        $array_query_string = array_filter($array_query_string, "strlen");

        // Valores por defecto, si algo falla
        $controlador_defecto = 'home';
        $vista_defecto       = 'index';
        $parametro_defecto   = null;

        $controlador         = $controlador_defecto;
        $vista               = $vista_defecto;
        $parametro           = $parametro_defecto;

        $num_parametros = count($array_query_string);
        if ($num_parametros > 0) {

            // El controlador siempre es el primero
            $controlador = $array_query_string[ 0 ];

            if (1 == $num_parametros) {
                // Controlador
            } elseif (2 == $num_parametros) {

                $vista = $array_query_string[ 1 ];

            } elseif (3 == $num_parametros) {

                $vista     = $array_query_string[ 1 ];
                $parametro = $array_query_string[ 2 ];

            } else {

                // Varios parametros
                $vista = $array_query_string[ 1 ];

                // Creamos un array con todos los parámetros
                $parametro = [];
                for ($i = 2; $i < $num_parametros; $i++) {
                    $parametro[] = $array_query_string[ $i ];
                }
            }
        }

        // Controladores y vistas accesibles sin estar el usuario logeado
        if( !App::$Session->read_usuario_logeado()){
            switch (strtolower($controlador)){
                case 'home':
                    if( $vista == 'login' ||
                        $vista == 'login_validar'){
                        // Seguir, vista pública
                    }
                    else{
                        $controlador = 'home';
                        $vista = 'login';
                    }
                    break;
                default:
                    $controlador = 'home';
                    $vista = 'login';
                    break;
            }
        }

        // Añado sufijo Action
        $vista .= '_action';

        $controlador = ucfirst($controlador).'Controller';

        $namespace_controlador = "App\\Controladores\\".$controlador;

        if (!class_exists($namespace_controlador)) {
            $ControladorObj = 'Noexiste';
        } else {
            // Instanciamos controlador
            $ControladorObj = new $namespace_controlador();
        }

        // Existe método?
        if (!method_exists($ControladorObj, $vista)) {

            die();
        }


        try{

            if (empty($parametro)) {
                // Función sin parámetro
                $ControladorObj->{$vista}();
            } else {

                // Funcíón con un parámetro.
                // Si hay un valor, es el mismo valor
                // Si hay más de un valor es un array con todos los valores de los parámetros
                $ControladorObj->{$vista}($parametro);
            }
        } catch (Exception $ex){

            die();
        }
    }

}