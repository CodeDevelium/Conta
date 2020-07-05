<?php
/**
 * BaseEntidad.php
 * @version     1.0
 * @author      Code Develium
 * @since       24/06/2020
 */

namespace App\Entidades\Base;

use App\Librerias\Convert;

/**
 * Class BaseEntidad
 * @package App\Controladores
 */
class BaseEntidad
{
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

}
