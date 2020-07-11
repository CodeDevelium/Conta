<?php
/**
 * _nuevo.php
 * Modal nuevi banco
 * @version     1.0
 * @author      Code Develium
 * @since       05/07/2020
 */

use App\Entidades\Banco;
use App\Factory;

$ui = Factory::UI();

?>
<div id="modal_nuevo_banco" class="modal" role="dialog">

    <div class="modal-dialog">

        <div class="modal-content">

            <form role="form" method="post" action="<?= Banco::ACTION_CREAR ?>" enctype="multipart/form-data">

                <div class="modal-header" style="background:#3c8dbc; color:white">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Nuevo banco</h4>
                </div>

                <div class="modal-body">
                    <div class="box-body">
                        <div class="form-group row">
                            <div class="col-md-12">
                                <?= $ui->Label('Banco') ?>
                            </div>
                            <div class="col-md-12">
                                <?= $ui->Input_text(null)
                                       ->set_auto_focus()
                                       ->set_id_name('banco_nombre_nuevo')
                                       ->set_tab_index(1)
                                       ->set_max_length(Banco::LEN_NOMBRE)
                                       ->set_titulo('Nombre del banco')
                                       ->set_validacion_obligatorio() ?>
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

