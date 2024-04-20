<div class="content-wrapper">

    <div class="content">
        <div class="container-fluid">

            <div class="mt-2"></div>

            <div class="card mb-4">
                <div class="card-header caja d-flex justify-content-between align-items-center">
                    <a id="abreModalAgregar" class="btn btn-info "><i class="fa fa-plus"></i> Agregar Nuevo Cliente</a>

                    <div class="text-center mx-auto titulo-container">
                        <span class="text-primary titulo h5 d-block" style="font-size: 1.5em;"><?php echo $titulo; ?></span>
                    </div>

                    <div class="ml-auto">
                        <div class="btn-group">
                            <a href="<?php echo base_url() ?>administrar/#" class="btn btn-info"><i class="fa fa-trash" aria-hidden="true"></i> Eliminados</a>

                        </div>
                    </div>
                </div>
                <div class="debug_query"></div>

                <div class="card-body">

                    <table class="table table-striped w-100 shadow" id="tbl_clientes">

                        <thead class="bg-main text-left">
                            <tr>
                                <th>Opc.</th>
                                <th>Id Cliente.</th>
                                <th>Id Tipo Doc.</th>
                                <th>Tipo Doc.</th>
                                <th>Num Doc.</th>
                                <th>Apellidos </th>
                                <th>Nombres </th>
                                <th>Dirección</th>
                                <th>Correo</th>
                                <th>Telefono</th>
                                <th>Celular</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody></tbody>

                    </table>
                </div>

            </div>
        </div><!-- /.container-fluid -->


        <!-- ==========================================*/
        MODAL PARA AGREGAR UN NUEVO CLIENTE
        ==========================================*/ -->
        <div class="modal fade" id="mdAgregarCliente" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header bg-gray py-1">
                        <h5 class="modal-title" id="exampleModalLabel">Agregar Nuevo Cliente</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="alert text-alert-formularios alert-styled-left text-blue-800 content-group">
                            <span class="text-semibold ">Estimado usuario</span>
                            Los campos remarcados con <span class="text-danger"> <strong>*</strong> </span> son obligatorios.
                            <button type="button" class="close" data-dismiss="alert">×</button>
                        </div>
                        <form id="frm-datos-clientes" class="validar_cliente_new" novalidate>
                            <div class="row">

                                <div class="col-12 col-lg-3 mb-2">

                                    <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-id-card-alt mr-1 my-text-color"></i> Tipo Documento <strong class="text-danger fw-bold">*</strong></label>
                                    <select class="form-select" id="tipo_documento" name="tipo_documento" aria-label="Floating label select example" required>

                                    </select>
                                    <div class="invalid-feedback">Seleccione el Tipo de Documento</div>


                                </div>

                                <div class="col-12 col-lg-3 mb-2">
                                    <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-id-card mr-1 my-text-color"></i>Nro Documento <strong class="text-danger fw-bold">*</strong></label>
                                    <input type="text" class="form-control form-control-sm" id="nro_documento" onchange="validateJS(event, 'nro_documento')" name="nro_documento" aria-label="Small" aria-describedby="inputGroup-sizing-sm" required>
                                    <div class="invalid-feedback">Ingrese el Nro de Documento</div>
                                </div>

                                <div class="col-12 col-lg-3 mb-2">
                                    <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-user-tie mr-1 my-text-color"></i>Apellido del Cliente <strong class="text-danger fw-bold">*</strong></label>
                                    <input type="text" class="form-control form-control-sm" id="apellido" name="apellido_cliente" aria-label="Small" aria-describedby="inputGroup-sizing-sm" required>
                                    <div class="invalid-feedback">Ingrese el Apellido del Cliente</div>
                                </div>

                                <div class="col-12 col-lg-3 mb-2">
                                    <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-user-tie mr-1 my-text-color"></i>Nombre del Cliente <strong class="text-danger fw-bold">*</strong></label>
                                    <input type="text" class="form-control form-control-sm" id="nombre" name="nombre_cliente" aria-label="Small" aria-describedby="inputGroup-sizing-sm" required>
                                    <div class="invalid-feedback">Ingrese el Nombre del Cliente</div>
                                </div>


                                <div class="col-12 col-lg-5 mb-2">
                                    <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-map-marker-alt mr-1 my-text-color"></i>Dirección <strong class="text-danger fw-bold">*</strong></label>
                                    <input type="text" class="form-control form-control-sm" id="direccion" name="direccion" aria-label="Small" aria-describedby="inputGroup-sizing-sm" required>
                                    <div class="invalid-feedback">Ingrese la dirección del Cliente</div>
                                </div>

                                <div class="col-12 col-lg-3 mb-2">
                                    <label class="mb-0 ml-1 text-sm my-text-color"><i class="fa fa-envelope"></i>Correo <strong class="text-danger fw-bold">*</strong></label>
                                    <input type="text" class="form-control form-control-sm" id="correo" name="correo" aria-label="Small" aria-describedby="inputGroup-sizing-sm" required>
                                    <div class="invalid-feedback">Ingrese el correo del Cliente</div>
                                </div>

                                <div class="col-12 col-lg-2 mb-2">
                                    <label class="mb-0 ml-1 text-sm my-text-color"><i class="fa fa-mobile mr-1 my-text-color"></i>Celular</label>
                                    <input type="text" class="form-control form-control-sm" id="celular" name="celular" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                </div>

                                <div class="col-12 col-lg-2 mb-2">
                                    <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-phone-alt mr-1 my-text-color"></i>Teléfono</label>
                                    <input type="text" class="form-control form-control-sm" id="telefono" name="telefono" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                </div>


                                <div class="col-12 mb-2 mt-2">

                                    <div class="row">
                                        <div class="col-6 text-right">
                                            <a class="btn btn-sm btn-danger fw-bold w-lg-25 w-100" id="btnCancelarCliente" style="position: relative;">
                                                <span class="text-button">CANCELAR</span>
                                                <span class="btn fw-bold icon-btn-danger d-flex align-items-center">
                                                    <i class="fas fa-times fs-5 text-white m-0 p-0"></i>
                                                </span>
                                            </a>

                                        </div>

                                        <div class="col-6 text-left">
                                            <a class="btn btn-sm btn-success  fw-bold w-lg-25 w-100" id="btnRegistrarCliente" style="position: relative;">
                                                <span class="text-button">GUARDAR</span>
                                                <span class="btn fw-bold icon-btn-success d-flex align-items-center">
                                                    <i class="fas fa-save fs-5 text-white m-0 p-0"></i>
                                                </span>
                                            </a>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </form>

                    </div>


                </div>
            </div>
        </div>

        <!-- ==========================================*/
        MODAL PARA EDITAR UN NUEVO CLIENTE
        ==========================================*/ -->
        <div class="modal fade" id="mdEditarCliente" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header bg-gray py-1">
                        <h5 class="modal-title" id="exampleModalLabel">Editar | Cliente</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="alert text-alert-formularios alert-styled-left content-group">
                            <span class="text-semibold ">Estimado usuario</span>
                            Los campos remarcados con <span class="text-danger"> <strong>*</strong> </span> son obligatorios.
                            <button type="button" class="close" data-dismiss="alert">×</button>
                        </div>
                        <form id="frm-datos-clientesEditar" class="validar_cliente_edit">
                            <div class="row">
                                <input type="hidden" name="id_cliente" id="id_cliente">
                                <div class="col-12 col-lg-3 mb-2">
                                    <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-id-card-alt mr-1 my-text-color"></i> Tipo Documento <strong class="text-danger fw-bold">*</strong></label>
                                    <select class="form-select" id="tipo_documentoE" name="tipo_documento" aria-label="Floating label select example" required>
                                    </select>
                                    <div class="invalid-feedback">Seleccione el Tipo de Documento</div>

                                </div>

                                <div class="col-12 col-lg-3 mb-2">
                                    <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-id-card mr-1 my-text-color"></i>Nro Documento <strong class="text-danger fw-bold">*</strong></label>
                                    <input type="text" class="form-control form-control-sm" id="nro_documentoE" onchange="validateJS(event, 'nro_documento')" name="nro_documento" aria-label="Small" aria-describedby="inputGroup-sizing-sm" required>
                                    <div class="invalid-feedback">Ingrese el Nro de Documento</div>
                                </div>

                                <div class="col-12 col-lg-3 mb-2">
                                    <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-user-tie mr-1 my-text-color"></i>Apellido del Cliente <strong class="text-danger fw-bold">*</strong></label>
                                    <input type="text" class="form-control form-control-sm" id="apellidoE" name="apellido_cliente" aria-label="Small" aria-describedby="inputGroup-sizing-sm" required>
                                    <div class="invalid-feedback">Ingrese el Apellido del Cliente</div>
                                </div>

                                <div class="col-12 col-lg-3 mb-2">
                                    <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-user-tie mr-1 my-text-color"></i>Nombre del Cliente <strong class="text-danger fw-bold">*</strong></label>
                                    <input type="text" class="form-control form-control-sm" id="nombreE" name="nombre_cliente" aria-label="Small" aria-describedby="inputGroup-sizing-sm" required>
                                    <div class="invalid-feedback">Ingrese el Nombre del Cliente</div>
                                </div>


                                <div class="col-12 col-lg-5 mb-2">
                                    <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-map-marker-alt mr-1 my-text-color"></i>Dirección <strong class="text-danger fw-bold">*</strong></label>
                                    <input type="text" class="form-control form-control-sm" id="direccionE" name="direccion" aria-label="Small" aria-describedby="inputGroup-sizing-sm" required>
                                    <div class="invalid-feedback">Ingrese la dirección del Cliente</div>
                                </div>

                                <div class="col-12 col-lg-3 mb-2">
                                    <label class="mb-0 ml-1 text-sm my-text-color"><i class="fa fa-envelope"></i>Correo <strong class="text-danger fw-bold">*</strong></label>
                                    <input type="text" class="form-control form-control-sm" id="correoE" name="correo" aria-label="Small" aria-describedby="inputGroup-sizing-sm" required>
                                    <div class="invalid-feedback">Ingrese el correo del Cliente</div>
                                </div>

                                <div class="col-12 col-lg-2 mb-2">
                                    <label class="mb-0 ml-1 text-sm my-text-color"><i class="fa fa-mobile mr-1 my-text-color"></i>Celular</label>
                                    <input type="text" class="form-control form-control-sm" id="celularE" name="celular" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                </div>

                                <div class="col-12 col-lg-2 mb-2">
                                    <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-phone-alt mr-1 my-text-color"></i>Teléfono</label>
                                    <input type="text" class="form-control form-control-sm" id="telefonoE" name="telefono" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                </div>


                                <div class="col-12 mb-2 mt-2">

                                    <div class="row">
                                        <div class="col-6 text-right">
                                            <a class="btn btn-sm btn-danger fw-bold w-lg-25 w-100" id="btnCancelarClienteE" style="position: relative;">
                                                <span class="text-button">CANCELAR</span>
                                                <span class="btn fw-bold icon-btn-danger d-flex align-items-center">
                                                    <i class="fas fa-times fs-5 text-white m-0 p-0"></i>
                                                </span>
                                            </a>

                                        </div>

                                        <div class="col-6 text-left">
                                            <a class="btn btn-sm btn-success  fw-bold w-lg-25 w-100" id="btnUpdateCliente" style="position: relative;">
                                                <span class="text-button">Actualizar</span>
                                                <span class="btn fw-bold icon-btn-success d-flex align-items-center">
                                                    <i class="fas fa-save fs-5 text-white m-0 p-0"></i>
                                                </span>
                                            </a>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </form>

                    </div>


                </div>
            </div>
        </div>



        <script>
            $(document).ready(function() {

                /*==========================================*/
                // INICIALIZO EL SELECT DE TIPO DE DOCUMENTO
                /*==========================================*/
                CargarSelects(null,"tipo_documento");
                /*==========================================*/
                // INICIALIZO LA TABLA DE CLIENTES
                /*==========================================*/
                fnc_CargarDatatableClientes();
                /*==========================================*/
                // INICIALIZO EL SELECT DE TIPO DE DOCUMENTO
                /*==========================================*/
                $('.tipo_documento').selectpicker();
                /*==========================================*/
                // ABRE EL MODAL
                /*==========================================*/
                $("#abreModalAgregar").click(function(e) {
                    $('#mdAgregarCliente').modal('show');
                });
                /*==========================================*/
                // EVENTO QUE CAPTURA EL CLICK EN GUARDAR
                /*==========================================*/
                $("#btnRegistrarCliente").on('click', function() {
                    fnc_GuardarDatosCliente();
                });

                $("#tipo_documento").change(function() {
                    $("#nro_documento").val('');
                    $("#nro_documento").prop('disabled', false);
                    $("#nro_documento").focus();
                    $("#nro_documento").attr('tipo_documento', $("#tipo_documento").val())
                });

                /*==========================================*/
                // EVENTO PARA GUARDAR EL PRODUCTO 
                /*==========================================*/
                $('#saveProducto').click(function(e) {
                    e.preventDefault();
                    guardarCliente();
                });

                $('#tbl_clientes tbody').on('click', '.btnActualizarCliente', function() {
                    var id_cliente = $(this).data('id');
                    obtenerDatoCliente(id_cliente);
                });

                $("#btnCancelarCliente").on('click', function() {
                    limpiarFormulario('#frm-datos-clientes', '.validar_cliente_new');
                });
                $("#btnCancelarClienteE").on('click', function() {
                    limpiarFormulario('#frm-datos-clientesEditar', '.validar_cliente_edit');
                });

                $('#btnUpdateCliente').click(function(e) {
                    e.preventDefault();
                    updateCliente();
                });

                $('#tbl_clientes tbody').on('click', '.btnDarDeBajaCliente', function() {
                    var id_cliente = $(this).data('id');
                    bajaCliente(id_cliente);
                });

                $('#tbl_clientes tbody').on('click', '.btnActivarCliente', function() {
                    var id_cliente = $(this).data('id');
                    altaCliente(id_cliente);
                });

            });

            // FIN document.ready

            function fnc_GuardarDatosCliente() {

                let accion = '';
                form_clientes_validate = validarFormulario('validar_cliente_new');

                //INICIO DE LAS VALIDACIONES
                if (!form_clientes_validate) {
                    mensajeToast("error", "Complete los datos obligatorios");
                    return;
                }

                Swal.fire({
                    title: 'Está seguro(a) de guardar los datos del Cliente?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si!',
                    cancelButtonText: 'No',
                }).then((result) => {

                    if (result.isConfirmed) {

                        if ($("#id_cliente").val() > 0) accion = 'actualizar_cliente'
                        else accion = 'registrar_cliente'

                        var formData = new FormData();

                        formData.append('datos_cliente', $("#frm-datos-clientes").serialize());

                        response = SolicitudAjax('clientes/save', 'POST', formData);

                        Swal.fire({
                            position: 'top-center',
                            icon: response['tipo_msj'],
                            title: response['msj'],
                            showConfirmButton: true
                        });

                        $("#tbl_clientes").DataTable().ajax.reload();
                        limpiarFormulario('#frm-datos-clientes', '.validar_cliente_new');

                    }

                })
            }

            function fnc_CargarDatatableClientes() {
                if ($.fn.DataTable.isDataTable('#tbl_clientes')) {
                    $('#tbl_clientes').DataTable().destroy();
                    $('#tbl_clientes tbody').empty();
                }

                $("#tbl_clientes").DataTable({
                    dom: 'Bfrtip',
                    buttons: [{
                        extend: 'excel',
                        title: function() {
                            var printTitle = 'LISTADO DE CLIENTES';
                            return printTitle;
                        }
                    }, 'pageLength'],
                    lengthMenu: [
                        [5, 10, 30, 50, 100, -1],
                        ['5', '10', '30', '50', '100', 'Todos']
                    ],
                    order: [
                        [1, 'DESC']
                    ],
                    pageLength: 10,
                    serverSide: true,
                    processing: true,

                    ajax: {
                        url: 'clientes/obtenerClientes',
                        type: 'POST'
                    },
                    scrollX: true,
                    language: {
                        url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
                    },

                    columnDefs: [{
                            targets: 0,
                            orderable: false,
                            createdCell: function(td, cellData, rowData, row, col) {
                                let htmlContent = "<span class='btnActualizarCliente text-primary px-1' style='cursor:pointer;' data-id='" + rowData[1] + "'>" +
                                    "<i class='fas fa-pencil-alt fs-6'></i>" +
                                    "</span>";

                                if (rowData[11] == "ACTIVO") {
                                    htmlContent += "<span class='btnDarDeBajaCliente text-danger px-1' style='cursor:pointer;' data-id='" + rowData[1] + "'>" +
                                        "<i class='fa fa-trash-alt fs-5'></i>" +
                                        "</span>";
                                } else {
                                    htmlContent += "<span class='btnActivarCliente text-success px-1' style='cursor:pointer;' data-id='" + rowData[1] + "'>" +
                                        "<i class='ion-arrow-up-c fs-5'></i>" +
                                        "</span>";
                                }

                                $(td).html(htmlContent);
                            }
                        },
                        {
                            targets: [1, 2],
                            visible: false,
                            orderable: false
                        },
                        {
                            targets: 11,
                            createdCell: function(td, cellData, rowData, row, col) {
                                if (rowData[11] != 'ACTIVO') {
                                    $(td).html('<i class="fas fa-exclamation-triangle text-warning mr-1"></i>' + rowData[11]);
                                } else {
                                    $(td).html('<i class="fas fa-check text-success mr-1"></i>' + rowData[11]);
                                }
                            }
                        }
                    ],

                });
            }


            function CargarSelects($idTipoDoc = null, idSelect) {
                CargarSelect($idTipoDoc, $("#" + idSelect), "--Seleccione Tipo Documento--", "get_tipo_documentos", 'obtener_tipo_documento', null, 0);
            }




            var isValid

            function guardarCliente() {

                isValid = true;

                // Lista de campos a validar
                var campos = ['#codBarras', '#nombreProducto', '#preCompra', '#preVenta', '#preVentaMayoreo', '#utilidad', '#stock_min', '#idcategoria', '#selectUnidad'];

                // Limpiar mensajes de error anteriores
                $('.error').remove();

                campos.forEach(function(campo) {
                    var input = $(campo);
                    if ($.trim(input.val()) === '') {
                        isValid = false;
                        input.css('border', '1px solid red');
                        input.after('<span class="error" style="color: red;">Este campo es obligatorio</span>');
                    } else {
                        input.css('border', '');
                    }
                });

                if (isValid) {

                    var form = $('#formAgregarProducto');
                    var formData = form.serialize();

                    $.ajax({
                        url: "productos/save",
                        type: 'POST',
                        data: formData,
                        dataType: 'json',
                        success: function(response) {
                            if (response.error) {
                                Swal.fire({
                                    icon: "error",
                                    title: "Oops...",
                                    text: "Algo salio mal! " + response.messages,
                                    footer: 'Contactate con el administrador'
                                });

                            } else {
                                Swal.fire({
                                    position: "top-end",
                                    icon: "success",
                                    title: "Tu Producto ha sido guardado",
                                    showConfirmButton: false,
                                    timer: 1000
                                });
                                setTimeout(function() {
                                    $("#codBarras").focus();
                                }, 2000); // Ajusta el tiempo si es necesario

                                listarTabla();
                                cleanForm("formAgregarProducto");

                            }
                        },
                        error: function(xhr, status, error) {
                            // Error de AJAX
                            alert('Ha ocurrido un error al guardar el producto');
                        }
                    });

                }


            }

            function obtenerDatoCliente(id_cliente) {

                // Mostrar el modal
                $('#mdEditarCliente').modal('show');
                $.ajax({
                    url: base_url + 'ventas/clientes/obtenerCliente/' + id_cliente,
                    type: 'POST',
                    dataType: 'json',
                    success: function(response) {
                        if (response.datoCliente) {
                            var datosCliente = response.datoCliente;
                            idTipoD = datosCliente.id_tipo_documento;

                            $("#id_cliente").val(datosCliente.id_cliente);
                            $("#nro_documentoE").val(datosCliente.nro_documento);
                            $("#apellidoE").val(datosCliente.apellidos);
                            $("#nombreE").val(datosCliente.nombres);
                            $("#direccionE").val(datosCliente.direccion);
                            $("#correoE").val(datosCliente.correo);
                            $("#celularE").val(datosCliente.celular);
                            $("#telefonoE").val(datosCliente.telefono);
                            CargarSelects(idTipoD, "tipo_documentoE");
                        } else {
                            mensajeToast("error", response.error);
                        }
                    },
                    error: function(err) {
                        mensajeToast("error", response.error);
                    }
                });
            }

            function updateCliente() {
                let accion = '';
                form_clientes_validate = validarFormulario('validar_cliente_edit');

                //INICIO DE LAS VALIDACIONES
                if (!form_clientes_validate) {
                    mensajeToast("error", "Complete los datos obligatorios");
                    return;
                }

                Swal.fire({
                    title: 'Está seguro(a) de actualizar los datos del Cliente?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si!',
                    cancelButtonText: 'No',
                }).then((result) => {

                    if (result.isConfirmed) {

                        var formData = new FormData();
                        formData.append('datos_cliente', $("#frm-datos-clientesEditar").serialize());
                        response = SolicitudAjax('clientes/update', 'POST', formData);

                        Swal.fire({
                            position: 'top-center',
                            icon: response['tipo_msj'],
                            title: response['msj'],
                            showConfirmButton: true
                        });

                        $("#tbl_clientes").DataTable().ajax.reload();
                        limpiarFormulario('#frm-datos-clientesEditar', '.validar_cliente_edit');

                    }

                })
            }

            function bajaCliente($idcli) {

                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: "btn btn-success",
                        cancelButton: "btn btn-danger"
                    },
                    buttonsStyling: false
                });
                swalWithBootstrapButtons.fire({
                    title: "Esta Seguro de eliminar el registro?",
                    text: "Los cambios afectaran a demas registros!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Si, eliminalo ahora!",
                    cancelButtonText: "No, cancela!",
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        response = SolicitudAjax('clientes/delete/' + $idcli, 'POST');
                        Swal.fire({
                            position: 'top-center',
                            icon: response['tipo_msj'],
                            title: response['msj'],
                            showConfirmButton: true
                        });

                        $("#tbl_clientes").DataTable().ajax.reload();
                        limpiarFormulario('#frm-datos-clientesEditar', '.validar_cliente_edit');

                    } else if (
                        /* Read more about handling dismissals below */
                        result.dismiss === Swal.DismissReason.cancel
                    ) {
                        swalWithBootstrapButtons.fire({
                            title: "Cancelado",
                            text: "No se a eliminado al cliente :)",
                            icon: "error"
                        });
                    }
                });
            }

            function altaCliente($idcli) {

                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: "btn btn-success",
                        cancelButton: "btn btn-danger"
                    },
                    buttonsStyling: false
                });
                swalWithBootstrapButtons.fire({
                    title: "Esta Seguro de Activar el registro?",
                    text: "Los cambios afectaran a demas registros!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Si, Actívalo ahora!",
                    cancelButtonText: "No, cancela!",
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        response = SolicitudAjax('clientes/active/' + $idcli, 'POST');
                        Swal.fire({
                            position: 'top-center',
                            icon: response['tipo_msj'],
                            title: response['msj'],
                            showConfirmButton: true
                        });

                        $("#tbl_clientes").DataTable().ajax.reload();
                        limpiarFormulario('#frm-datos-clientesEditar', '.validar_cliente_edit');

                    } else if (
                        /* Read more about handling dismissals below */
                        result.dismiss === Swal.DismissReason.cancel
                    ) {
                        swalWithBootstrapButtons.fire({
                            title: "Cancelado",
                            text: "No se a activado al cliente :)",
                            icon: "error"
                        });
                    }
                });
            }
        </script>
    </div>