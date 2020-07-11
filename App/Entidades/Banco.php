<?php

/**
 * Tipo de entidad Banco
 * @version     1.1
 * @author      AlexDataDev
 * @since       05/07/2019
 */

namespace App\Entidades;

use App\Librerias\MySql;
use App\Librerias\Post;

/**
 * Class Banco
 */
class Banco extends BaseEntidad
{
    public const TABLA = 'bancos';
    public const ENTIDAD_NOMBRE  = 'App\Entidades\Banco';

    /**
     * Variables de la entidad a mapear con la tabla Banco
     */
    protected
        $banco_id,
        $banco_nombre,
        $banco_activo;

    /**
     * Constantes de los Campos/Columnas de la tabla Banco
     */
    public const
        FIELD_ID = 'banco_id',                     // Autoincrement int
        FIELD_NOMBRE = 'banco_nombre',             // Obligatorio   char(40)
        FIELD_ACTIVO = 'banco_activo',
        LEN_NOMBRE = 50;

    /**
     * Vistas/Acciones del controlador
     */
    public const
        ACTION_INDEX = '/Banco/index',
        ACTION_CONSULTAR = '/Banco/consultar',
        ACTION_EDITAR = '/Banco/editar',
        ACTION_GUARDAR = '/Banco/guardar',
        ACTION_NUEVO = '/Banco/nuevo',
        ACTION_CREAR = '/Banco/crear',
        ACTION_ELIMINAR = '/Banco/eliminar';

    /**
     * Banco constructor.
     *
     * @param null $array_valores
     */
    public function __construct($array_valores = null)
    {
        parent::__construct($array_valores);
    }

    /**
     * Indica si los datos del objeto Banco son válidos
     *
     * @param bool $comprobar_id
     *
     * @return bool
     */
    public function datos_entidad_correctos(bool $comprobar_id = true): bool
    {
        $error_msg = null;
        if( $comprobar_id){
            if( !MySql::is_tiny_int($this->banco_id, true, true,$error_msg)){
                $this->set_error_texto($error_msg, self::FIELD_ID);
                return false;
            }
        }

        /* Nombre */
        if( !MySql::is_str($this->banco_nombre, self::LEN_NOMBRE, true, $error_msg)){
            $this->set_error_texto( $error_msg, self::FIELD_NOMBRE);
            return false;
        }

        /* Activo */
        if( !MySql::is_bool($this->banco_activo, true, $error_msg)){
            $this->set_error_texto( $error_msg, self::FIELD_ACTIVO);
            return false;
        }

        return true;
    }

    /**
     * ID de la entidad Banco
     * @return int|null
     */
    public function get_id(): ?int
    {
        return $this->banco_id;
    }

    /**
     * Id de la entidad Banco
     *
     * @param int|null $id
     */
    public function set_id(?int $id): void
    {
        $this->banco_id = $id;
    }

    /**
     * Nombre de la entidad Banco
     * @return string|null
     */
    public function get_nombre(): ?string
    {
        return $this->banco_nombre;
    }

    /**
     * Nombre de la entidad Banco
     *
     * @param string|null $nombre
     */
    public function set_nombre(?string $nombre): void
    {
        $this->banco_nombre = $nombre;
    }

    /**
     * Activo
     * @return bool
     */
    public function get_activo() : bool
    {
        return $this->banco_activo ?? false;
    }

    /**
     * Activo
     *
     * @param bool $activo
     */
    public function set_activo(bool $activo): void
    {
        $this->banco_activo = $activo;
    }

}   /* Entidad Banco */