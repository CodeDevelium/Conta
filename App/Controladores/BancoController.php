<?php
/**
 * BancoController.php
 * @version     1.0
 * @author      Code Develium
 * @since       05/07/2020
 */

namespace App\Controladores;

use App\Entidades\Banco;
use App\Factory;
use App\Librerias\Post;
use App\Librerias\Validate;
use Exception;

/**
 * Class BancoController
 * @package App\Controladores
 */
class BancoController extends BaseController
{
    /**
     * BancoController constructor.
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
        $RepoBancos   = Factory::Repositorios()->Banco();
        $array_bancos = $RepoBancos->get_all();
        $this->View->render(Banco::ACTION_INDEX, $array_bancos);
    }

    /**
     * Crear Json
     * @throws Exception
     */
    public function crear_action()
    {
        $banco_nombre = Post::get_str('banco_nombre_nuevo');

        $Banco = Factory::Entidades()->Banco();
        $Banco->set_nombre($banco_nombre);
        $Banco->set_activo(true);

        if (!$Banco->datos_entidad_correctos(false)) {
            $this->set_error_texto($Banco->get_error_texto());
            $this->View->render_location(Banco::ACTION_INDEX);
            return;
        }

        $this->transaction_begin();

        $RepoBancos = Factory::Repositorios()->Banco();

        if ($RepoBancos->crear($Banco)) {

            $this->transaction_commit();
            $this->set_ok_texto('Banco creado correctamente');

        } else {

            $this->transaction_rollbak();
            $this->set_error_texto('Imposible crear banco');
        }

        $this->View->render_location(Banco::ACTION_INDEX);

    }

    /**
     * @throws Exception
     */
    public function guardar_action()
    {
        $banco_id     = Post::get_int('banco_id_editar');
        $banco_nombre = Post::get_str('banco_nombre_editar');
        $banco_activo = Post::get_bool('banco_activo_editar');

        $Banco = Factory::Entidades()->Banco();

        $Banco->set_id($banco_id);
        $Banco->set_nombre($banco_nombre);
        $Banco->set_activo($banco_activo);

        // Datos correctos?
        if (!$Banco->datos_entidad_correctos(true)) {
            $this->set_error_texto($Banco->get_error_texto());
            $this->View->render_location(Banco::ACTION_INDEX);
            return;
        }

        $this->transaction_begin();

        $RepoBancos = Factory::Repositorios()->Banco();

        if ($RepoBancos->guardar_por_id($Banco)) {
            $this->transaction_commit();
            $this->set_ok_texto('Datos del banco actualizados');
        } else {
            $this->transaction_rollbak();
            $this->set_error_texto('Imposible actializar los datos del banco');
        }

        $this->View->render_location(Banco::ACTION_INDEX);
    }

    /**
     * Elimina un banco
     * JSON
     */
    public function eliminar_action()
    {
        $banco_id = Post::get_int(Banco::FIELD_ID);

        $RepoBancos = Factory::Repositorios()->Banco();

        if ($RepoBancos->eliminar_por_id($banco_id)) {
            echo $this->json_ok("Banco eliminado");
        } else {
            echo $this->json_error("Imposible elimianr banco");
        }
    }

    /**
     * Json
     * @return string
     * @throws Exception
     */
    public function buscar_action()
    {
        $banco_id = Post::get_int(Banco::FIELD_ID);

        $RepoBancos = Factory::Repositorios()->Banco();

        $array_banco = $RepoBancos->buscar_por_id($banco_id);

        if (Validate::is_empty($array_banco)) {
            echo $this->json_error('Imposible buscar banco: '.$banco_id);
        } else {
            echo $this->json_ok_datos('OK', $array_banco);
        }
    }
}
