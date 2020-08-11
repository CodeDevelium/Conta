<?php
/**
 * InputTextElement.php
 * Input Text
 * @version     1.0
 * @author      Code Develium
 * @since       25/12/2019
 */

namespace App\Librerias\UI;

/**
 * Class InputTextElement
 * @package App\Controladores
 */
class InputTextUIElement extends BaseUIElement implements IUIElement
{
    /**
     * @var string
     */
    private $value;

    /**
     * @var bool
     */
    private $is_date = false;

    /**
     * @var bool
     */
    private $is_datetime = false;

    /**
     * InputTextElement constructor.
     *
     * @param string $value
     */
    public function __construct($value)
    {
        parent::__construct();
        $this->value      = $value;
        $this->tags_html  = '<input type="text" value="[[VALUE]]"';
        $this->class_name = 'form-control';
        return $this;
    }

    public function set_place_holder($txt)
    {
        $this->tags_html .= ' placeholder="'.$txt.'"';
        return $this;
    }

    /**
     * Input tipo password
     * @return $this
     */
    public function is_password()
    {
        $this->tags_html = str_replace('type="text"', 'type="password"', $this->tags_html);
        return $this;
    }

    /**
     * Input tipo Date
     * @return $this
     */
    public function set_is_date()
    {
        $this->is_date = true;
        $formato_fecha = 'dd/mm/aaaa';
        $pattern       = "\\d{2}/\\d{2}/\\d{4}";
        $error         = "Formato de fecha dd/mm/aaaa";

        $this->set_place_holder($formato_fecha);
        $this->set_validacion_min_length(10, $error);
        $this->set_max_length(10);
        $this->tags_html .= ' date_format="true" data-msg-date_format="Fecha incorrecta" ';
        $this->tags_html .= ' data-rule-pattern="'.$pattern.'" data-msg-pattern="'.$error.'" ';
        return $this;
        /*
        jQuery.validator.addMethod(
            "date_format",
            function (value, element) {
                return Factory.validate_is_date(value);
            },
            "Fecha incorrecta"
        );
         */
    }

    /**
     * Input tipo Date y Hora
     * @return $this
     */
    public function is_date_time()
    {
        alert('Pendiente');
        //$this->tags_html = str_replace('type="text"', 'type="datetime-local"', $this->tags_html);
        $this->is_datetime = true;
        $formato_fecha     = 'dd/mm/aaaa hh:mm:ss';
        $pattern           = "\\d{2}/\\d{2}/\\d{4}";
        $error             = "Formato de fecha dd/mm/aaaa";

        $this->set_place_holder($formato_fecha);
        $this->set_validacion_min_length(10, $error);
        $this->set_max_length(10);
        $this->set_place_holder($formato_fecha);
        $this->set_validacion_min_length(19, $error);
        $this->set_max_length(19);
        $this->tags_html .= ' data-rule-pattern="'.$pattern.' \d{2}:\d{2}:\d{2}" data-msg-pattern="'.$error.'" ';
        return $this;
    }

    /**
     * Input ruipo Hora
     * @return $this
     */
    public function is_time()
    {
        $this->tags_html = str_replace('type="text"', 'type="time"', $this->tags_html);
        return $this;
    }

    /**
     * Indica si el input es un número
     *
     * @param int $min
     * @param int $max
     *
     * @return $this
     */
    public function is_number($min, $max)
    {
        $minmax = '';
        //        if (!empty($min)) {
        //            $minmax .= ' min="'.$min.'" ';
        //        }
        //        if (!empty($max)) {
        //            $minmax .= ' max="'.$max.'"';
        //        }
        $this->tags_html = str_replace('type="text"', 'type="number" '.$minmax, $this->tags_html);

        //$this->tags_html .= ' data-rule-range="'.$min.','.$max.'" data-msg-range="'._t('Valor entre %1 y %2', [$min, $max]).'"';
        return $this;
    }

    /**
     * Asigna la longitud máxima
     *
     * @param int $num
     *
     * @return $this
     */
    public function set_max_length($num)
    {
        $this->tags_html .= ' maxlength="'.$num.'"';
        $this->tags_html .= ' data-rule-maxlength="'.$num.'" data-msg-maxlength="Máximo '.$num.' caracteres"';
        return $this;
    }


    /**
     * Validación: Hace que el input sea obligatorio
     * @return $this
     */
    public function set_validacion_obligatorio()
    {
        $this->tags_html .= ' data-rule-required="true" data-msg-required="Valor obligatorio"';
        return $this;
    }

    /**
     * Validación: Obliga a que el contenido del input sea un email
     *
     * @param string $error
     *
     * @return $this
     */
    public function set_validacion_email($error)
    {
        $this->tags_html .= ' data-rule-email="true" data-msg-email="'.$error.'" ';
        return $this;
    }

    /**
     * Validación: Obliga a que el input tenga un mínimo de X caracteres
     *
     * @param int    $min
     * @param string $error
     *
     * @return $this
     */
    public function set_validacion_min_length($min, $error)
    {
        $this->tags_html .= ' data-rule-minlength="'.$min.'" data-msg-minlength="'.$error.'" ';
        return $this;
    }

    /**
     * Validación: Obliga a que el el input sea igual a otro  (#id)
     *
     * @param string $id_iqgual
     * @param string $error
     *
     * @return $this
     */
    public function set_validacion_igual_que($id_iqgual, $error)
    {
        $this->tags_html .= ' data-rule-equalto="'.$id_iqgual.'" data-msg-equalto="'.$error.'"';
        return $this;
    }

    /**
     * Devuelve el tag html como un string
     * @return string
     * @throws \Exception
     */
    public function __toString()
    {
        $html = parent::__toString();
        //        if ($this->is_date) {
        //
        //            $this->value = Helper::display_date($this->value);
        //
        //        } elseif ($this->is_datetime) {
        //
        //            $this->value = Helper::display_dateTime($this->value);
        //        }
        $html = str_replace('[[VALUE]]', $this->value, $html);
        return "{$html}>";
    }

}


