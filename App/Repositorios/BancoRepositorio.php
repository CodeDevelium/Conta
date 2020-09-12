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
use function Couchbase\fastlzCompress;

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
            $sql = ' SELECT * FROM '.Banco::TABLA;

            $Query = Factory::Query();

            $Query->execute($sql);

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
            $sql = 'SELECT '.Banco::FIELD_ID.','.
                             Banco::FIELD_NOMBRE.
                    ' FROM '.Banco::TABLA.
                   ' WHERE '.Banco::FIELD_ACTIVO.'= 1 '.
                ' ORDER BY '.Banco::FIELD_NOMBRE;

            $Query = Factory::Query();

            $array_ret = [];
            for ($n = $Query->execute($sql); $n > 0; $n--) {

                list($id, $nombre) = $Query->fetch_num();
                $array_ret[ $id ] = $nombre;
            }

            return $array_ret;

        } catch (Exception $ex){
            Log::save_error('Imposible obtener array de bancos activos');
            return [];
        }
    }

    /**
     * @param Banco $Banco
     *
     * @return bool
     * @throws Exception
     */
    public function crear($Banco)
    {
        try{
            $sql = 'INSERT INTO '.Banco::TABLA.
                          ' SET '.Banco::FIELD_NOMBRE.'= :nombre, '.
                                  Banco::FIELD_ACTIVO.'='.$Banco->get_activo();

            $Query = Factory::Query();

            return (1 == $Query->execute($sql, [':nombre' => $Banco->get_nombre()]));

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
            $sql =  'UPDATE '.Banco::TABLA.
                    '   SET '.Banco::FIELD_NOMBRE.'= :nombre,'.
                              Banco::FIELD_ACTIVO.'='.$Banco->get_activo().
                    ' WHERE '.Banco::FIELD_ID.'='.$Banco->get_id();

            $Query = Factory::Query();

            $Query->execute($sql, [':nombre' => $Banco->get_nombre()]);

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
            $sql= 'SELECT * FROM '.Banco::TABLA.
                         ' WHERE '.Banco::FIELD_ID.'='.$banco_id;

            $Query = Factory::Query();

            $Query->execute($sql);

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
            $sql = 'DELETE FROM '. Banco::TABLA .
                       ' WHERE ' . Banco::FIELD_ID . '=' . $banco_id;

            $Query = Factory::Query();
            return (1 == $Query->execute($sql));

        } catch (Exception $ex){
            Log::save_error('Imposible eliminar banco por id: '.$banco_id);
            return false;
        }
    }
}
