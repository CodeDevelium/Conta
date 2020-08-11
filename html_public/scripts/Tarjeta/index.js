let TarjetaIndex = {
    dt: null,
    btnEditar: $(".btnEditarTarjeta"),
    btnEliminar: $(".btnEliminarTarjeta"),
    init: function () {

        this.btnEliminar.click(function (e) {
            var id = JQ.get_attr($(this), 'data-id');
            var nombre = $('td.tarjeta_' + id).html();
            Factory.alert_si_no('¿Desea eliminar la tarjeta ' + nombre + '?',
                function () {
                    var frm = new FormData();
                    frm.append('tarjeta_id', id);
                    Factory.ajax_post('/tarjeta/eliminar', frm,
                        function (ret) {
                            if (!ret.error) {
                                Factory.alert_ok(ret.mensaje, '/tarjeta/index');
                            } else {
                                Factory.alert_error(ret.mensaje, '/tarjeta/index');
                            }
                        },
                        function (ret) {
                            Factory.alert_error('Imposible conectar con el servidor', '/tarjeta/index');
                        });
                });
        });

        // Editar tarjeta
        this.btnEditar.click(function (e) {

            var id = JQ.get_attr($(this), 'data-id');

            var frm = new FormData();
            frm.append('tarjeta_id', id);

            Factory.ajax_post('/tarjeta/buscar', frm,
                function (ret) {
                    if (!ret.error) {

                        j('#tarjeta_id_editar').val(ret.datos.tarjeta_id);
                        j('#tarjeta_nombre_editar').val(ret.datos.tarjeta_nombre);
                        j('#tarjeta_banco_id_editar').val(ret.datos.tarjeta_banco_id);
                        j('#tarjeta_caducidad_editar').val(ret.datos.tarjeta_caduca);

                        if (ret.datos.tarjeta_activa) {
                            j('#tarjeta_activa_si').prop("checked", true);
                        } else {
                            j('#tarjeta_activa_no').prop("checked", true);
                        }

                    } else {
                        Factory.alert_error(ret.mensaje, '/tarjeta/index');
                    }
                },
                function (ret) {
                    Factory.alert_error('Imposible conectar con el servidor', '/tarjeta/index');
                });
        });
    }
};
$(function () {
    TarjetaIndex.init();
});
