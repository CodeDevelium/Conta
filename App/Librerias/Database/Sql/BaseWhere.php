<?php
/**
 * BaseWhere.php
 * Condiciones where para sentencias sql
 * @version     1.0
 * @author      Code Develium
 * @since       20/12/2019
 */

namespace App\Librerias\Database\Sql;

use Exception;

/**
 * Class BaseWhere
 * Clase base utilizada por el Select, Update y Delete
 * @package App\Controladores
 */
class BaseWhere extends BaseSql
{
    /**
     * BaseWhere constructor.
     * @throws Exception
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Sentencia INNER JOIN
     *
     * @param string $table
     * @param string $alias
     *
     * @return BaseWhere
     */
    public function &inner_join(string $table, string $alias = ''): BaseWhere
    {
        $this->query .= ' INNER JOIN '.$table;
        if (!empty($alias)) {
            $this->query .= ' AS '.$alias;
        }
        return $this;
    }

    /**
     * Setencia LEFT JOIN
     *
     * @param string $table
     * @param string $alias
     *
     * @return BaseWhere
     */
    public function &left_join(string $table, string $alias = ''): BaseWhere
    {
        $this->query .= ' LEFT JOIN '.$table;
        if (!empty($alias)) {
            $this->query .= ' AS '.$alias;
        }
        return $this;
    }

    /**
     * Sentencia on de un join
     *
     * @param string $predicado1
     *
     * @return BaseWhere
     */
    public function &on(string $predicado1): BaseWhere
    {
        $this->query .= " ON ({$predicado1}) ";
        return $this;
    }

    /**
     * Sentencia on de un join
     *
     * @param string $cond1
     * @param string $cond2
     *
     * @return BaseWhere
     */
    public function &on_equal(string $cond1, string $cond2): BaseWhere
    {
        $this->query .= " ON ({$cond1}={$cond2}) ";
        return $this;
    }

    /**
     * WHERE
     *
     * @param string $predicado1
     *
     * @return BaseWhere
     */
    public function &where(string $predicado1): BaseWhere
    {
        $this->query .= " WHERE ({$predicado1}) ";
        return $this;
    }

    /**
     * WHERE condición de igualdad (numérica)
     *
     * @param string $cond1
     * @param        $cond2
     *
     * @return BaseWhere
     */
    public function &where_equal(string $cond1, $cond2): BaseWhere
    {
        if (is_string($cond2)) {

            $cond2 = filter_var($cond2, FILTER_SANITIZE_STRING);

            if (':' == $cond2[ 0 ]) {
                $this->query .= ' WHERE ('.$cond1.'='.$cond2.')';
            } else {
                $this->query .= ' WHERE ('.$cond1.'="'.$cond2.'")';
            }

        } else {
            $this->query .= " WHERE ({$cond1}={$cond2}) ";
        }
        return $this;
    }

    /**
     * WHERE condición de NO igualdad (numérica)
     *
     * @param string $cond1
     * @param        $cond2
     *
     * @return BaseWhere
     */
    public function &where_not_equal(string $cond1, $cond2): BaseWhere
    {
        if (is_string($cond2)) {

            $cond2 = filter_var($cond2, FILTER_SANITIZE_STRING);

            $this->query .= ' WHERE ('.$cond1.'<>"'.$cond2.'")';
        } else {
            $this->query .= " WHERE ({$cond1}<>{$cond2}) ";
        }
        return $this;
    }

    /**
     * Asigna una condicion AND
     *
     * @param string $predicado1
     *
     * @return BaseWhere
     */
    public function &and_(string $predicado1): BaseWhere
    {
        $this->query .= " AND ({$predicado1}) ";
        return $this;
    }

