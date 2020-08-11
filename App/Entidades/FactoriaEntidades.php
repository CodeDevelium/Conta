<?php
/**
 * FactoriaEntidades.php
 * @version     1.0
 * @author      Code Develium
 * @since       24/06/2020
 */

namespace App\Entidades;

/**
 * Class FactoriaEntidades
 * @package App\Controladores
 */
class FactoriaEntidades
{
    /**
     * FactoriaEntidades constructor.
     */
    public function __construct()
    {
    }

    /**
     * Banco
     *
     * @param array|null $array_valores
     *
     * @return Banco
     */
    public function Banco($array_valores = null)
    {
        return (new Banco($array_valores));
    }

    /**
     * Tarjeta
     *
     * @param array|null $array_valores
     *
     * @return Tarjeta
     */
    public function Tarjeta($array_valores = null)
    {
        return (new Tarjeta($array_valores));
    }


}
