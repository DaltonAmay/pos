function aplicarScrollHorizontal(selectorTabla) {
    var table = $(selectorTabla).DataTable();

    var scrollBody = $(table.table().container()).find('div.dataTables_scrollBody');
    
    scrollBody.on('mouseenter', function() {
        $(this).on('wheel', function(e) {
            e.preventDefault();
            this.scrollLeft += e.originalEvent.deltaY;
        });
    }).on('mouseleave', function() {
        $(this).off('wheel');
    });
}

function convertirAMayusculas(selector) {
    $(selector).on('input', function () {
        $(this).val($(this).val().toUpperCase());
    });
}

function formatearFechaHora(fechaHora) {
    var meses = [
        "enero", "febrero", "marzo",
        "abril", "mayo", "junio", "julio",
        "agosto", "septiembre", "octubre",
        "noviembre", "diciembre"
    ];

    var partesFechaHora = fechaHora.split(' ');
    var fecha = partesFechaHora[0].split('-');
    var año = fecha[0];
    var mes = meses[parseInt(fecha[1], 10) - 1]; // Convierte el mes a índice de arreglo (base 0)
    var dia = parseInt(fecha[2], 10); // Quita el cero inicial si existe

    var hora = partesFechaHora[1];

    return dia + ' de ' + mes + ' del ' + año + ' a las ' + hora;
}


function resaltaInput(inputSelector) {
    // Convierte el selector en un objeto jQuery si aún no lo es
    var $input = $(inputSelector);

    $input.addClass('inputJump');
    $input.focus();

    // Eliminar la clase cuando la animación termine para que pueda ser reiniciada si se vuelve a hacer clic
    $input.on('animationend', function () {
        $input.removeClass('inputJump');
    });
}

function recargarTablas($idTabla) {
    if ($.fn.DataTable.isDataTable('#' + $idTabla)) {
        $('#' + $idTabla).DataTable().ajax.reload();
    }
}


function CargarSelect(id = null, id_select = null, txt_option_default, url_request, accion, id_filtro = null, todo_activo = 0) {
    var datos = new FormData();
    datos.append('accion', accion);
    datos.append('id_filtro', id_filtro);

    $.ajax({
        url: url_request,
        type: 'POST',
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function (respuesta) {
            id_select.empty(); // Asegúrate de que id_select es un objeto jQuery
            var options = todo_activo == 1 ? '<option selected value="" class="text-secondary">' + txt_option_default + '</option>'
                : '<option selected value="" class="text-secondary" disabled>' + txt_option_default + '</option>';

            respuesta.forEach(function (item) {
                var selected = (id && item.id == id) ? ' selected' : '';
                options += '<option value="' + item.id + '"' + selected + '>' + item.descripcion + '</option>';
            });

            id_select.html(options);
        }
    });
}

// function CargarSelect(id = null, id_select = null, txt_option_default, url_request, accion, id_filtro = null, todo_activo = 0) {
//     var datos = new FormData();
//     datos.append('accion', accion);
//     datos.append('id_filtro', id_filtro);

//     $.ajax({
//         url: url_request,
//         type: 'POST',
//         data: datos,
//         cache: false,
//         contentType: false,
//         processData: false,
//         dataType: 'json',
//         success: function (respuesta) {
//             id_select.empty();
//             var options = todo_activo == 1 ? '<option selected value="" class="text-secondary">' + txt_option_default + '</option>'
//                 : '<option selected value="" class="text-secondary" disabled>' + txt_option_default + '</option>';

//             respuesta.forEach(function (item) {
//                 options += '<option value="' + item.id + '">' + item.descripcion + '</option>';
//             });

//             id_select.html(options).selectpicker('refresh'); // Actualizar el selectpicker después de añadir las opciones
//         }
//     });
// }


/*=============================================
Función para LIMIPIAR datos de un formulario
=============================================*/
function limpiarFormulario(selectorFormulario, formValidar) {
    // Ocultar el modal si el formulario está dentro de uno, opcional
    $(selectorFormulario).closest('.modal').modal('hide');
    // Limpiar mensajes de validación
    $(selectorFormulario + formValidar).removeClass("was-validated");
    $(selectorFormulario + " .form-floating").removeClass("was-validated");

    // Restablecer los valores de los campos del formulario
    $(selectorFormulario).find('input, select, textarea').each(function () {
        // Restablecer el valor del campo, teniendo en cuenta los diferentes tipos de campos
        switch (this.type) {
            case 'text':
            case 'password':
            case 'textarea':
            case 'file':
            case 'select-one':
            case 'select-multiple':
            case 'date':
            case 'number':
            case 'email':
            case 'tel':
                $(this).val('');
                break;
            case 'checkbox':
            case 'radio':
                this.checked = false;
        }

        // Restablecer propiedades y atributos específicos
        $(this).prop('disabled', false); // Habilitar campos si estaban deshabilitados
        $(this).removeAttr('tipo_documento'); // Remover atributos específicos si se requiere
    });

    // Si estás utilizando algún plugin para los selects, como Select2, puedes necesitar reinicializarlos aquí
    $(selectorFormulario + ' .selectpicker').val(null).trigger('change');

    // Ocultar el modal si el formulario está dentro de uno, opcional
    $(selectorFormulario).closest('.modal').modal('hide');
}


