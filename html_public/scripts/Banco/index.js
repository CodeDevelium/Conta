let BancosIndex = {
    dt: null,
    btnEditar: $(".btnEditarBanco"),
    btnEliminar: $(".btnEliminarBanco"),
    init: function () {

        // Eliminar banco
        this.btnEliminar.click(function (e) {
            var banco_id = JQ.get_attr($(this), 'data-id');
            var nombre = $('td.banco_' + banco_id).html();
            Factory.alert_si_no('¿Desea eliminar el banco ' + nombre + '?',
                function () {
                    var frm = new FormData();
                    frm.append('banco_id', banco_id);
                    Factory.ajax_post('/banco/eliminar', frm,
                        function (ret) {
                            if (!ret.error) {
                                Factory.alert_ok(ret.mensaje, '/banco/index');
                            } else {
                                Factory.alert_error(ret.mensaje, '/banco/index');
                            }
                        },
                        function (ret) {
                            Factory.alert_error('Imposible conectar con el servidor', '/banco/index');
                        });
                });
        });

        // Editar banco
        this.btnEditar.click(function (e) {

            var banco_id = JQ.get_attr($(this), 'data-id');

            var frm = new FormData();
            frm.append('banco_id', banco_id);

            Factory.ajax_post('/banco/buscar', frm,
                function (ret) {
                    if (!ret.error) {
                        debugger;
                        j('#banco_nombre_editar').val(ret.datos.banco_nombre);
                        j('#banco_id_editar').val(ret.datos.banco_id);
                        if(ret.datos.banco_activo){
                            j('#banco_activo_si').prop( "checked", true);
                        }
                        else{
                            j('#banco_activo_no').prop( "checked", true);
                        }

                    } else {
                        Factory.alert_error(ret.mensaje, '/banco/index');
                    }
                },
                function (ret) {
                    Factory.alert_error('Imposible conectar con el servidor', '/banco/index');
                });
        });
    }
};
$(function () {
    BancosIndex.init();
});
