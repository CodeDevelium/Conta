<?php
/**
 * Factory.php
 * @version     1.0
 * @author      Code Develium
 * @since       24/06/2020
 */

namespace App;


use App\Entidades\FactoriaEntidades;
use App\Librerias\Database\Sql\FactoriaSql;
use App\Librerias\UI\FactoriaUI;
use App\Repositorios\FactoriaRepositorios;

/**
 * Class Factory
 * @package App\Controladores
 */
abstract class Factory
{

    /**
     * @return FactoriaRepositorios
     */
    public static function Repositorios()
    {
        return new FactoriaRepositorios();
    }

    /**
     * @return FactoriaEntidades
     */
    public static function Entidades()
    {
        return new FactoriaEntidades();
    }

    /**
     * Config
     * @return Config
     */
    public static function Config()
    {
        return new Config();
    }
    /**
     * Devuelve el administrador de la sessión enla aplicación
     *
     * @param string $session_id
     *
     * @return SessionAdmin
     */
    public static function Session($session_id = null)
    {
        return new SessionAdmin($session_id);
    }

    /**
     * Form
     * @return FactoriaSql
     */
    public static function Sql(){
        return new FactoriaSql();
    }

    /**
     * Form
     * @return FactoriaUI
     */
    public static function UI(){
        return new FactoriaUI();
    }

    /**
     * Devuelve la vista
     * @return View
     */
    public static function View(){
        return new View();
    }
}
