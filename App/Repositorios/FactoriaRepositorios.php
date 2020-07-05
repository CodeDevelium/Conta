<?php
/**
 * FactoriaRepositorios.php
 * @version     1.0
 * @author      Code Develium
 * @since       24/06/2020
 */

namespace App\Repositorios;

/**
 * Class FactoriaRepositorios
 * @package App\Controladores
 */
class FactoriaRepositorios
{
    /**
     * FactoriaRepositorios constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return HomeRepositorio
     */
    public function Home()
    {
        return new HomeRepositorio();
    }

}
