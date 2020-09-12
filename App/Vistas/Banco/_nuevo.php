<?php
/**
 * _nuevo.php
 * Modal nuevi banco
 * @version     1.0
 * @author      Code Develium
 * @since       05/07/2020
 */

use App\Entidades\Banco;

?>
<div id="modal_nuevo_banco" class="modal" role="dialog" data-backdrop="static" data-keyboard="false">

    <div class="modal-dialog">

        <div class="modal-content">

            <form role="form" method="post" action="<?= Banco::ACTION_CREAR ?>" enctype="multipart/form-data">

                <div class="modal-header app-modal-header">
                    <button type="button" class="close app-modal-botton-close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Nuevo banco</h4>
                </div>

                <div class="modal-body">
                    <div class="box-body">
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label class="app-control-label" for="banco_nombre_nuevo">Banco</label>
                            </div>
                            <div class="col-md-12">
                                <input type="text"
                                       value=""
                                       id="banco_nombre_nuevo"
                                       name="banco_nombre_nuevo"
                                       tabindex="1"
                                       maxlength="<?= Banco::LEN_NOMBRE?>"
                                       data-rule-maxlength="<?= Banco::LEN_NOMBRE?>"
                                       data-msg-maxlength="Máximo <?= Banco::LEN_NOMBRE?> caracteres"
                                       title="Nombre del banco"
                                       data-rule-required="true" data-msg-required="Valor obligatorio"
                                       class="form-control">
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

