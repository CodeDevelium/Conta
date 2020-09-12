<?php
/**
 * TarjetaRepositorio.php
 * @version     1.0
 * @author      Code Develium
 * @since       11/07/2020
 */

namespace App\Repositorios;

use App\Entidades\Banco;
use App\Entidades\Tarjeta;
use App\Factory;
use App\Librerias\Convert;
use App\Librerias\Log;
use Exception;

/**
 * Class TarjetaRepositorio
 * @package App\Controladores
 */
class TarjetaRepositorio extends BaseRepositorio
{
    /**
     * TarjetaRepositorio constructor.
     * @throws Exception
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Devuelve todos los valores de las tarjetas
     * @return array
     * @throws Exception
     */
    public function get_all()
    {
        try{

            $sql = 'SELECT * FROM ' . Tarjeta::TABLA .
                      ' LEFT JOIN ' . Banco::TABLA . ' ON ' .Banco::FIELD_ID . '=' . Tarjeta::FIELD_BANCO_ID;

            $Query = Factory::Query();
            $Query->execute($sql);

            return $Query->fetch_array_all();
        } catch (Exception $ex){
            Log::save_error('Imposible obtener listado de tarjetas');
            return [];
        }
    }

    /**
     * @param Tarjeta $Tarjeta
     *
     * @return bool
     * @throws Exception
     */
    public function crear($Tarjeta)
    {
        try{
            $sql = 'INSERT INTO ' . Tarjeta::TABLA .
                          ' SET ' . Tarjeta::FIELD_NOMBRE   .'= :nombre, ' .
                                    Tarjeta::FIELD_BANCO_ID .'='. $Tarjeta->get_banco_id() . ', ' .
                                    Tarjeta::FIELD_CADUCA   .'='. $Tarjeta->get_caduca() . ', '.
                                    Tarjeta::FIELD_ACTIVA   .'='. $Tarjeta->get_activa();

            $Query = Factory::Query();

            $ok = (1 == $Query->execute($sql, [':nombre' => $Tarjeta->get_nombre()]));

            $Tarjeta->set_id( $Query->get_last_id());

            return $ok;

        } catch (Exception $ex){
            Log::save_error('Imposible crear tarjeta: '.$Tarjeta->get_nombre());
            return false;
        }
    }

    /**
     * @param Tarjeta $Tarjeta
     *
     * @return bool
     * @throws Exception
     */
    public function guardar_por_id($Tarjeta)
    {
        try{
            $sql = 'UPDATE ' . Tarjeta::TABLA .
                     ' SET ' . Tarjeta::FIELD_NOMBRE   .'= :nombre, ' .
                               Tarjeta::FIELD_BANCO_ID .'='. $Tarjeta->get_banco_id() . ', ' .
                               Tarjeta::FIELD_CADUCA   .'="'. $Tarjeta->get_caduca() . '", '.
                               Tarjeta::FIELD_ACTIVA   .'='. $Tarjeta->get_activa() .
                   ' WHERE ' . Tarjeta::FIELD_ID .'='. $Tarjeta->get_id();

            $Query = Factory::Query();

            $Query->execute( $sql, [':nombre' => $Tarjeta->get_nombre()]);

            return true;

        } catch (Exception $ex){
            Log::save_error('Imposible actualizar tarjeta: '.$Tarjeta->get_id());
            return false;
        }
    }

    /**
     * @param $tarjeta_id
     *
     * @return array|null
     * @throws Exception
     */
    public function buscar_por_id($tarjeta_id)
    {
        try{
            $sql = 'SELECT * FROM ' . Tarjeta::TABLA .
                          ' WHERE ' . Tarjeta::FIELD_ID .'='. $tarjeta_id;

            $Query = Factory::Query();

            $Query->execute($sql);

            $array_datos = $Query->fetch_array();
            if (false === $array_datos) {
                return null;
            }
            $array_datos[ Tarjeta::FIELD_ACTIVA ] = Convert::to_bool($array_datos[ Tarjeta::FIELD_ACTIVA ]);
            return $array_datos;

        } catch (Exception $ex){
            Log::save_error('Imposible buscar tarjeta por id: '.$tarjeta_id);
            return null;
        }
    }

    /**
     * Elimina una tarjeta por su ID
     *
     * @param $tarjeta_id
     *
     * @return bool
     */
    public function eliminar_por_id($tarjeta_id)
    {
        try{
            $sql = 'DELETE FROM ' . Tarjeta::TABLA .
                        ' WHERE ' . Tarjeta::FIELD_ID . '='. $tarjeta_id;

            $Query = Factory::Query();
            return (1 == $Query->execute($sql));

        } catch (Exception $ex){
            Log::save_error('Imposible eliminar tarjeta por id: '.$tarjeta_id);
            return false;
        }
    }
}
