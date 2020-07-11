<?php
/**
 * FactoriaUI.php
 * Factoria de elementod UI
 * @version     1.0
 * @author      Code Develium
 * @since       15/03/2020
 */

namespace App\Librerias\UI;

use App\Librerias\Validate;


/**
 * Class FactoriaUI
 * @package App\Controladores
 */
class FactoriaUI
{
    /**
     * FactoriaUIGrid constructor.
     */
    public function __construct()
    {
    }

    /**
     * Link
     *
     * @param      $txt
     * @param bool $sanitize
     *
     * @return LinkUIElement
     */
    public function Link($txt, $sanitize = true)
    {
        return new LinkUIElement($txt, $sanitize);
    }

    /**
     * @param $valor
     * @param $texto_radio
     *
     * @return RadioButtonUIElement
     */
    public function Radio_button($valor, $texto_radio)
    {
        return new RadioButtonUIElement($valor, $texto_radio);
    }

    /**
     * @param $valor_texto
     *
     * @return TextAreaUIElement
     */
    public function Input_textarea($valor_texto)
    {
        return new TextAreaUIElement($valor_texto);
    }

    /**
     * @param $valor_seleccionado
     *
     * @return ComboUIElement
     */
    public function Input_combo($valor_seleccionado)
    {
        return new ComboUIElement($valor_seleccionado);
    }

    /**
     * @param $valor
     *
     * @return InputHiddenUIElement
     */
    public function Input_hidden($valor)
    {
        return new InputHiddenUIElement($valor);
    }

    /**
     * @param $valor_texto
     *
     * @return InputTextUIElement
     */
    public function Input_text($valor_texto)
    {
        return (new InputTextUIElement($valor_texto));
    }

    /**
     * @return string
     */
    public function Input_search_grid()
    {
        return '<label for="custom-dt-search"><i class="fa fa-search" aria-hidden="true"></i></label> <input type="text" id="custom-dt-search">';
    }

    /**
     * @param string $href
     * @param null   $className
     *
     * @return string
     */
    public function Post_begin(string $href, $className = null)
    {
        //        $token_seguridad  = App::$Seguridad->get_new_token($token_seguridad_orden);
        //        $token_input_name = App::$Seguridad->get_token_form();
        //
        //        $hidden_token = Factory::UI()->Input_hidden($token_seguridad)
        //                               ->set_id_name($token_input_name)->to_html();

        $hidden_token = '';
        return "<form class='form-horizontal {$className}' method='post' action='{$href}'>".$hidden_token;
    }

    /**
     * @return string
     */
    public function Post_end()
    {
        return '</form>';
    }

    /**
     * Label
     *
     * @param $texto
     *
     * @return LabelUIElement
     */
    public function Label($texto)
    {
        return new LabelUIElement($texto);
    }

    public function Label_error($id_target)
    {
        return new LabelErrorUIElement($id_target);
    }


    /**
     * @param null $textoEditar
     *
     * @return ButtonLinkUIElement
     */
    public function Button_editar($textoEditar = null)
    {
        if (Validate::is_empty($textoEditar)) {
            $textoEditar = 'Editar';
        }

        $btn = new ButtonLinkUIElement($textoEditar);

        return $btn->set_titulo('Editar datos');
    }

    /**
     * @param null $textoEliminar
     *
     * @return ButtonLinkUIElement
     */
    public function Button_eliminar($textoEliminar = null)
    {
        if (Validate::is_empty($textoEliminar)) {
            $textoEliminar = 'Eliminar';
        }

        $btn = new ButtonLinkUIElement($textoEliminar);

        return $btn->set_titulo('Eliminar datos');
    }

    /**
     * @param null $textoConsultar
     *
     * @return ButtonLinkUIElement
     */
    public function Button_consultar($textoConsultar = null)
    {
        if (Validate::is_empty($textoConsultar)) {
            $textoConsultar = 'Consultar';
        }

        $btn = new ButtonLinkUIElement($textoConsultar);

        return $btn->set_titulo('Consultar datos');
    }

    /**
     * @param null $textoVolver
     *
     * @return ButtonLinkUIElement
     */
    public function Button_volver($textoVolver = null)
    {
        if (Validate::is_empty($textoVolver)) {
            $textoVolver = 'Volver';
        }

        $btn = new ButtonLinkUIElement($textoVolver);

        return $btn->set_titulo('Volver al listado');
    }

    /**
     * @param null $textoCancelar
     *
     * @return ButtonLinkUIElement
     */
    public function Button_cancelar($textoCancelar = null)
    {
        if (Validate::is_empty($textoCancelar)) {
            $textoCancelar = 'Cancelar';
        }

        $btn = new ButtonLinkUIElement($textoCancelar);

        return $btn->set_titulo('Cancelar datos');
    }

    /**
     * @param null|string $textoGuardar
     *
     * @return ButtonSubmitUIElement
     */
    public function Button_guardar($textoGuardar = null)
    {
        if (Validate::is_empty($textoGuardar)) {
            $textoGuardar = 'Guardar';
        }

        $btn = new ButtonSubmitUIElement($textoGuardar);

        return $btn->set_titulo('Guardar datos');
    }

    /**
     * @param null $texto
     *
     * @return ButtonSubmitUIElement
     */
    public function Button_simple_submit($texto = null)
    {
        return new ButtonSubmitUIElement($texto);

    }

    /**
     * @param null $texto
     *
     * @return ButtonUIElement
     */
    public function Button_simple($texto)
    {
        return new ButtonUIElement($texto);
    }


    /**
     * @param null $texto
     *
     * @return ButtonLinkUIElement
     */
    public function Button_simple_link($texto)
    {
        return new ButtonLinkUIElement($texto);
    }

    /**
     * @param null $textoNuevo
     *
     * @return ButtonLinkUIElement
     */
    public function Button_nuevo($textoNuevo = null)
    {
        if (Validate::is_empty($textoNuevo)) {
            $textoNuevo = 'Nuevo';
        }

        $btn = new ButtonLinkUIElement($textoNuevo);

        return $btn->set_titulo('Crear un nuevo dato');
    }

    /**
     * @param $fa_icon
     *
     * @return IconUIElement
     */
    public function Icon($fa_icon)
    {
        return new IconUIElement($fa_icon);
    }

    /**
     * @param $src
     *
     * @return ImageUIElement
     */
    public function Image($src)
    {
        return new ImageUIElement($src);
    }

    /**
     * @param $id
     *
     * @return GridElement
     */
    public function Grid_header($id)
    {
        return new GridElement($id);
    }

    /**
     * Columna del tipo ID
     * @return GridColumnID
     */
    public function Grid_columnId()
    {
        return new GridColumnID();
    }

    /**
     * @param $title
     *
     * @return GridColumnElement
     */
    public function Grid_column($title)
    {
        return new GridColumnElement($title);
    }

    /**
     * Columna de un grid que contiene un dia y hora
     *
     * @param string $txt
     *
     * @return GridColumnDateTimeElement
     */
    public function Grid_columnDatetime($txt)
    {
        return new GridColumnDateTimeElement($txt);
    }

}
