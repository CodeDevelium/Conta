<?php
/**
 * Config.php                                    ENTIDAD
 * Entidad que gestiona las variables globales de la aplicción
 * @version     1.0
 * @author      Code Develium
 */

namespace App;

use App\Entidades\Base\Usuario;
use App\Librerias\Dispositivo;

/**
 * Class Config
 * @package App\Entidades
 */
class Config  // La configuración no es una entidad que se guarda en al BD
{
    /**
     * Variables staticas de la aplicación
     * @var string
     */
    private
        $app_nombre,
        $app_titulo,
        $app_descripcion,
        $app_autor,
        $http_server_name,
        $path_document_root,
        $path_base_app,
        $debug,
        $path_logs,
        $servidor_db_host,        // Configuración base de datos
        $servidor_db_usuario,
        $servidor_db_psw,
        $servidor_db_name,
        $servidor_db_port;

    /**
     * Config constructor.
     *
     */
    public function __construct()
    {
        $this->app_nombre      = 'Simple System';
        $this->app_titulo      = 'Simple System';
        $this->app_descripcion = 'Sistema simple de dos capas sin usaurios';
        $this->app_autor       = 'Code Develium';

        // Siempre que tengamos una apliación Web (Apache)
        //$this->path_document_root = $_SERVER[ "DOCUMENT_ROOT" ]; // html_public (Usado para los js)
        //$this->path_base_app      = $_SERVER[ "DOCUMENT_ROOT" ]."/../App";

        $this->http_server_name = Dispositivo::get_dominio_http_actual();

        $this->path_base_app      = __DIR__; // Z:\www\pos\App

        $this->path_document_root = str_replace( 'App', 'html_public', $this->path_base_app);

        $this->path_logs          = $this->path_base_app.'/Logs/log-error-'.date('Y-m-d').'.txt';


        if (file_exists(__DIR__.'/es_prodiccion.txt')) {
            // Producción
            $this->debug               = false;
            $this->servidor_db_host    = 'localhost';
            $this->servidor_db_usuario = 'codedevelium';
            $this->servidor_db_psw     = 'psw';
            $this->servidor_db_name    = '';
            $this->servidor_db_port    = 3306;
        } else {
            // Desarrollo
            $this->debug               = true;
            $this->servidor_db_host    = '127.0.0.1';
            $this->servidor_db_usuario = 'root';
            $this->servidor_db_psw     = '';
            $this->servidor_db_name    = 'pos';
            $this->servidor_db_port    = 3306;
        }
    }

    /**
     * Devuelve el nombre de la aplicación
     * @return string
     */
    public function get_app_nombre(): string
    {
        return $this->app_nombre;
    }

    /**
     * Devuelve el título de la aplicación
     * @return string
     */
    public function get_app_titulo(): string
    {
        return $this->app_titulo;
    }

    /**
     * Devuevle al descripción de la aplicación
     * @return string
     */
    public function get_app_descripcion(): string
    {
        return $this->app_descripcion;
    }

    /**
     * Devuelve el autor de la aplicación
     * @return string
     */
    public function get_app_autor(): string
    {
        return $this->app_autor;
    }

    /**
     * Devuelve el nombre del servidor
     * @return string
     */
    public function get_http_server_name(): string
    {
        return $this->http_server_name;
    }

    /**
     * Devuelve el path del document root. Donde apunta la parte pública
     * @return string
     */
    public function get_path_document_root(): string
    {
        return $this->path_document_root;
    }

    /**
     * Devuelve el path completo del directorio del proyecto
     * @return string
     */
    public function get_path_base_app(): string
    {
        return $this->path_base_app;
    }

    /**
     * Indica si el model debug esta activado o no
     * @return bool
     */
    public function get_debug(): bool
    {
        return $this->debug;
    }

    /**
     * Devuelve el path completo al archivo de logs
     * @return string
     */
    public function get_path_logs(): string
    {
        return $this->path_logs;
    }

    /**
     * Nombde del servidor del MySQL
     * @return string
     */
    public function get_servidor_db_host(): string
    {
        return $this->servidor_db_host;
    }

    /**
     * Nombre del usuario con el que conectar al MySQL
     * @return string
     */
    public function get_servidor_db_usuario(): string
    {
        return $this->servidor_db_usuario;
    }

    /**
     * COntraseña del usuario con el que conectar al MySQL
     * @return string
     */
    public function get_servidor_db_psw(): string
    {
        return $this->servidor_db_psw;
    }

    /**
     * Nombde de la base de datos a utilizar
     * @return string
     */
    public function get_servidor_db_name(): string
    {
        return $this->servidor_db_name;
    }

    /**
     * Puersto del MySQL
     * @return string
     */
    public function get_servidor_db_port(): string
    {
        return $this->servidor_db_port;
    }

}