    /**
     * Asigna una condicion AND de igualdad (numérica)
     *
     * @param string $cond1
     * @param string $cond2
     *
     * @return BaseWhere
     */
    public function &and_equal(string $cond1, string $cond2): BaseWhere
    {
        if (is_string($cond2)) {

            $cond2 = filter_var($cond2, FILTER_SANITIZE_STRING);


            if (':' == $cond2[ 0 ]) {
                $this->query .= ' AND ('.$cond1.'='.$cond2.') ';
            } else {
                $this->query .= ' AND ('.$cond1.'="'.$cond2.'") ';
            }

        } else {
            $this->query .= " AND ({$cond1}={$cond2}) ";
        }
        return $this;
    }

    /**
     * Asigna una condicion AND de diferencia (numérica)
     *
     * @param string $cond1
     * @param string $cond2
     *
     * @return BaseWhere
     */
    public function &and_not_equal(string $cond1, string $cond2): BaseWhere
    {
        if (is_string($cond2)) {
            $cond2       = filter_var($cond2, FILTER_SANITIZE_STRING);
            $this->query .= ' AND ('.$cond1.'<>"'.$cond2.'") ';
        } else {
            $this->query .= " AND ({$cond1}<>{$cond2}) ";
        }

        return $this;
    }

    /**
     * Asigna una condicion OR
     *
     * @param string $cond
     *
     * @return BaseWhere
     */
    public function &or_(string $cond): BaseWhere
    {
        $this->query .= " OR ({$cond}) ";
        return $this;
    }

    /**
     * Asigna una condicion OR de igualdad
     *
     * @param string $cond1
     * @param string $cond2
     *
     * @return BaseWhere
     */
    public function &or_equal(string $cond1, string $cond2): BaseWhere
    {
        if (is_string($cond2)) {

            $cond2 = filter_var($cond2, FILTER_SANITIZE_STRING);

            $this->query .= ' OR ('.$cond1.'="'.$cond2.'") ';
        } else {
            $this->query .= " OR ({$cond1}={$cond2}) ";
        }

        return $this;
    }

    /**
     * Asigna una condicion OR de NO igualdad
     *
     * @param string $cond1
     * @param string $cond2
     *
     * @return BaseWhere
     */
    public function &or_not_equal(string $cond1, string $cond2): BaseWhere
    {
        if (is_string($cond2)) {

            $cond2 = filter_var($cond2, FILTER_SANITIZE_STRING);

            $this->query .= ' OR ('.$cond1.'<>"'.$cond2.'") ';
        } else {
            $this->query .= " OR ({$cond1}<>{$cond2}) ";
        }

        return $this;
    }

    /**
     * Establece un bloque de los registros afectados en el select
     * @return $this
     */
    public function lock_for_update()
    {
        $this->query .= ' FOR UPDATE ';
        return $this;
    }

    /**
     * Añade una sentencia order by a la query, puede haber mas de un campo
     *
     * @param string $fields
     *
     * @return BaseWhere
     */
    public function &order_by(string $fields): BaseWhere
    {
        $this->query .= " ORDER BY {$fields} ";
        return $this;
    }

    /**
     * Ordenación descendente
     *
     * @param string $fields
     *
     * @return BaseWhere
     */
    public function &order_by_desc(string $fields): BaseWhere
    {
        $this->query .= " ORDER BY {$fields} desc";
        return $this;
    }

    /**
     * Ordenaciones posteriores
     *
     * @param string $fields
     *
     * @return BaseWhere
     */
    public function &then_by(string $fields): BaseWhere
    {
        $this->query .= ", {$fields} ";
        return $this;
    }

    /**
     * Ordenaciones posteriores descendentes
     *
     * @param string $fields
     *
     * @return BaseWhere
     */
    public function &then_by_desc(string $fields): BaseWhere
    {
        $this->query .= ", {$fields} desc";
        return $this;
    }


    /**
     * Asigna el límite de registros a devilver
     *
     * @param $num
     *
     * @return BaseWhere
     */
    public function limit($num)
    {
        $this->query .= "  LIMIT {$num}";
        return $this;
    }

}