function SolicitudAjax(url_ajax, type_ajax, formData) {

    var response;

    $.ajax({
        async: false,
        url: url_ajax,
        type: type_ajax,
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function (respuesta) {
            response = respuesta;
        }
    });

    return response;

}

/*=============================================
Función para validar formulario
=============================================*/
function validateJS(event, type) {

    /*=============================================
    Validamos texto
    =============================================*/

    if (type == "ruc") {


        var formData = new FormData();

        formData.append('accion', 'validar_ruc');
        formData.append('id_proveedor', event.target.attributes['id_proveedor'].value);
        formData.append('ruc', event.target.value);
        response = SolicitudAjax('ajax/proveedores.ajax.php', 'POST', formData);

        if (response['existe'] > 0) {

            $(event.target).parent().addClass("was-validated");

            $(event.target).parent().children(".invalid-feedback").html("El RUC ya fue registrado");

            event.target.value = "";
            event.target.focus();
            return;
        }


    }

    if (type == "ruc_empresa") {

        var formData = new FormData();

        formData.append('accion', 'validar_ruc_empresa');
        formData.append('id_empresa', event.target.attributes['id_empresa'].value);
        formData.append('ruc', event.target.value);
        response = SolicitudAjax('ajax/empresas.ajax.php', 'POST', formData);

        if (response['existe'] > 0) {

            $(event.target).parent().addClass("was-validated");

            $(event.target).parent().children(".invalid-feedback").html("El RUC ya fue registrado");

            event.target.value = "";
            event.target.focus();
            return;
        }


    }

    if (type == "codigo_tipo_afectacion") {

        var formData = new FormData();

        formData.append('accion', 'validar_codigo_tipo_afectacion');
        formData.append('codigo_tipo_afectacion', event.target.value);
        response = SolicitudAjax('ajax/tipo_afectacion_igv.ajax.php', 'POST', formData);

        if (response['existe'] > 0) {

            $(event.target).parent().addClass("was-validated");

            $(event.target).parent().children(".invalid-feedback").html("El código ya fue registrado");

            event.target.value = "";
            event.target.focus();
            return;
        }


    }

    if (type == "codigo_tipo_documento") {

        var formData = new FormData();

        formData.append('accion', 'validar_codigo_tipo_documento');
        formData.append('codigo_tipo_documento', event.target.value);
        response = SolicitudAjax('ajax/tipo_documento.ajax.php', 'POST', formData);

        if (response['existe'] > 0) {

            $(event.target).parent().addClass("was-validated");

            $(event.target).parent().children(".invalid-feedback").html("El código ya fue registrado");

            event.target.value = "";
            event.target.focus();
            return;
        }


    }


    if (type == "codigo_tipo_comprobante") {

        var formData = new FormData();

        formData.append('accion', 'validar_codigo_tipo_comprobante');
        formData.append('codigo_tipo_comprobante', event.target.value);
        response = SolicitudAjax('ajax/tipo_comprobante.ajax.php', 'POST', formData);

        if (response['existe'] > 0) {

            $(event.target).parent().addClass("was-validated");

            $(event.target).parent().children(".invalid-feedback").html("El código ya fue registrado");

            event.target.value = "";
            event.target.focus();
            return;
        }


    }

    if (type == "codigo_producto") {

        var formData = new FormData();

        formData.append('accion', 'validar_codigo_producto');
        formData.append('codigo_producto', event.target.value);
        response = SolicitudAjax('ajax/productos.ajax.php', 'POST', formData);

        if (response['existe'] > 0) {

            $(event.target).parent().addClass("was-validated");

            $(event.target).parent().children(".invalid-feedback").html("El código ya fue registrado");

            event.target.value = "";
            event.target.focus();
            return;
        }


    }

    if (type == "nro_documento") {

        var formData = new FormData();
        formData.append('accion', 'validar_nro_documento');
        formData.append('id_cliente', event.target.attributes['id_cliente'].value);
        formData.append('tipo_documento', event.target.attributes['tipo_documento'].value);
        formData.append('nro_documento', event.target.value);
        response = SolicitudAjax('ajax/clientes.ajax.php', 'POST', formData);

        if (response['existe'] > 0) {

            $(event.target).parent().addClass("was-validated");

            $(event.target).parent().children(".invalid-feedback").html("El Nro. de Documento ya fue registrado");

            event.target.value = "";
            event.target.focus();
            return;
        }


    }

    if (type == "usuario_sistema") {

        if (event.target.attributes['id_usuario'].value > 0) {

            var formData = new FormData();
            formData.append('accion', 'validar_usuario_sistema');
            formData.append('id_usuario', event.target.attributes['id_usuario'].value);
            formData.append('usuario', event.target.value);
            response = SolicitudAjax('ajax/usuarios.ajax.php', 'POST', formData);

            if (response['existe'] > 0) {

                console.log($(event.target).parent());

                $(event.target).parent().addClass("was-validated");

                $(event.target).parent().children(".invalid-feedback").html("El usuario ya fue registrado");

                event.target.value = "";
                event.target.focus();
                return;
            }
        } else {

            var formData = new FormData();
            formData.append('accion', 'validar_usuario_sistema_nuevo');
            formData.append('usuario', event.target.value);
            response = SolicitudAjax('ajax/usuarios.ajax.php', 'POST', formData);

            if (response['existe'] > 0) {

                console.log($(event.target).parent());

                $(event.target).parent().addClass("was-validated");

                $(event.target).parent().children(".invalid-feedback").html("El usuario ya fue registrado");

                event.target.value = "";
                event.target.focus();
                return;
            }

        }

    }

    if (type == "usuario_login") {

        var formData = new FormData();
        formData.append('accion', 'validar_usuario_sistema_login');
        formData.append('usuario', event.target.value);
        response = SolicitudAjax('ajax/usuarios.ajax.php', 'POST', formData);

        if (response['existe'] == 0) {


            console.log($(event.target).parent());

            $(event.target).parent().addClass("was-validated");

            $(event.target).parent().children(".invalid-feedback").html("El usuario no existe");

            event.target.value = "";
            event.target.focus();
            return;
        } else if (response['existe'] == 1) {
            alert("si existe la gran puta");
        }



    }

    if (type == "text") {

        var pattern = /^[A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,}$/;

        if (!pattern.test(event.target.value)) {

            $(event.target).parent().addClass("was-validated");

            $(event.target).parent().children(".invalid-feedback").html("No ingrese números ni caracteres especiales");

            event.target.value = "";

            return;

        }

    }



    /*=============================================
    Validamos email para registro
    =============================================*/
    if (type == "emailRegister") {


        var pattern = /^[^0-9][.a-zA-Z0-9_]+([.][.a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/;

        if (!pattern.test(event.target.value)) {

            mensajeToast("error", "Ingrese un email Válido")
            event.target.value = ""

            return;

        }
    }

    if (type == "email") {

        var pattern = /^[^0-9][.a-zA-Z0-9_]+([.][.a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/;

        if (!pattern.test(event.target.value)) {

            $(event.target).parent().addClass("was-validated");

            $(event.target).parent().children(".invalid-feedback").html("Formato de email inválido");

            event.target.value = "";

            return;

        }

    }



    /*=============================================
    Validamos teléfono
    =============================================*/

    if (type == "phone") {

        var pattern = /^[-\\(\\)\\0-9 ]{1,}$/;

        if (!pattern.test(event.target.value)) {

            $(event.target).parent().addClass("was-validated");

            $(event.target).parent().children(".invalid-feedback").html("The phone is misspelled");

            event.target.value = "";

            return;

        }

    }



    /*=============================================
    Validamos número
    =============================================*/

    if (type == "numbers") {

        var pattern = /^[.\\,\\0-9]{1,}$/;

        if (!pattern.test(event.target.value)) {

            $(event.target).parent().addClass("was-validated");

            $(event.target).parent().children(".invalid-feedback").html("Ingrese un Nro. correcto");

            event.target.value = "";

            return;

        }

    }

    if (type == "ubigeo") {

        var pattern = /^[.\\,\\0-9]{1,}$/;

        if (!pattern.test(event.target.value)) {

            $(event.target).parent().addClass("was-validated");

            $(event.target).parent().children(".invalid-feedback").html("Ingrese un nro. correcto");

            event.target.value = "";
            event.target.focus();
            return;

        }

        if (event.target.value.length > 6) {

            $(event.target).parent().addClass("was-validated");

            $(event.target).parent().children(".invalid-feedback").html("Ubigeo de 6 dígitos");

            event.target.value = "";
            event.target.focus();
            return;
        }

    }



}


var Fn = {
    // Valida el rut con su cadena completa "XXXXXXXX-X"
    validaRut: function (rutCompleto) {
        if (!/^[0-9]+[-|‐]{1}[0-9kK]{1}$/.test(rutCompleto))
            return false;
        var tmp = rutCompleto.split('-');
        var digv = tmp[1];
        var rut = tmp[0];
        if (digv == 'K') digv = 'k';
        return (Fn.dv(rut) == digv);
    },
    dv: function (T) {
        var M = 0,
            S = 1;
        for (; T; T = Math.floor(T / 10))
            S = (S + T % 10 * (9 - M++ % 6)) % 11;
        return S ? S - 1 : 'k';
    }
}

function validarFormulario(needs_validation) {

    form_validate = false;

    // Get the forms we want to add validation styles to
    var forms = document.getElementsByClassName(needs_validation);
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function (form) {

        if (form.checkValidity() === true) {

            form_validate = true;

        } else {
            form_validate = false;
        }

        form.classList.add('was-validated');

    });

    return form_validate;

}