<?php
/**
 * _nuevo.php
 * Modal nueva tarjeta de crédito
 * @version     1.0
 * @author      Code Develium
 * @since       11/07/2020
 */

use App\Entidades\Tarjeta;
use App\Factory;

$ui = Factory::UI();

?>
<div id="modal_editar_tarjeta" class="modal" role="dialog" data-backdrop="static" data-keyboard="false">

    <div class="modal-dialog">

        <div class="modal-content">

            <form role="form" method="post" action="<?= Tarjeta::ACTION_GUARDAR ?>" enctype="multipart/form-data">
                <?= $ui->Input_hidden(1)->set_id_name('tarjeta_id_editar') ?>
                <div class="modal-header" style="background:#3c8dbc; color:white">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Modificar tarjeta de crédito</h4>
                </div>

                <div class="modal-body">
                    <div class="box-body">
                        <div class="form-group row">
                            <div class="col-md-12">
                                <?= $ui->Label('Nombre para la tarjeta') ?>
                            </div>
                            <div class="col-md-12">
                                <?= $ui->Input_text(null)
                                       ->set_auto_focus()
                                       ->set_id_name('tarjeta_nombre_editar')
                                       ->set_tab_index(1)
                                       ->set_max_length(Tarjeta::LEN_NOMBRE)
                                       ->set_titulo('Nombre de la tarjeta')
                                       ->set_validacion_obligatorio() ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <?= $ui->Label('Banco') ?>
                            </div>
                            <div class="col-md-12">
                                <?= $ui->Input_combo(null)
                                       ->set_titulo('Banco al que pertenece la tarjeta')
                                       ->set_id_name('tarjeta_banco_id_editar')
                                       ->set_tab_index(2)
                                       ->set_validacion_bligatorio()
                                       ->set_array_opciones($array_bancos, false)
                                ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <?= $ui->Label('Fecha de caducidad') ?>
                            </div>
                            <div class="col-md-12">
                                <?= $ui->Input_text(null)
                                       ->set_is_date()
                                       ->set_id_name('tarjeta_caducidad_editar')
                                       ->set_tab_index(3)
                                       ->set_titulo('Fecha de caducidad de la tarjeta')
                                       ->set_validacion_obligatorio()
                                ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <?= $ui->Label('Estado') ?>
                            </div>
                            <div class="col-md-12">

                                <?= $ui->Radio_button('1', 'Activa')
                                       ->set_id('tarjeta_activa_si')
                                       ->set_name('tarjeta_activa_editar')
                                       ->set_tab_index(2)
                                       ->set_titulo('La tarjeta esta activa')
                                       ->set_validacion_obligatorio() ?>
                                <?= $ui->Radio_button('0', 'No activa')
                                       ->set_id('tarjeta_activa_no')
                                       ->set_name('tarjeta_activa_editar')
                                       ->set_tab_index(3)
                                       ->set_titulo('La tarjeta esta desactivado')
                                ?>
                                <div><?= $ui->Label_error('tarjeta_activa_editar') ?></div>
                            </div>
                        </div>


                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary btn-flat">Guardar</button>
                    </div>
                </div>
            </form>

        </div>

    </div>

</div>

