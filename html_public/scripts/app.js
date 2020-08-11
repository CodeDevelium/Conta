$(function () {
    'use strict';

    $('[data-toggle="control-sidebar"]').controlSidebar();
    $('[data-toggle="push-menu"]').pushMenu();
    var $pushMenu = $('[data-toggle="push-menu"]').data('lte.pushmenu');
    var $controlSidebar = $('[data-toggle="control-sidebar"]').data('lte.controlsidebar');
    var $layout = $('body').data('lte.layout');
    $(window).on('load', function () {
        // Reinitialize variables on load
        $pushMenu = $('[data-toggle="push-menu"]').data('lte.pushmenu')
        $controlSidebar = $('[data-toggle="control-sidebar"]').data('lte.controlsidebar')
        $layout = $('body').data('lte.layout')
    });
    $('.sidebar-menu').tree()

    $("form").on("submit", function () {
        if (!$(this).valid()) {
            return false;
        }
        Factory.screen_lock()
    });

    // Cada vez que se abre una modal
    $("div.modal").on('show.bs.modal', function () {
        Factory.clear_errors();
        Factory.clear_inputs();
    });

    $(".grid").DataTable({

        "language": {

            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ningún dato disponible en esta tabla",
            "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0",
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix": "",
            "sSearch": "Buscar:",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }

        }

    });


});


let Factory = (function () {

    /* Public */
    return {

        validate_is_date: function (fecha) {
            if (!fecha) {
                return false;
            }
            var sdate = null;
            var indate = fecha;
            if (indate.indexOf('-') !== -1) {
                sdate = indate.split('-');
            } else {
                sdate = indate.split('/');
            }
            var y4 = (Math.abs(sdate[2]));
            var chkDate = new Date(Date.parse(sdate[1] + '/' + sdate[0] + '/' + sdate[2]));
            var cmpDate = (chkDate.getMonth() + 1);
            cmpDate += '/' + (chkDate.getDate());
            cmpDate += '/' + (chkDate.getFullYear());
            var indate2 = (Math.abs(sdate[1]));
            indate2 += '/' + (Math.abs(sdate[0]));
            indate2 += '/' + y4;
            if (indate2 !== cmpDate) {
                return false;
            } else {
                if (cmpDate === 'NaN/NaN/NaN') {
                    return false;
                } else {
                    return true;
                }
            }
        },

        /**
         * Pregunta SI/NO
         * @param txt
         * @param fun_si
         * @param fun_no
         */
        alert_si_no: function (txt, fun_si, fun_no) {
            Swal.fire({
                title: txt,
                icon: 'warning',
                animation: false,
                showCancelButton: true,
                cancelButtonText: 'No',
                confirmButtonText: "Si"
            }).then((ret) => {
                if (ret.value) {
                    if (fun_si) {
                        fun_si();
                    }
                } else {
                    if (fun_no) {
                        fun_no();
                    }
                }
            });
        },

        /**
         * Muestra un mensaje de alert de OK
         * @param txt
         * @param url
         */
        alert_ok: function (txt, url) {
            Swal.fire({
                icon: 'success',
                animation: false,
                title: txt
            }).then((result) => {
                if (url) {
                    document.location.href = url;
                }
            });
        },

        /**
         * Muestra un mensaje de alert de error
         * @param txt
         * @param url
         */
        alert_error: function (txt, url) {
            Swal.fire({
                icon: 'error',
                animation: false,
                title: txt
            }).then((result) => {
                if (url) {
                    document.location.href = url;
                }
            });
        },

        /**
         * Elimina los errores en rojo de los inputs
         */
        clear_errors: function () {
            $('input').removeClass('error');
            $('select').removeClass('error');
            $('label.error').html('');
            $('label.error').css('display', 'none');
        },

        /**
         * Elimina el contenido de todos los inputs
         */
        clear_inputs: function () {
            $('input:not(:checkbox):not(:button):not(:radio)').val('');
            $('input[type="radio"]').each(function () {
                $(this).prop('checked', false);
            });
            $('input[type="checkbox"]').each(function () {
                $(this).prop('checked', false);
            });
            $('select').val('');
        },

        /**
         * Blqouea la pentalla
         */
        screen_lock: function () {
            $.blockUI({
                overlayCSS: {backgroundColor: '#E4E4E4'},
                message: '<img alt="Cargando" src="/loading.gif" class="loading" />',
                css: {border: 'none', backgroundColor: 'transparent'},
                baseZ: 2000
            });
        },

        /**
         * Desbloquea l pantalla
         */
        screen_unlock: function () {
            $.unblockUI();
        },

        /**
         * Ajax Post
         * @param url
         * @param frm
         * @param fnSuccess
         * @param fnError
         */
        ajax_post: function (url, frm, fnSuccess, fnError) {
            let my_success = function (data) { //}, status, settings) {
                $.unblockUI();
                if (fnSuccess) {
                    fnSuccess(data);
                }
            };
            let my_error = function (ajaxrequest, ajaxOptions, thrownError) {
                $.unblockUI();
                if (fnError) {
                    fnError();
                } else {
                    alert("Errorrrrrr");
                }
            };
            Factory.screen_lock();
            $.ajax({
                url: url,
                method: "POST",
                data: frm,
                contentType: false,
                processData: false,
                dataType: "json",
                success: my_success,
                error: my_error
            })
        }
    }
})();


// Identificador presente y único
function j(id) {
    let jj = $(id);
    if (0 === jj.length) {
        alert("ID(" + id + ") no encontrado");
        return null;
    }
    if (jj.length > 1) {
        alert("ID (" + id + ") repetido");
        return null;
    }
    return jj;
}

let JQ = (function () {

    /* Public */
    return {

        /**
         * Devuelve el valor de un atributo de un elemento HTML
         * @param j
         * @param attr
         * @param attributo_opcional
         */
        get_attr: function (j, attr, attributo_opcional) {
            let val = j.attr(attr);
            if (typeof val !== typeof undefined && val !== false) {
                return val;
            }
            if (!attributo_opcional) {
                alert("No existe atributo: " + attr);
            }
            return null;

        },
        set_attr: function (j, attr, val_attr) {
            j.attr(attr, val_attr);
        },
        has_class: function (j, class_name) {
            return j.hasClass(class_name);
        },
        add_class: function (j, class_name) {
            j.addClass(class_name);
        },
        get_height: function (j) {
            return j.height();
        },
        get_css: function (j, item_css) {
            return j.css(item_css);
        },
        set_css: function (j, item_css, value_css) {
            j.css(item_css, value_css);
        },
        get_value: function (j) {
            return j.val();
        },
        set_value: function (j, val) {
            j.val(val);
        }

    }
})();


/**
 * Añadimos a la validación jquery la validación de una fecha
 */
jQuery.validator.addMethod(
    "date_format",
    function (value, element) {
        return Factory.validate_is_date(value);
    },
    "Fecha incorrecta"
);