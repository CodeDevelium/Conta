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
<div id="modal_editar_banco" class="modal modal-editar" role="dialog" data-backdrop="static" data-keyboard="false">

    <div class="modal-dialog">

        <div class="modal-content">
            <form role="form"
                  method="post"
                  action="<?= Banco::ACTION_GUARDAR ?>"
                  enctype="multipart/form-data">
                <input type="hidden"
                       value=""
                       name="<?= Banco::FIELD_ID ?>">
                <div class="modal-header app-modal-header">
                    <button type="button" class="close app-modal-botton-close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Modiciar banco</h4>
                </div>

                <div class="modal-body">
                    <div class="box-body">
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label class="app-control-label" for="banco_nombre_editar">Nombre del banco</label>
                            </div>
                            <div class="col-md-12">
                                <input type="text"
                                       value=""
                                       title="Nombre del banco"
                                       id="banco_nombre_editar"
                                       name="<?= Banco::FIELD_NOMBRE ?>"
                                       class="form-control app-control-input-text"
                                       tabindex="1"
                                       maxlength="<?= Banco::LEN_NOMBRE ?>"
                                       data-rule-maxlength="<?= Banco::LEN_NOMBRE ?>"
                                       data-msg-maxlength="Máximo <?= Banco::LEN_NOMBRE ?> caracteres"
                                       data-rule-required="true" data-msg-required="Valor obligatorio">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label class="app-control-label">Estado</label>
                            </div>
                            <div class="col-md-12">
                                <input type="radio"
                                       value="1"
                                       id="banco_activo_si"
                                       name="<?= Banco::FIELD_ACTIVO ?>"
                                       title="El banco esta activo"
                                       tabindex="2"
                                       data-rule-required="true" data-msg-required="Valor obligatorio"> Activo
                                &nbsp;
                                <input type="radio"
                                       value="0"
                                       id="banco_activo_no"
                                       name="<?= Banco::FIELD_ACTIVO ?>"
                                       title="El banco esta desactivado"
                                       tabindex="3"
                                       data-rule-required="true" data-msg-required="Valor obligatorio"> No activo
                                <div>
                                    <label id="banco_activo_editar-error" class="error" for="banco_activo_editar"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button"
                                class="btn btn-flat btn-default"
                                title="Cancelar datos"
                                data-dismiss="modal">Cancelar</button>&nbsp;
                        <button type="submit"
                                title="Guardar datos"
                                class="btn btn-flat btn-primary">Guardar</button>&nbsp;
                    </div>
                </div>
            </form>

        </div>

    </div>

</div>

