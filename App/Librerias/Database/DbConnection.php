<?php
/**
 * DbConnection.php
 * Conexión a la base de datos del tipo MySQL
 * @version     1.0
 * @author      Code Develium
 * @since       12/12/2019
 */

namespace App\Librerias\Database;

use App\App;
use Exception;
use PDO;
use PDOException;
use PDOStatement;

/**
 * Class DbConnection
 * @package App
 */
class DbConnection
{

    /**
     * Handlde de conexión con las base de datos
     * @var PDO
     */
    protected static $hCnn;

    /**
     * Database constructor.
     */
    public function __construct()
    {
    }

    /**
     * Abre una conexión PDO. Singleton
     * @throws Exception
     */
    public function open_conection()
    {
        if (null != self::$hCnn) {
            return;
        }

        $dsn     = 'mysql:host='.App::$Config->get_servidor_db_host().';dbname='.App::$Config->get_servidor_db_name();
        $options = array(
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
            //                PDO::ATTR_AUTOCOMMIT =>  0
            // Si NO se usan bloqueo, Se puede NO usar autocommit y se tendrá que utilizar transacciones
            // Si se usan bloqueos es obligatorio utilizar autocomit, ya que el bloqueo ha de visible por los otros usuarios
        );

        try{
            self::$hCnn = new PDO($dsn,
                                  App::$Config->get_servidor_db_usuario(),
                                  App::$Config->get_servidor_db_psw(),
                                  $options);


        } catch (PDOException $e){
            if (App::$Config->get_debug()) {
                pr($e->getMessage());
            }
            // No lanzamos la excecpión
        } catch (Exception $ex){
            if (App::$Config->get_debug()) {
                pr($ex->getMessage());
            }
            // No lanzamos la excecpión
        }
    }

    /**
     * Cierra una conexión
     */
    public function close()
    {
        self::$hCnn = null;
    }

    /**
     * Ejecuta una query SQL  y devuelve PDOStatement
     *
     * @param string $query
     * @param null   $array_bind
     *
     * @return PDOStatement
     * @throws Exception
     */
    protected function execute_query(string $query, $array_bind = null): PDOStatement
    {
        try{
            // El stmt no puede ser una variable de Database, ya que al ser singleton no podríamos ejecutar
            // dos sentencias SQL a la vez
            $stmt = self::$hCnn->prepare($query); //, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
            if (empty($array_bind)) {
                $stmt->execute();
            } else {
                $stmt->execute($array_bind);
            }
            if (null == $stmt) {
                throw  new Exception('Imposible ejecutar query: '.$query);
            }
            return $stmt; // Devolvemos la sentencia una vez ejecutada

        } catch (PDOException $ex){
            if (App::$Config->get_debug()) {
                pr($ex->getMessage());
            }
            throw  $ex;

        } catch (Exception $ex){

            if (App::$Config->get_debug()) {
                pr($ex->getMessage());
            }
            throw  $ex;
        }
    }

    /**
     * Devuelve el último id insertado
     * @return int
     */
    public function get_last_id(): int
    {
        return self::$hCnn->lastInsertId();
    }

    /**
     * Inicia una transacción en una conexión ya abierta
     */
    public function transaction_begin(): void
    {
        self::$hCnn->beginTransaction();
    }

    /**
     * Realiza un rollbak en una transacción
     */
    public function transaction_rollbak(): void
    {
        if (self::$hCnn != null) {
            self::$hCnn->rollBack();
        }
    }

    /**
     * Realiza un commit en una transacción
     */
    public function transaction_commit(): void
    {
        self::$hCnn->commit();
    }

    /**
     * Evitar clonación
     */
    public function __clone()
    {
        trigger_error('Clone no permitido.', E_USER_ERROR);
    }

    /**
     * Evitar deserialización
     */
    public function __wakeup()
    {
        trigger_error('Desereializar no permitido.', E_USER_ERROR);
    }
}

