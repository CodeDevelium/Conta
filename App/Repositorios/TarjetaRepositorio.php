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
            $Query = Factory::Sql()->Select(Tarjeta::TABLA);

            $Query->get_all()
                ->left_join( Banco::TABLA)->on_equal( Banco::FIELD_ID, Tarjeta::FIELD_BANCO_ID);

            $Query->execute();

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
            $Query = Factory::Sql()->Insert(Tarjeta::TABLA);

            $Query->set([Tarjeta::FIELD_NOMBRE   => ':nombre',
                         Tarjeta::FIELD_BANCO_ID => $Tarjeta->get_banco_id(),
                         Tarjeta::FIELD_CADUCA   => $Tarjeta->get_caduca(),
                         Tarjeta::FIELD_ACTIVA   => $Tarjeta->get_activa()]);

            $ok = (1 == $Query->execute([':nombre' => $Tarjeta->get_nombre()]));
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
            $Query = Factory::Sql()->Update(Tarjeta::TABLA);

            $Query->set([Tarjeta::FIELD_NOMBRE     => ':nombre',
                         Tarjeta::FIELD_BANCO_ID => $Tarjeta->get_banco_id(),
                         Tarjeta::FIELD_CADUCA   => $Tarjeta->get_caduca(),
                         Tarjeta::FIELD_ACTIVA   => $Tarjeta->get_activa()])
                  ->where_equal(Tarjeta::FIELD_ID, $Tarjeta->get_id());

            $Query->execute([':nombre' => $Tarjeta->get_nombre()]);
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
            $Query = Factory::Sql()->Select(Tarjeta::TABLA);
            $Query->get_all()
                  ->where_equal(Tarjeta::FIELD_ID, $tarjeta_id);

            $Query->execute();

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
            $Query = Factory::Sql()->Delete(Tarjeta::TABLA);
            $Query->where_equal(Tarjeta::FIELD_ID, $tarjeta_id);

            return (1 == $Query->execute());

        } catch (Exception $ex){
            Log::save_error('Imposible eliminar tarjeta por id: '.$tarjeta_id);
            return false;
        }
    }
}
