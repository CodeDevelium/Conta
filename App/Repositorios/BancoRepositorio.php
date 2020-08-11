<?php
/**
 * BancoRepositorio.php
 * @version     1.0
 * @author      Code Develium
 * @since       05/07/2020
 */

namespace App\Repositorios;

use App\Entidades\Banco;
use App\Factory;
use App\Librerias\Convert;
use App\Librerias\Log;
use Exception;

/**
 * Class BancoRepositorio
 * @package App\Controladores
 */
class BancoRepositorio extends BaseRepositorio
{
    /**
     * BancoRepositorio constructor.
     * @throws Exception
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Devuelve todos loos valores
     * @return array
     * @throws Exception
     */
    public function get_all()
    {
        try{
            $Query = Factory::Sql()->Select(Banco::TABLA);

            $Query->get_all();

            $Query->execute();

            return $Query->fetch_array_all();
        } catch (Exception $ex){
            Log::save_error('Imposible obtener listado de bancos');
            return [];
        }
    }

    /**
     * Devuelve todos loos valores
     * @return array
     * @throws Exception
     */
    public function get_array_activos()
    {
        try{
            $Query = Factory::Sql()->Select(Banco::TABLA);

            $Query->get([Banco::FIELD_ID, Banco::FIELD_NOMBRE])
                  ->where_equal(Banco::FIELD_ACTIVO, true)
                  ->order_by(Banco::FIELD_NOMBRE);

            $array_ret = [];
            for ($n = $Query->execute(); $n > 0; $n--) {

                list($id, $nombre) = $Query->fetch_num();
                $array_ret[ $id ] = $nombre;
            }

            return $array_ret;

        } catch (Exception $ex){
            Log::save_error('Imposible obtener array de bancos activos');
            return [];
        }
    }
    /*
        public function array_activos_action()
        {
            $RepoBancos   = Factory::Repositorios()->Banco();
            $array_bancos = $RepoBancos->get_all_activos();
            $array_ret    = [];
            foreach ($array_bancos as $banco) {
                $array_ret[ $array_bancos[ Banco::FIELD_ID ] ] = $array_bancos[ Banco::FIELD_NOMBRE ];
            }
            return $array_ret;
        }

    */
    /**
     * @param Banco $Banco
     *
     * @return bool
     * @throws Exception
     */
    public function crear($Banco)
    {
        try{
            $Query = Factory::Sql()->Insert(Banco::TABLA);

            $Query->set([Banco::FIELD_NOMBRE => ':nombre',
                         Banco::FIELD_ACTIVO => $Banco->get_activo()]);

            return (1 == $Query->execute([':nombre' => $Banco->get_nombre()]));

        } catch (Exception $ex){
            Log::save_error('Imposible crear banco: '.$Banco->get_nombre());
            return false;
        }
    }

    /**
     * @param Banco $Banco
     *
     * @return bool
     * @throws Exception
     */
    public function guardar_por_id($Banco)
    {
        try{
            $Query = Factory::Sql()->Update(Banco::TABLA);

            $Query->set([Banco::FIELD_NOMBRE => ':nombre',
                         Banco::FIELD_ACTIVO => $Banco->get_activo()])
                  ->where_equal(Banco::FIELD_ID, $Banco->get_id());

            $Query->execute([':nombre' => $Banco->get_nombre()]);
            return true;

        } catch (Exception $ex){
            Log::save_error('Imposible actualizar banco: '.$Banco->get_id());
            return false;
        }
    }

    /**
     * @param $banco_id
     *
     * @return array|null
     * @throws Exception
     */
    public function buscar_por_id($banco_id)
    {
        try{
            $Query = Factory::Sql()->Select(Banco::TABLA);
            $Query->get_all()
                  ->where_equal(Banco::FIELD_ID, $banco_id);

            $Query->execute();

            $array_datos = $Query->fetch_array();
            if (false === $array_datos) {
                return null;
            }
            $array_datos[ Banco::FIELD_ACTIVO ] = Convert::to_bool($array_datos[ Banco::FIELD_ACTIVO ]);
            return $array_datos;

        } catch (Exception $ex){
            Log::save_error('Imposible buscar banco por id: '.$banco_id);
            return null;
        }
    }

    /**
     * Elimina un banco por su ID
     *
     * @param $banco_id
     *
     * @return bool
     */
    public function eliminar_por_id($banco_id)
    {
        try{
            $Query = Factory::Sql()->Delete(Banco::TABLA);
            $Query->where_equal(Banco::FIELD_ID, $banco_id);

            return (1 == $Query->execute());

        } catch (Exception $ex){
            Log::save_error('Imposible eliminar banco por id: '.$banco_id);
            return false;
        }
    }
}
