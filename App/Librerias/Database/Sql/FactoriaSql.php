<?php
/**
 * FactoriaSql.php
 * Factoria de entidades SQL
 * @version     1.0
 * @author      Code Develium
 * @since       15/03/2020
 */

namespace App\Librerias\Database\Sql;

use Exception;

/**
 * Class FactoriaSql
 * @package App\Controladores
 */
class FactoriaSql
{
    /**
     * FactoriaSql constructor.
     */
    public function __construct()
    {
    }

    /**
     * Delete
     *
     * @param string $tabla
     *
     * @return SqlDelete
     * @throws Exception
     */
    public function Delete(string $tabla)
    {
        try{
            return new SqlDelete($tabla);
        } catch (Exception $e){
            throw  $e;
        }
    }

    /**
     * Update
     *
     * @param string $tabla
     * @param string $alias
     *
     * @return SqlUpdate
     * @throws Exception
     */
    public function Update(string $tabla, string $alias = '')
    {
        try{
            return new SqlUpdate($tabla, $alias);
        } catch (Exception $e){
            throw  $e;
        }
    }

    /**
     * Insert
     *
     * @param string $tabla
     *
     * @return SqlInsert
     * @throws Exception
     */
    public function Insert(string $tabla)
    {
        try{
            return new SqlInsert($tabla);
        } catch (Exception $e){
            throw  $e;
        }
    }

    /**
     * Select
     *
     * @param string $tabla
     * @param string $alias
     *
     * @return SqlSelect
     * @throws Exception
     */
    public function Select(string $tabla, string $alias = '')
    {
        try{
            return (new SqlSelect($tabla, $alias));
        } catch (Exception $e){
            throw  $e;
        }
    }

}
