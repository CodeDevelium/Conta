<?php
/**
 * TarjetaController.php
 * @version     1.0
 * @author      Code Develium
 * @since       11/07/2020
 */

namespace App\Controladores;

use App\Entidades\Tarjeta;
use App\Factory;
use App\Librerias\Convert;
use App\Librerias\Post;
use App\Librerias\Validate;
use Exception;

/**
 * Class TarjetaController
 * @package App\Controladores
 */
class TarjetaController extends BaseController
{
    /**
     * TarjetaController constructor.
     * @throws Exception
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Index
     * @throws Exception
     */
    public function index_action()
    {
        $RepoTarjetas   = Factory::Repositorios()->Tarjeta();
        $array_tarjetas = $RepoTarjetas->get_all();

        $RepoBancos   = Factory::Repositorios()->Banco();
        $array_bancos = $RepoBancos->get_array_activos();

        $datos = ['tarjeta' => $array_tarjetas,
                  'bancos'  => $array_bancos];

        $this->View->render(Tarjeta::ACTION_INDEX, $datos);
    }

    /**
     * Crear unanueva tarjeta
     * @throws Exception
     */
    public function crear_action()
    {
        $nombre    = Post::get_str('tarjeta_nombre_nuevo');
        $banco_id  = Post::get_int('tarjeta_banco_id_nuevo');
        $caducidad = Post::get_date('tarjeta_caducidad_nuevo');

        $Tarjeta = Factory::Entidades()->Tarjeta();
        $Tarjeta->set_nombre($nombre);
        $Tarjeta->set_banco_id($banco_id);
        $Tarjeta->set_caduca($caducidad);
        $Tarjeta->set_activa(true);

        if (!$Tarjeta->datos_entidad_correctos(false)) {
            $this->set_error_texto($Tarjeta->get_error_texto());
            $this->View->render_location(Tarjeta::ACTION_INDEX);
            return;
        }

        $this->transaction_begin();

        $RepoTarjetas = Factory::Repositorios()->Tarjeta();

        if ($RepoTarjetas->crear($Tarjeta)) {

            $this->transaction_commit();
            $this->set_ok_texto('Tarjeta creada correctamente');

        } else {

            $this->transaction_rollbak();
            $this->set_error_texto('Imposible crear tarjeta');
        }

        $this->View->render_location(Tarjeta::ACTION_INDEX);

    }

    /**
     * @throws Exception
     */
    public function guardar_action()
    {
        $id        = Post::get_int('tarjeta_id_editar');
        $nombre    = Post::get_str('tarjeta_nombre_editar');
        $banco_id  = Post::get_int('tarjeta_banco_id_editar');
        $caducidad = Post::get_date('tarjeta_caducidad_editar');

        $activa = Post::get_bool('tarjeta_activa_editar');

        $Tarjeta = Factory::Entidades()->Tarjeta();
        $Tarjeta->set_id($id);
        $Tarjeta->set_nombre($nombre);
        $Tarjeta->set_banco_id($banco_id);
        $Tarjeta->set_caduca($caducidad);
        $Tarjeta->set_activa($activa);

        if (!$Tarjeta->datos_entidad_correctos(true)) {
            $this->set_error_texto($Tarjeta->get_error_texto());
            $this->View->render_location(Tarjeta::ACTION_INDEX);
            return;
        }

        $this->transaction_begin();

        $RepoTarjetas = Factory::Repositorios()->Tarjeta();

        if ($RepoTarjetas->guardar_por_id($Tarjeta)) {

            $this->transaction_commit();
            $this->set_ok_texto('Tarjeta guardada correctamente');

        } else {

            $this->transaction_rollbak();
            $this->set_error_texto('Imposible guardar tarjeta');
        }

        $this->View->render_location(Tarjeta::ACTION_INDEX);
    }

    /**
     * Elimina un banco
     * JSON
     */
    public function eliminar_action()
    {
        $tarjeta_id = Post::get_int(Tarjeta::FIELD_ID);

        $RepoTarjetas = Factory::Repositorios()->Tarjeta();

        if ($RepoTarjetas->eliminar_por_id($tarjeta_id)) {
            echo $this->json_ok("Tarjeta eliminada");
        } else {
            echo $this->json_error("Imposible eliminar tarjeta");
        }
    }

    /**
     * Json
     * @return string
     * @throws Exception
     */
    public function buscar_action()
    {
        $tarjeta_id = Post::get_int(Tarjeta::FIELD_ID);

        $RepoTarjetas = Factory::Repositorios()->Tarjeta();

        $array_tarjetas = $RepoTarjetas->buscar_por_id($tarjeta_id);

        if (Validate::is_empty($array_tarjetas)) {
            echo $this->json_error('Imposible buscar tarjetas: '.$tarjeta_id);
        } else {
            echo $this->json_ok_datos('OK', $array_tarjetas);
        }
    }
}
