<?php
/**
 * BaseEntidad.php
 * @version     1.0
 * @author      Code Develium
 * @since       24/06/2020
 */

namespace App\Entidades;

use App\Librerias\Convert;

/**
 * Class BaseEntidad
 * @package App\Controladores
 */
class BaseEntidad
{
    /**
     * Texto del error ocurrido en la entidad
     * @var string
     */
    protected $error_texto;

    /**
     * Nombre de campo donde ha ocurrido el error
     * @var string
     */
    protected $error_campo;

    /**
     * BaseEntidad constructor.
     *
     * @param null $array_valores
     */
    public function __construct($array_valores = null)
    {
        if (!empty($array_valores)) {

            $array_valores = Convert::to_array($array_valores);
            foreach ($array_valores as $key => $value) {
                if (property_exists($this::NOMBRE_ENTIDAD, $key)) {
                    $this->$key = $value;
                }
            }

        }
    }


    /**
     * Devuelve el texto del error
     * @return string
     */
    public function get_error_texto(): ?string
    {
        return $this->error_texto;
    }

    /**
     * Devuelve el nombre del campo donde ha habido el error
     * @return string
     */
    public function get_error_campo(): ?string
    {
        return $this->error_campo;
    }

    /**
     * Asigna el texto del error ocurrido
     *
     * @param string $texto
     * @param string $campo
     */
    public function set_error_texto(string $texto, string $campo = ''): void
    {
        $this->error_texto = $texto;
        $this->error_campo = $campo;
    }
}
