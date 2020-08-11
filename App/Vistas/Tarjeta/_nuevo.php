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
<div id="modal_nueva_tarjeta" class="modal" role="dialog" data-backdrop="static" data-keyboard="false">

    <div class="modal-dialog">

        <div class="modal-content">

            <form role="form" method="post" action="<?= Tarjeta::ACTION_CREAR ?>" enctype="multipart/form-data">

                <div class="modal-header" style="background:#3c8dbc; color:white">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Nueva tarjeta de crédito</h4>
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
                                       ->set_id_name('tarjeta_nombre_nuevo')
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
                                       ->set_id_name('tarjeta_banco_id_nuevo')
                                       ->set_tab_index(2)
                                       ->set_validacion_bligatorio()
                                       ->set_array_opciones($array_bancos, true)
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
                                       ->set_id_name('tarjeta_caducidad_nuevo')
                                       ->set_tab_index(3)
                                       ->set_titulo('Fecha de caducidad de la tarjeta')
                                       ->set_validacion_obligatorio()
                                ?>
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

