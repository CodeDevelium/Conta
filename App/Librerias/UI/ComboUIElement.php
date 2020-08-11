<?php
/**
 * ComboElement.php
 * Implement un Combo Box
 * @version     1.0
 * @author      Code Develium
 * @since       25/12/2019
 */

namespace App\Librerias\UI;


/**
 * Class ComboElement
 * @package App\Controladores
 */
class ComboUIElement extends BaseUIElement implements IUIElement
{
    /**
     * @var string
     */
    private $valor_seleccionado;

    /**
     * @var string
     */
    private $options;

    /**
     * ComboElement constructor.
     *
     * @param string $valor_seleccionado Valor seleccionado
     */
    public function __construct($valor_seleccionado)
    {
        parent::__construct();
        $this->class_name         = ' form-control ';
        $this->valor_seleccionado = $valor_seleccionado;
        return $this;
    }

    /**
     * Hace que el input sea obligatorio
     * @return $this
     */
    public function set_validacion_bligatorio()
    {
        $this->tags_html .= ' data-rule-required="true" data-msg-required="Valor obligatorio"';
        return $this;
    }

    /**
     * Crea un array de options con 2 valores, SI(1) y NO(0)
     *
     * @param      $incluir_valor_vacio
     * @param null $texto_si
     * @param null $texto_no
     *
     * @return $this
     */
    public function get_array_opciones_si_no($incluir_valor_vacio, $texto_si = null, $texto_no = null)
    {
        alert("Pendiente");
        $this->options = '';
        if ($incluir_valor_vacio) {
            $sel = '';
            if ((''.$this->valor_seleccionado) === ('')) {
                $sel = 'selected';
            }
            $this->options .= '<option '.$sel.' value=""></option>';
        }

        $arrKeyValues      = array();
        $arrKeyValues[ 0 ] = ($texto_no === null ? "No" : $texto_no);
        $arrKeyValues[ 1 ] = ($texto_si === null ? "Si" : $texto_si);

        foreach ($arrKeyValues as $key => $val) {
            $sel = '';
            if ((''.$this->valor_seleccionado) === (''.$key)) {
                $sel = 'selected';
            }
            $this->options .= '<option '.$sel.' value="'.$key.'">'.$val.'</option>';
        }
        return $this;
    }

    /**
     * Asigna los valores del combo de un array key/value. Siempre se encriptan
     *
     * @param array $array_clave_valor
     * @param bool  $incluir_valor_vacio
     * @param bool  $keyValue
     *
     * @return $this
     */
    public function set_array_opciones($array_clave_valor, $incluir_valor_vacio = null, $keyValue = true)
    {
        $this->options = '';
        if ($incluir_valor_vacio) {
            $sel = '';
            if ((''.$this->valor_seleccionado) === ('')) {
                $sel = 'selected';
            }
            $this->options .= '<option '.$sel.' value=""></option>';
        }
        if( $keyValue) {
            foreach ($array_clave_valor as $key => $value) {
                $sel = '';
                if ((''.$this->valor_seleccionado) === (''.$key)) {
                    $sel = 'selected';
                }
                //$key           = Encriptador::get_valor_encriptado($key);
                $this->options .= '<option '.$sel.' value="'.$key.'">'.$value.'</option>';
            }
        }
        else{
            // El array no es clave/valor, es sólo valor
            foreach ($array_clave_valor as $value) {
                $sel = '';
                if ((''.$this->valor_seleccionado) === (''.$value)) {
                    $sel = 'selected';
                }
                $this->options .= '<option '.$sel.' value="'.$value.'">'.$value.'</option>';
            }
        }
        return $this;
    }

    /**
     * Devuelve el tag html como un string
     * @return string
     */
    public function __toString()
    {
        $html = parent::__toString();
        return "<select {$html}>{$this->options}</select>";
    }

}
