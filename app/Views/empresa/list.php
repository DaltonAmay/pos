<div class="content-wrapper">

    <div class="content">
        <div class="container-fluid">

            <div class="mt-2"></div>

            <div class="card mb-4">

                <div class="card-header caja d-flex justify-content-between align-items-center">


                    <div class="text-center mx-auto titulo-container">
                        <span class="text-primary titulo h5 d-block" style="font-size: 1.5em;"><?php echo $titulo; ?></span>
                    </div>

                    <div class="ml-auto">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
                            <li class="breadcrumb-item active">Administrar Empresas</li>
                        </ol>
                    </div>
                </div>


                <div class="card-body">

                    <div class="card-header p-0 border-bottom-0">

                        <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">

                            <!-- TAB LISTADO DE SERIES -->
                            <li class="nav-item">
                                <a class="nav-link active my-0" id="listado-empresas-tab" data-toggle="pill" href="#listado-empresas" role="tab" aria-controls="listado-empresas" aria-selected="true"><i class="fas fa-list"></i> Listado</a>
                            </li>

                            <!-- TAB REGISTRO DE SERIES -->
                            <li class="nav-item">
                                <a class="nav-link my-0" id="registrar-empresas-tab" data-toggle="pill" href="#registrar-empresas" role="tab" aria-controls="registrar-empresas" aria-selected="false"><i class="fas fa-file-signature"></i> Registrar</a>
                            </li>
                        </ul>

                    </div>

                    <div class="row">

                        <div class="col-12 ">
                            <div class="card card-primary card-outline card-outline-tabs">

                                <div class="tab-content" id="custom-tabs-four-tabContent">

                                    <div class="tab-pane fade active show" id="listado-empresas" role="tabpanel" aria-labelledby="listado-empresas-tab">

                                        <div class="row">

                                            <div class="col-md-12">
                                                <table id="tbl_empresas" class="tableSis table table-striped w-100 shadow">
                                                    <thead class="bg-main text-left">
                                                        <th>Acciones</th>
                                                        <th>ID</th>
                                                        <th>Razon Social</th>
                                                        <th>Nombre Comercial</th>
                                                        <th>RUC</th>
                                                        <th>Dirección</th>
                                                        <th>Email</th>
                                                        <th>Télefono</th>
                                                        <th>Provincia</th>
                                                        <th>Cantón</th>
                                                        <th>User Sri</th>
                                                        <th>Empr Princ.</th>
                                                        <th>Fecha Creado</th>
                                                        <th>Fecha Actualiza</th>
                                                        <th>Estado</th>
                                                    </thead>
                                                </table>
                                            </div>

                                        </div>

                                    </div>

                                    <!-- TAB CONTENT REGISTRO DE SERIES -->
                                    <div class="tab-pane fade" id="registrar-empresas" role="tabpanel" aria-labelledby="registrar-empresas-tab">

                                        <form id="frm-datos-empresas" class="validar_empresa" novalidate enctype="multipart/form-data">
                                            <div class="container">
                                                <div class="card">
                                                    <div class="card-header">
                                                        Información General
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row">

                                                            <!-- GENERA FACTURACIÓN -->
                                                            <div class="col-lg-2 mb-3">
                                                                <input type="hidden" name="id_empresa" id="id_empresa">
                                                                <label class="mb-0 text-sm my-text-color"><i class="fas fa-file-invoice mr-1 my-text-color"></i> Genera Fact. Elect.?<strong class="text-danger">*</strong></label>
                                                                <div class="form-group clearfix w-100 my-0">
                                                                    <div class="icheck-warning d-inline mx-2">
                                                                        <input type="radio" id="rb-si-genera" value="1" name="rb_genera_facturacion">
                                                                        <label for="rb-si-genera">Si</label>
                                                                    </div>
                                                                    <div class="icheck-success d-inline mx-2">
                                                                        <input type="radio" id="rb-no-genera" value="0" name="rb_genera_facturacion" checked>
                                                                        <label for="rb-no-genera">No</label>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- TIPO DOCUMENTO -->
                                                            <div class="col-lg-2 mb-3">
                                                                <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-id-card-alt mr-1 my-text-color"></i> Tipo Documento <strong class="text-danger fw-bold">*</strong></label>
                                                                <select class="form-select" id="tipo_documento" name="tipo_documento" aria-label="Floating label select example" required>

                                                                </select>
                                                                <div class="invalid-feedback">Seleccione el Tipo de Documento</div>
                                                            </div>

                                                            <!-- NRO DE DOCUMENTO Y RAZÓN SOCIAL -->
                                                            <div class="col-lg-3 mb-3">
                                                                <label class="mb-0 text-sm my-text-color"><i class="fas fa-list-ol mr-1 my-text-color"></i> Nro Documento <strong class="text-danger">*</strong></label>
                                                                <input type="text" class="form-control form-control-sm" id="nro_documento" name="numero_documento" required>
                                                                <div class="invalid-feedback">Ingrese el Nro de Documento</div>
                                                            </div>
                                                            <!-- RAZON SOCIAL -->
                                                            <div class="col-lg-5 mb-3">
                                                                <label class="mb-0 text-sm my-text-color"><i class="fas fa-building mr-1 my-text-color"></i> Razón Social <strong class="text-danger">*</strong></label>
                                                                <input type="text" class="form-control form-control-sm" id="razon_social" name="razon_social" required>
                                                                <div class="invalid-feedback">Ingrese Razón Social</div>
                                                            </div>
                                                            <!-- NOMBRE COMERICIAL -->
                                                            <div class="col-lg-5 mb-3">
                                                                <label class="mb-0 text-sm my-text-color"><i class="fas fa-building mr-1 my-text-color"></i> Nombre Comercial <strong class="text-danger">*</strong></label>
                                                                <input type="text" class="form-control form-control-sm" id="nombre_comercial" name="nombre_comercial" required>
                                                                <div class="invalid-feedback">Ingrese Nombre Comercial</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div id="section-facturacion"></div>

                                                <div class="card mt-4">
                                                    <div class="card-header">
                                                        Datos de Contacto y Ubicación
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <!-- DIRECCIÓN, EMAIL Y TELEFONO -->
                                                            <div class="col-lg-6 mb-3">
                                                                <label class="mb-0 text-sm my-text-color"><i class="fas fa-map-marker-alt mr-1 my-text-color"></i> Dirección <strong class="text-danger">*</strong></label>
                                                                <input type="text" class="form-control form-control-sm" id="direccion" name="direccion" required>
                                                                <div class="invalid-feedback">Ingrese Dirección</div>
                                                            </div>

                                                            <div class="col-lg-3 mb-3">
                                                                <label class="mb-0 text-sm my-text-color"><i class="fas fa-envelope mr-1 my-text-color"></i> Email</label>
                                                                <input type="email" class="form-control form-control-sm" id="email" name="email">
                                                            </div>

                                                            <div class="col-lg-3 mb-3">
                                                                <label class="mb-0 text-sm my-text-color"><i class="fas fa-phone mr-1 my-text-color"></i> Teléfono</label>
                                                                <input type="text" class="form-control form-control-sm" id="telefono" name="telefono">
                                                            </div>

                                                            <!-- PROVINCIA Y DEPARTAMENTO -->
                                                            <div class="col-lg-4 mb-3">
                                                                <label class="mb-0 text-sm my-text-color"><i class="fas fa-map-pin mr-1 my-text-color"></i> Provincia <strong class="text-danger">*</strong></label>
                                                                <input type="text" class="form-control form-control-sm" id="provincia" name="provincia" required>
                                                                <div class="invalid-feedback">Ingrese Provincia</div>
                                                            </div>

                                                            <div class="col-lg-4 mb-3">
                                                                <label class="mb-0 text-sm my-text-color"><i class="fas fa-map-signs mr-1 my-text-color"></i> Cantón <strong class="text-danger">*</strong></label>
                                                                <input type="text" class="form-control form-control-sm" id="canton" name="canton" required>
                                                                <div class="invalid-feedback">Ingrese Cantón</div>
                                                            </div>

                                                            <div class="col-lg-4 mb-3">
                                                                <label class="mb-0 text-sm my-text-color"><i class="fas fa-map-signs mr-1 my-text-color"></i> Código Postal</label>
                                                                <input type="text" class="form-control form-control-sm" id="cod_postal" name="cod_postal">
                                                                <div class="invalid-feedback">Ingrese cod. postal</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="card mt-4">
                                                    <div class="card-header">
                                                        Información Adicional
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <!-- ES EMPRESA PRINCIPAL Y MOSTRAR EN FACTURA O BOLETA POR DEFECTO -->


                                                            <div class="col-lg-6 mb-3">
                                                                <label class="mb-0 text-sm my-text-color"><i class="fas fa-store mr-1 my-text-color"></i> Empresa Principal? </label>
                                                                <div class="form-group clearfix w-100 my-0">
                                                                    <div class="icheck-warning d-inline mx-2">
                                                                        <input type="radio" id="rb-si-empresa" value="1" name="rb_empresa_principal">
                                                                        <label for="rb-si-empresa">Si</label>
                                                                    </div>
                                                                    <div class="icheck-success d-inline mx-2">
                                                                        <input type="radio" id="rb-no-empresa" value="0" name="rb_empresa_principal" checked="">
                                                                        <label for="rb-no-empresa">No</label>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-6 mb-3">
                                                                <label class="mb-0 text-sm my-text-color"><i class="fas fa-file-invoice mr-1 my-text-color"></i> Fact/Not Venta Defecto?</label>
                                                                <div class="form-group clearfix w-100 my-0">
                                                                    <div class="icheck-warning d-inline mx-2">
                                                                        <input type="radio" id="rb-si-defecto" value="1" name="rb_fact_nota_defecto">
                                                                        <label for="rb-si-defecto">Si</label>
                                                                    </div>
                                                                    <div class="icheck-success d-inline mx-2">
                                                                        <input type="radio" id="rb-no-defecto" value="0" name="rb_fact_nota_defecto" checked="true">
                                                                        <label for="rb-no-defecto">No</label>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-6 mb-3">
                                                                <input type="hidden" name="img" id="img">
                                                                <label class="mb-0 text-sm my-text-color">Vista previa logo</label>
                                                                <div class="img-preview" style="width: 100%; padding-top: 30%; position: relative;">
                                                                    <img id="previewImg" src="" class="img-fluid border border-secondary" style="object-fit: fill; position: absolute; top: 0; left: 0; width: 100%; height: 100%;" alt="Vista previa del logo">
                                                                </div>
                                                                <a class="btn btn-danger mt-1" id="btnEliminarLogo"> <i class="fa fa-trash"></i> Eliminar Logo</a>

                                                            </div>

                                                            <!-- IMAGEN Y VISTA PREVIA -->
                                                            <div class="col-lg-6 mb-3">
                                                                <label class="mb-0 text-sm my-text-color"><i class="fas fa-image mr-1 my-text-color"></i> Seleccione logo </label>
                                                                <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*" onchange="previewFile(this)">

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- CANCELAR - GUARDAR -->
                                                <div class="row mt-4">
                                                    <div class="col-6 text-right">
                                                        <button type="button" class="btn btn-danger btn-sm w-75" id="btnCancelarEmpresa">CANCELAR</button>
                                                    </div>
                                                    <div class="col-6">
                                                        <a class="btn btn-success btn-sm w-75" id="btnRegistrarEmpresa">GUARDAR</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>


                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div><!-- /.container-fluid -->
    </div>


    <script>
        $(document).ready(function() {
            cargaTipoDocumentos();
            // $('.selectEntidad').selectpicker();
            fnc_CargarDatatableEmpresas();
            // fnc_AgregarInputsFacturacion();
            fnc_QuitarInputsFacturacion();

            $("#btnRegistrarEmpresa").on('click', function() {
                fnc_GuardarDatosEmpresa();
            });

            $('#tbl_empresas tbody').on('click', '.btnCargarEmpresa', function(e) {
                var id = $(this).data('id');
                fnc_CargaEmpresa($(this), id);
            });

            $('#tbl_empresas tbody').on('click', '.btnDarDeBajEmpresa', function() {
                var id = $(this).data('id');
                fnc_EliminarEmpresa(id);
            })

            $('#tbl_empresas tbody').on('click', '.btnActivarEmpresa', function() {
                var id = $(this).data('id');
                fnc_ActivarEmpresa(id);
            })

            $("#btnCancelarEmpresa").on('click', function() {
                fnc_LimpiarFomulario();
            });

            $("#registrar-empresas-tab").on('click', function() {
                fnc_LimpiarFomulario();

            })

            $("#email").change(function() {
                var pattern = /^[^0-9][.a-zA-Z0-9_]+([.][.a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/;

                if (!pattern.test($("#email").val())) {
                    mensajeToast('warning', 'Formato de email inválido');
                    $("#email").val('');
                    $("#email").focus();
                    return;
                }
            })

            $("#listado-empresas-tab").on('click', function() {
                fnc_LimpiarFomulario();
            })

            $('#btnEliminarLogo').click(eliminarLogo);



            $('input[type=radio][name=rb_genera_facturacion]').change(function() {
                if (this.value == '1') {
                    fnc_AgregarInputsFacturacion();
                    cargaEntidadesCertificadoras();
                } else if (this.value == '0') {
                    fnc_QuitarInputsFacturacion();
                }
            });

                       

        })

        function cargaTipoDocumentos() {
            CargarSelect(2, $("#tipo_documento"), "--Seleccione Tipo Documento--", "empresa/get_tipo_documentos", 'obtener_tipo_documento', null, 1);
        }

        function cargaEntidadesCertificadoras(id = null) {
            $('#idEntidad').empty();
            CargarSelect(id, $("#idEntidad"), "--Seleccione Entidad Certificadoras", "empresa/obtenerEntidades", 'obtenerEntidadesCertificadoras', null, 0);
        }

        function eliminarLogo() {
            var id = $('#id_empresa').val();
            $("#imagen").val(''); //imput file de imagen
            $("#previewImg").attr("src", base_url + "assets/imagenes/logo.jpg"); //logo default
            response = SolicitudAjax('empresa/deleteLogo/' + id, 'POST');
            mensajeToast(response['tipo_msj'], response['msj']);
        };

        function fnc_AgregarInputsFacturacion() {

            $("#section-facturacion").append(
                `
            <div class="card mt-4">
                <div class="card-header">
                    Configuración de Facturación Electrónica
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- ENTIDAD CERTIFICADORA -->
                        <div class="col-lg-4 mb-3">
                            <label class="mb-0 text-sm my-text-color"><i class="fas fa-image mr-1 my-text-color"></i> Seleccione la entidad Certificadora <strong class="text-danger"> *</strong></label>

                            <select class="selectEntidad form-select" aria-label="Default select example" id="idEntidad" name="entiCertificadora" title="Selecciona una Entidad" required>
                            
                            </select>
                        </div>
                        <div id="aviso-existe-certificado" class="col-lg-4 mb-3"> </div>
                       
                        <!-- Seleccionar Certificado Digital -->
                        <div class="col-lg-4 mb-3">
                            <label class="mb-0 text-sm my-text-color"><i class="fas fa-image mr-1 my-text-color"></i> Seleccione el Certificado Digital</label>
                            <input type="file" class="form-control" id="certificado" name="certificado" accept=".p12" required>
                            <div class="invalid-feedback">Seleccione un certificado</div>
                        </div>

                        <!-- Clave Certificado -->
                        <div class="col-lg-3 mb-3">
                            <label class="mb-0 text-sm my-text-color"><i class="fas fa-key mr-1 my-text-color"></i> Clave Certificado</label>
                            <input type="text" class="form-control form-control-sm" id="clave_certificado" name="clave_certificado" required>
                            <div class="invalid-feedback">Ingrese clave</div>
                        </div>

                        <!-- Usuario SRI -->
                        <div class="col-lg-3 mb-3">
                            <label class="mb-0 text-sm my-text-color"><i class="fas fa-user mr-1 my-text-color"></i> Usuario SRI</label>
                            <input type="text" class="form-control form-control-sm" id="usuarioSri" name="usuarioSri" required>
                            <div class="invalid-feedback">Ingrese usuario SRI</div>
                        </div>

                        <!-- Clave SRI -->
                        <div class="col-lg-2 mb-3">
                            <label class="mb-0 text-sm my-text-color"><i class="fas fa-lock mr-1 my-text-color"></i> Clave SRI</label>
                            <input type="text" class="form-control form-control-sm" id="claveSRI" name="claveSRI" required>
                            <div class="invalid-feedback">Ingrese clave SRI</div>
                        </div>
                    </div>
                </div>
            </div>`

            );

            //  cargaEntidadesCertificadoras(null);


        }

        function fnc_QuitarInputsFacturacion() {

            $("#section-facturacion").html('');
        }

        function fnc_CargarDatatableEmpresas() {

            if ($.fn.DataTable.isDataTable('#tbl_empresas')) {
                $('#tbl_empresas').DataTable().destroy();
                $('#tbl_empresas tbody').empty();
            }

            var table = $("#tbl_empresas").DataTable({
                dom: 'Bfrtip',
                buttons: [{
                    text: '<i class="fas fa-sync-alt"></i>',
                    className: 'bg-secondary',
                    action: function(e, dt, node, config) {
                        fnc_CargarDatatableEmpresas();
                    }
                }, {
                    extend: 'excel',
                    title: function() {
                        var printTitle = 'LISTADO DE EMPRESAS';
                        return printTitle
                    }
                }, 'pageLength'],
                pageLength: 10,
                processing: true,
                serverSide: true,
                order: [],

                ajax: {
                    url: 'empresa/listar',
                    type: 'POST'
                },
                scrollX: true,
                initComplete: function(settings, json) {
                    aplicarScrollHorizontal('#tbl_empresas');
                },
                columnDefs: [{
                        targets: 0,
                        orderable: false,
                        createdCell: function(td, cellData, rowData, row, col) {

                            let htmlContent = "";

                            if (rowData[14] == "ACTIVO") {

                                htmlContent += "<span class='fas fa-edit text-primary fs-5 btnCargarEmpresa'  style='cursor:pointer;' data-id='" + rowData[0] + "' title='Editar'></span>";


                                htmlContent += "<span class='text-danger px-1 btnDarDeBajEmpresa' style='cursor:pointer;' data-id='" + rowData[0] + "'>" +
                                    "<i class='fa fa-trash-alt fs-5'></i>" +
                                    "</span>";

                            } else {
                                htmlContent += "<span class='text-success px-1 btnActivarEmpresa' style='cursor:pointer;' data-id='" + rowData[0] + "'>" +
                                    "<i class='ion-arrow-up-c fs-5'></i>" +
                                    "</span>";
                            }

                            $(td).html(htmlContent);
                        }
                    },
                    {
                        targets: 1,
                        visible: false
                    },

                    {
                        targets: 11,
                        createdCell: function(td, cellData, rowData, row, col) {
                            if (rowData[11] == 1) {
                                $(td).html('<i class="fas fa-check text-success mr-1"> SI</i>');
                            } else {
                                $(td).html('<i class="fas fa-exclamation-triangle text-warning mr-1"> NO</i>');
                            }
                        }
                    },
                    {
                        targets: 12,
                        createdCell: function(td, cellData, rowData, row, col) {
                            $(td).css('padding-right', '20px').html('<span class="">' + formatearFechaHora(rowData[12]) + '</span>');
                        }
                    },
                    {
                        targets: 13,
                        createdCell: function(td, cellData, rowData, row, col) {
                            $(td).css('padding-right', '20px').html('<span class="">' + formatearFechaHora(rowData[13]) + '</span>');
                        }
                    },

                    {
                        targets: 14,
                        createdCell: function(td, cellData, rowData, row, col) {
                            if (rowData[14] == 'ACTIVO') {
                                $(td).html('<span class="bg-success px-3 py-1 rounded-pill fw-bold fs-10"> ' + rowData[14] + ' </span>')
                            }

                            if (rowData[14] == 'INACTIVO') {
                                $(td).html('<span class="bg-danger px-2 py-1 rounded-pill fw-bold fs-10"> ' + rowData[14] + ' </span>')
                            }
                        }
                    },

                ],
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
                }
            })

          
        }

        function fnc_GuardarDatosEmpresa() {

            let accion = '';
            var certificado_valido = true;
            var imagen_valida = true;

            form_empresas_validate = validarFormulario('validar_empresa');

            var formData = new FormData();

            //INICIO DE LAS VALIDACIONES
            if (!form_empresas_validate) {
                mensajeToast("error", "Complete los datos obligatorios");
                return;
            }

            Swal.fire({
                title: 'Está seguro(a) de guardar los datos de la Empresa?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si!',
                cancelButtonText: 'No',
            }).then((result) => {

                if (result.isConfirmed) {

                    var file = $("#certificado").val();

                    if (file) {

                        var ext = file.substring(file.lastIndexOf("."));

                        if (ext != ".p12") {
                            mensajeToast('error', "La extensión " + ext + " no es un certificado válido");
                            certificado_valido = false;
                        }

                        if (!certificado_valido) {
                            return;
                        }

                        const inputCertificado = document.querySelector('#certificado');
                        formData.append('archivo[]', inputCertificado.files[0])
                    }

                    var file_image = $("#imagen").val();

                    if (file_image) {

                        var ext = file_image.substring(file_image.lastIndexOf("."));

                        if (ext != ".jpg" && ext != ".png" && ext != ".gif" && ext != ".jpeg" && ext != ".webp") {
                            mensajeToast('error', "La extensión " + ext + " no es una imagen válida");
                            imagen_valida = false;
                        }

                        if (!imagen_valida) {
                            return;
                        }

                        const inputImage = document.querySelector('#imagen');
                        formData.append('archivo_imagen[]', inputImage.files[0]);
                    }

                    if ($("#id_empresa").val() > 0) accion = 'actualizar_empresa'
                    else accion = 'registrar_empresa'

                    formData.append('accion', accion);
                    formData.append('datos_empresa', $("#frm-datos-empresas").serialize());

                    response = SolicitudAjax('empresa/saveAndUpdate', 'POST', formData);
                    if (response.tipo_msj === 'error') {
                        // Si hay errores de validación, muestra los mensajes
                        mostrarErroresValidacion(response.errores);
                    } else {
                        Swal.fire({
                            position: 'center',
                            icon: response['tipo_msj'],
                            title: response['msj'],
                            showConfirmButton: true,
                            timer: 8000
                        });

                        $("#tbl_empresas").DataTable().ajax.reload();
                        fnc_LimpiarFomulario();
                    }
                }

            })
        }

        function mostrarErroresValidacion(errores) {
            // Limpia los errores previos
            $('.is-invalid').removeClass('is-invalid');
            $('.invalid-feedback').remove();
            $('.was-validated').removeClass('was-validated');

            // Itera sobre el objeto de errores y muestra los mensajes en el formulario
            $.each(errores, function(campo, mensaje) {
                var input = $('[name="' + campo + '"]');
                input.addClass('is-invalid');
                input.after('<div class="invalid-feedback">' + mensaje + '</div>');
            });
        }

        function fnc_CargaEmpresa(fila_actualizar, id) {

            if (fila_actualizar.parents('tr').hasClass('selected')) {
                fnc_LimpiarFomulario();
            } else {

                fnc_QuitarInputsFacturacion();

                //ACTIVAR PANE REGISTRO DE PROVEEDORES:
                $("#registrar-empresas-tab").addClass('active')
                $("#registrar-empresas-tab").attr('aria-selected', true)
                $("#registrar-empresas").addClass('active show')

                //DESACTIVAR PANEL LISTADO DE PROVEEDORES:
                $("#listado-empresas-tab").removeClass('active')
                $("#listado-empresas-tab").attr('aria-selected', false)
                $("#listado-empresas").removeClass('active show');

                $("#registrar-empresas-tab").html('<i class="fas fa-sync-alt"></i> Actualizar')

                var data = (fila_actualizar.parents('tr').hasClass('child')) ?
                    $("#tbl_empresas").DataTable().row(fila_actualizar.parents().prev('tr')).data() :
                    $("#tbl_empresas").DataTable().row(fila_actualizar.parents('tr')).data();


                response = SolicitudAjax('empresa/obtenerEmpresa/' + id, 'POST');

                if (response.datoEmp) {
                    const datoEmpresa = response.datoEmp;
                    // Configurar la ruta de la imagen
                    const urlImagen = base_url + `gerencia/empresa/obtenerImagen/${datoEmpresa.id_empresa}`;
                    $("#previewImg").attr("src", urlImagen);

                    $("#id_empresa").val(datoEmpresa.id_empresa);

                    if (datoEmpresa.genera_fact_electronica == "1") {
                        $("#rb-si-genera").prop("checked", true);
                        $("#rb-no-genera").prop("checked", false);
                        fnc_AgregarInputsFacturacion();
                        cargaEntidadesCertificadoras(datoEmpresa.idEntidad);

                    } else {
                        $("#rb-si-genera").prop("checked", false);
                        $("#rb-no-genera").prop("checked", true);
                        fnc_QuitarInputsFacturacion();
                    }

                    $("#tipo_documento").val(datoEmpresa.tipo_documento);
                    $("#nro_documento").val(datoEmpresa.numero_documento);
                    $("#razon_social").val(datoEmpresa.razon_social)
                    $("#nombre_comercial").val(datoEmpresa.nombre_comercial)
                    $("#direccion").val(datoEmpresa.direccion)
                    $("#email").val(datoEmpresa.email)
                    $("#telefono").val(datoEmpresa.telefono)
                    $("#provincia").val(datoEmpresa.provincia)
                    $("#canton").val(datoEmpresa.canton)
                    $("#cod_postal").val(datoEmpresa.cod_postal)

                    if (datoEmpresa.genera_fact_electronica == "1") {
                        $("#clave_certificado").val(datoEmpresa.clave_certificado)
                        $("#usuarioSri").val(datoEmpresa.usuario_sri)
                        $("#claveSRI").val(datoEmpresa.clave_sri)
                    }


                    if (datoEmpresa.empresa_principal == "1") {
                        $("#rb-si-empresa").prop("checked", true);
                        $("#rb-no-empresa").prop("checked", false);
                    } else {
                        $("#rb-si-empresa").prop("checked", false);
                        $("#rb-no-empresa").prop("checked", true);
                    }

                    if (datoEmpresa.factura_default == "1") {
                        $("#rb-si-defecto").prop("checked", true);
                        $("#rb-no-defecto").prop("checked", false);
                    } else {
                        $("#rb-si-defecto").prop("checked", false);
                        $("#rb-no-defecto").prop("checked", true);
                    }

                    //verifica que se haya selecionado 
                    if (datoEmpresa.ruta_certificado != "" || datoEmpresa.ruta_certificado != null) {

                        $("#aviso-existe-certificado").append(`
                            <!-- Mensaje o enlace para indicar que ya existe un certificado -->
                            <div id="infoCertificadoExistente">
                                <p class="text-success text-bold">Ya existe un certificado cargado.!! <a href="${base_url}/empresa/download/${datoEmpresa.id_empresa}" id="descargarCertificado">Descargar Certificado</a></p>
                            </div>
                        `);
                        $('#certificado').prop('required', false);
                    } else {
                        $('#certificado').prop('required', true);
                    }



                }
            }
        }

        function fnc_EliminarEmpresa(id) {

            Swal.fire({
                title: 'Está seguro de eliminar la empresa?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, deseo eliminarla!',
                cancelButtonText: 'Cancelar',
            }).then((result) => {

                if (result.isConfirmed) {

                    response = SolicitudAjax('empresa/deleteEmpresa/' + id, 'POST', );

                    Swal.fire({
                        position: 'top-center',
                        icon: response['tipo_msj'],
                        title: response['msj'],
                        showConfirmButton: true
                    });

                    fnc_CargarDatatableEmpresas();

                }
            })




        }

        function fnc_ActivarEmpresa(id) {

            Swal.fire({
                title: 'Está seguro de Activar la empresa?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, deseo Activar!',
                cancelButtonText: 'Cancelar',
            }).then((result) => {

                if (result.isConfirmed) {

                    response = SolicitudAjax('empresa/activarEmpresa/' + id, 'POST', );

                    Swal.fire({
                        position: 'top-center',
                        icon: response['tipo_msj'],
                        title: response['msj'],
                        showConfirmButton: true
                    });

                    fnc_CargarDatatableEmpresas();

                }
            })




        }

        function fnc_LimpiarFomulario() {

            //LIMPIAR MENSAJES DE VALIDACION
            $(".validar_empresa").removeClass("was-validated");
            $(".form-floating").removeClass("was-validated");

            $('.is-invalid').removeClass('is-invalid');
            $('.invalid-feedback').remove();

            $("#id_empresa").val('');
            cargaTipoDocumentos();
            $("#nro_documento").val('');
            $("#nro_documento").attr('id_empresa', -1)
            $("#razon_social").val('')
            $("#nombre_comercial").val('')
            $("#direccion").val('')
            $("#email").val('')
            $("#telefono").val('')
            $("#provincia").val('')
            $("#canton").val('')
            $("#distrito").val('')
            $("#cod_postal").val('')
            $("#certificado").val('');
            $("#clave_certificado").val('')
            $("#usuarioSri").val('')
            $("#claveSRI").val('')
            $("#imagen").val('');
            $("#previewImg").attr("src", base_url + "assets/imagenes/logo.jpg");
            $("#estado").val('1')

            $("#listado-empresas-tab").prop('disabled', false)

            $("#listado-empresas-tab").addClass('active')
            $("#listado-empresas-tab").attr('aria-selected', true)
            $("#listado-empresas").addClass('active show')

            //DESACTIVAR PANE LISTADO DE PROVEEDORES:
            $("#registrar-empresas-tab").removeClass('active')
            $("#registrar-empresas-tab").attr('aria-selected', false)
            $("#registrar-empresas").removeClass('active show')

            $("#registrar-empresas-tab").html('<i class="fas fa-file-signature"></i> Registrar')


        }

        function ajustarHeadersDataTables(element) {

            var observer = window.ResizeObserver ? new ResizeObserver(function(entries) {
                entries.forEach(function(entry) {
                    $(entry.target).DataTable().columns.adjust();
                });
            }) : null;

            // Function to add a datatable to the ResizeObserver entries array
            resizeHandler = function($table) {
                if (observer)
                    observer.observe($table[0]);
            };

            // Initiate additional resize handling on datatable
            resizeHandler(element);

        }

        // PREVISUALIZAR LA IMAGEN
        function previewFile(input) {

            var file = $("#imagen").get(0).files[0];

            if (file) {
                var reader = new FileReader();

                reader.onload = function() {
                    $("#previewImg").attr("src", reader.result);
                }

                reader.readAsDataURL(file);
            }
        }

        function establecerCertificadoExistente(urlCertificado) {
            var enlaceDescarga = document.getElementById('descargarCertificado');
            if (urlCertificado) {
                // Si hay una URL del certificado, actualizar el href del enlace de descarga
                enlaceDescarga.href = urlCertificado;
                enlaceDescarga.textContent = 'Descargar certificado actual';
            } else {
                // Si no hay certificado, ocultar el mensaje/enlace
                enlaceDescarga.textContent = '';
            }
        }
    </script>