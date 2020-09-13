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

?>
<div id="modal_editar_tarjeta" class="modal" role="dialog" data-backdrop="static" data-keyboard="false">

    <div class="modal-dialog">

        <div class="modal-content">

            <form role="form" method="post" action="<?= Tarjeta::ACTION_GUARDAR ?>" enctype="multipart/form-data">
                <input type="hidden"
                       value="1"
                       id="tarjeta_id_editar"
                       name="tarjeta_id_editar">
                <div class="modal-header app-modal-header">
                    <button type="button" class="close app-modal-botton-close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Modificar tarjeta de crédito</h4>
                </div>

                <div class="modal-body">
                    <div class="box-body">
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label class="app-control-label" for="tarjeta_nombre_editar">Nombre para la tarjeta</label>
                            </div>
                            <div class="col-md-12">
                                <input type="text"
                                       value=""
                                       id="tarjeta_nombre_editar"
                                       name="tarjeta_nombre_editar"
                                       tabindex="1"
                                       maxlength="<?= Tarjeta::LEN_NOMBRE ?>"
                                       data-rule-maxlength="<?= Tarjeta::LEN_NOMBRE ?>"
                                       data-msg-maxlength="Máximo <?= Tarjeta::LEN_NOMBRE ?> caracteres"
                                       title="Nombre de la tarjeta"
                                       data-rule-required="true" data-msg-required="Valor obligatorio"
                                       class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label class="app-control-label" for="tarjeta_banco_id_editar">Banco</label>
                            </div>
                            <div class="col-md-12">
                                <select id="tarjeta_banco_id_editar"
                                        name="tarjeta_banco_id_editar"
                                        tabindex="2"
                                        title="Banco al que pertenece la tarjeta"
                                        data-rule-required="true" data-msg-required="Valor obligatorio"
                                        class="form-control">
                                    <?php
                                    foreach ($array_bancos as $key => $value){
                                        echo "<option value='{$key}'>{$value}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label class="app-control-label" for="tarjeta_caducidad_editar">Fecha de caducidad</label>
                            </div>
                            <div class="col-md-12">
                                <input type="text"
                                       value=""
                                       id="tarjeta_caducidad_editar"
                                       name="tarjeta_caducidad_editar"
                                       tabindex="3"
                                       placeholder="dd/mm/aaaa"
                                       title="Fecha de caducidad de la tarjeta"
                                       maxlength="10" data-rule-maxlength="10"  data-msg-maxlength="Máximo 10 caracteres"
                                       app-formato-fecha="true" data-msg-app-formato-fecha="Fecha incorrecta"
                                       data-rule-pattern="\d{2}/\d{2}/\d{4}" data-msg-pattern="Formato de fecha dd/mm/aaaa"
                                       data-rule-required="true" data-msg-required="Valor obligatorio"
                                       class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label class="app-control-label">Estado</label>
                            </div>
                            <div class="col-md-12">

                                <input type="radio"
                                       value="1"
                                       id="tarjeta_activa_si"
                                       name="tarjeta_activa_editar"
                                       tabindex="2"
                                       title="La tarjeta esta activa"
                                       data-rule-required="true" data-msg-required="Valor obligatorio">&nbsp;Activa&nbsp;
                                <input type="radio"
                                       value="0"
                                       id="tarjeta_activa_no"
                                       name="tarjeta_activa_editar"
                                       tabindex="2"
                                       title="La tarjeta esta desactiva">&nbsp;No Activa&nbsp;
                                <div>
                                    <label id="tarjeta_activa_editar-error"
                                           class="error"
                                           for="tarjeta_activa_editar"
                                           style="display: none;"></label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button"
                                class="btn btn-default btn-flat"
                                data-dismiss="modal">Cancelar</button>
                        <button type="submit"
                                title="Guardar datos"
                                class="btn btn-flat btn-primary">Guardar</button>&nbsp;
                    </div>
                </div>
            </form>

        </div>

    </div>

</div>

