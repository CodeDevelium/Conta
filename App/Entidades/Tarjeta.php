<?php
/**
 * Tipo de entidad Tarjeta
 * @version     1.1
 * @author      AlexDataDev
 * @since       11/07/2019
 */

namespace App\Entidades;

use App\Factory;
use App\Librerias\MySql;
use App\Librerias\Post;

/**
 * Class Tarjeta
 */
class Tarjeta extends BaseEntidad
{
    public const TABLA          = 'tarjetas';
    public const ENTIDAD_NOMBRE = 'App\Entidades\Tarjeta';    // Nombre de la entidad con Namespace

    /**
     * Variables de la entidad a mapear con la tabla Tarjeta
     */
    protected
        $tarjeta_id,
        $tarjeta_nombre,
        $tarjeta_banco_id,
        $tarjeta_caduca,
        $tarjeta_activa;

    /**
     * Constantes de los Campos/Columnas de la tabla Tarjeta
     */
    public const
        FIELD_ID = 'tarjeta_id',                     // Autoincrement yiny int
        FIELD_NOMBRE = 'tarjeta_nombre',             // Obligatorio   char(50)
        FIELD_BANCO_ID = 'tarjeta_banco_id',         // Obligatorio tinyint
        FIELD_CADUCA = 'tarjeta_caduca',             // Obligatorio Date
        FIELD_ACTIVA = 'tarjeta_activa',             // Obligatorio bool
        LEN_NOMBRE = 50;

    /**
     * Vistas/Acciones del controlador
     */
    public const
        ACTION_INDEX = '/Tarjeta/index',
        ACTION_CONSULTAR = '/Tarjeta/consultar',
        ACTION_EDITAR = '/Tarjeta/editar',
        ACTION_GUARDAR = '/Tarjeta/guardar',
        ACTION_NUEVO = '/Tarjeta/nuevo',
        ACTION_CREAR = '/Tarjeta/crear',
        ACTION_ELIMINAR = '/Tarjeta/eliminar';


    /**
     * @var Banco
     */
    private $EntidadBanco;

    /**
     * Tarjeta constructor.
     *
     * @param null $array_valores
     */
    public function __construct($array_valores = null)
    {
        parent::__construct($array_valores);
        $this->EntidadBanco = Factory::Entidades()->Banco($array_valores);
    }

    /**
     * Indica si los datos del objeto Tarjeta son válidos
     *
     * @param bool $comprobar_id
     *
     * @return bool
     */
    public function datos_entidad_correctos(bool $comprobar_id = true): bool
    {
        $error_msg = null;
        if( $comprobar_id){
            /* ID */
            if( !MySql::is_tiny_int( $this->tarjeta_id, true, true, $error_msg)){
                $this->set_error_texto( $error_msg . ': '.self::FIELD_ID , self::FIELD_ID);
                return false;
            }
        }

        /* Nombre */
        if( !MySql::is_str( $this->tarjeta_nombre, self::LEN_NOMBRE, true, $error_msg)){
            $this->set_error_texto( $error_msg. ': '.self::FIELD_NOMBRE, self::FIELD_NOMBRE);
            return false;
        }

        /* Banco Id */
        if( !MySql::is_tiny_int($this->tarjeta_banco_id, true, true, $error_msg)){
            $this->set_error_texto( $error_msg. ': '.self::FIELD_BANCO_ID, self::FIELD_BANCO_ID);
            return false;
        }

        /* Fecha caducidad */
        if( !MySql::is_date( $this->tarjeta_caduca, true, $error_msg)){
            $this->set_error_texto( $error_msg. ': '.self::FIELD_CADUCA, self::FIELD_CADUCA);
            return false;
        }

        /* Activa */
        if( !MySql::is_bool($this->tarjeta_activa, true, $error_msg)){
            $this->set_error_texto( $error_msg. ': '.self::FIELD_ACTIVA, self::FIELD_ACTIVA);
            return false;
        }

        return true;
    }

    /**
     * ID de la entidad Tarjeta
     * @return int|null
     */
    public function get_id(): ?int
    {
        return $this->tarjeta_id;
    }


    /**
     * Id de la entidad Tarjeta
     *
     * @param int|null $id
     */
    public function set_id(?int $id): void
    {
        $this->tarjeta_id = $id;
    }

    /**
     * Nombre de la entidad Tarjeta
     * @return string|null
     */
    public function get_nombre(): ?string
    {
        return $this->tarjeta_nombre;
    }

    /**
     * Nombre de la entidad Tarjeta
     *
     * @param string|null $nombre
     */
    public function set_nombre(?string $nombre): void
    {
        $this->tarjeta_nombre = $nombre;
    }

    /**
     * Banco Id
     * @return int|null
     */
    public function get_banco_id(): ?int
    {
        return $this->tarjeta_banco_id;
    }

    /**
     * Banco Id
     *
     * @param int|null $id
     */
    public function set_banco_id(?int $id): void
    {
        $this->tarjeta_banco_id = $id;
    }

    /**
     * Fecha Caducidad
     * @return string|null
     */
    public function get_caduca(): ?string
    {
        return $this->tarjeta_caduca;
    }

    /**
     * Fecha Caducidad
     *
     * @param string|null $caduca
     */
    public function set_caduca(?string $caduca): void
    {
        $this->tarjeta_caduca = $caduca;
    }

    /**
     * Activa
     * @return bool|null
     */
    public function get_activa(): ?bool
    {
        return $this->tarjeta_activa;
    }

    /**
     * Activa
     *
     * @param bool|null $activa
     */
    public function set_activa(?bool $activa): void
    {
        $this->tarjeta_activa = $activa;
    }

}   /* Entidad Tarjeta */