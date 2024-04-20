<div class="content-wrapper">

    <div class="content">
        <div class="container-fluid">

            <div class="mt-2"></div>

            <div class="card mb-4">
                <div class="card-header caja d-flex justify-content-between align-items-center">

                    <div class="text-center mx-auto titulo-container">
                        <span class="text-primary titulo h5 d-block" style="font-size: 1.5em;"><?php echo $titulo; ?></span>
                    </div>
                </div>

                <div class="card-body">
                    <div class="content pb-2">
                        <div class="row p-0 m-0">

                            <div class="col-12 col-lg-4">

                                <div class="card card-gray shadow">

                                    <div class="card-header">
                                        <h3 class="card-title"><i class="fas fa-edit"></i> Registro de <?php echo $titulo; ?></h3>
                                    </div>

                                    <div class="card-body">

                                        <form class="validarFormSerie" novalidate id="formSeries">

                                            <div class="row">

                                                <div class="col-md-12">

                                                    <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-id-card-alt mr-1 my-text-color"></i> Tipo Documento <strong class="text-danger fw-bold">*</strong></label>
                                                    <select class="form-select" id="tipoComprobante" name="tipoComprobante" aria-label="Floating label select example" required></select>
                                                    <div class="invalid-feedback">Seleccione el Tipo de Documento</div>
                                                </div>

                                                <div class="col-md-12">

                                                    <input type="hidden" name="idSerie" id="idSerie">


                                                    <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-receipt"></i> </i> Serie <span class="text-danger">(*)</span></label>

                                                    <input type="text" style="border-radius: 20px;" class="form-control form-control-sm" id="serie" name="serie" aria-label="Small" aria-describedby="inputGroup-sizing-sm" required>
                                                    <div class="invalid-feedback">Ingrese una serie</div>
                                                </div>


                                                <div class="col-md-12">
                                                    <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-layer-group mr-1 my-text-color"></i>Numero Inicial <span class="text-danger">(*)</span></label>


                                                    <input type="text" style="border-radius: 20px;" class="form-control form-control-sm" id="numInicial" name="numInicial" aria-label="Small" aria-describedby="inputGroup-sizing-sm" required>
                                                    <div class="invalid-feedback">Ingrese el número inicial</div>
                                                </div>

                                                <div class="col-md-12 mt-3 text-center">
                                                    <a class="btn btn-sm btn-success  fw-bold btnAccion" id="btnRegistrarSerie" style="position: relative; width: 50%;">
                                                        <span class="text-button">GUARDAR</span>
                                                        <span class="btn fw-bold icon-btn-success d-flex align-items-center">
                                                            <i class="fas fa-save fs-5 text-white m-0 p-0"></i>
                                                        </span>
                                                    </a>
                                                </div>

                                            </div>

                                        </form>

                                    </div>

                                </div>

                            </div>

                            <!--LISTADO DE CATEGORIAS -->
                            <div class="col-12 col-lg-8">
                                <div class="card card-gray shadow">
                                    <div class="card-header">
                                        <h3 class="card-title"><i class="fas fa-list"></i> Listado <?php echo $titulo; ?></h3>
                                    </div>
                                    <div class="card-body">
                                        <table id="tblSeries" class="table table-striped w-100 shadow border border-secondary">
                                            <thead class="bg-main text-left">
                                                <th>Id</th>
                                                <th>Serie</th>
                                                <th>Tipo Comprobante</th>
                                                <th>Num. Inicial</th>
                                                <th>Num. Actual</th>
                                                <th>Estado</th>
                                                <th>Opciones</th>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!--FORMULARIO PARA REGISTRO Y EDICION -->
                        </div>

                    </div>

                </div>

            </div>
        </div><!-- /.container-fluid -->

    </div>

    <script>
        $(document).ready(function() {
            listarSeries();
            cargarComprobante();

            //EVENTO DEL BOTON GUARDAR
            $(document).on('click', '#btnRegistrarSerie', function(e) {
                e.preventDefault();
                guardarComprobantes();
            });

            // Utiliza la delegación de eventos para vincular el evento click al nuevo ID
            //EVENTO DEL BOTON ACTUALIZAR
            $(document).on('click', '#btnActualizarSerie', function(e) {
                e.preventDefault();
                actualizarSerie();
            });

            //boton para cargar el dato en el imput
            $('#tblSeries').on('click', '#btnCargaSeries', function(e) {
                e.stopPropagation(); // Detiene la propagación del evento
                var id = $(this).data('id');
                obtenerSerie(id);
            });

            // Evento para dar de baja
            $('#tblSeries').on('click', '#btnBajaComprobante', function(e) {
                e.stopPropagation(); // Detiene la propagación del evento
                var id = $(this).data('id');
                darDeBajaSerie(id);
            });

            //Evento para activar el tipo de documento
            $('#tblSeries').on('click', '#btnActivarTipoDoc', function(e) {
                e.stopPropagation(); // Detiene la propagación del evento
                var id = $(this).data('id');
                activarSerie(id);
            });
            convertirAMayusculas('#codigo');
            convertirAMayusculas('#descripcion');

        });

        function cargarComprobante(idComprobante=null) {
            CargarSelect(idComprobante, $("#tipoComprobante"), "--Seleccione el Comprobante--", "comprobantes/get_tipoComprobantes", 'obtener_tipoComprobante', null, 1);
        }


        function listarSeries() {
            if ($.fn.DataTable.isDataTable('#tblSeries')) {
                $('#tblSeries').DataTable().destroy();
                $('#tblSeries tbody').empty();
            }
            table = $('#tblSeries').DataTable({
                dom: 'Bfrtip',
                buttons: [{
                    text: '<i class="fas fa-sync-alt"></i>',
                    className: 'bg-secondary',
                    action: function(e, dt, node, config) {
                        listarSeries();
                    }
                }, {
                    extend: 'excel',
                    title: function() {
                        var printTitle = 'LISTADO DE SERIES';
                        return printTitle
                    }
                }, 'pageLength'],
                processing: true,
                serverSide: true,
                order: [],
                ajax: {
                    url: 'series/list',
                    type: 'POST'
                },
                scrollX: true,
                columnDefs: [{
                        targets: [0],
                        visible: false,
                    }, {
                        targets: 5,
                        createdCell: function(td, cellData, rowData, row, col) {

                            if (rowData[5] == 'ACTIVO') {
                                $(td).html('<span class="bg-success px-2 py-1 rounded-pill fw-bold"> ' + rowData[5] + ' </span>')
                            }

                            if (rowData[5] == 'INACTIVO') {
                                $(td).html('<span class="bg-danger px-2 py-1 rounded-pill fw-bold"> ' + rowData[5] + ' </span>')
                            }

                        }
                    },
                    {
                        targets: 6,
                        createdCell: function(td, cellData, rowData, row, col) {

                            let htmlContent = "";

                            if (rowData[5] == "ACTIVO") {

                                htmlContent += "<span class='fas fa-edit text-primary fs-5' id='btnCargaSeries' style='cursor:pointer;' data-id='" + rowData[0] + "' title='Editar'>";


                                htmlContent += "<span class='text-danger px-1' id='btnBajaComprobante' style='cursor:pointer;' data-id='" + rowData[0] + "'>" +
                                    "<i class='fa fa-trash-alt fs-5'></i>" +
                                    "</span>";
                            } else {
                                htmlContent += "<span class='text-success px-1' id='btnActivarTipoDoc' style='cursor:pointer;' data-id='" + rowData[0] + "'>" +
                                    "<i class='ion-arrow-up-c fs-5'></i>" +
                                    "</span>";
                            }

                            $(td).html(htmlContent);

                        }
                    },


                ],
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
                }
            });
        }

        function guardarComprobantes() {
            formValidateSerie = validarFormulario('validarFormSerie');
            if (!formValidateSerie) {
                mensajeToast("error", "Complete los datos obligatorios");
                return;
            }
            Swal.fire({
                title: 'Está seguro(a) de guardar esta serie ?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si!',
                cancelButtonText: 'No',
            }).then((result) => {
                if (result.isConfirmed) {
                    var formData = new FormData();
                    formData.append('datosSerie', $("#formSeries").serialize());
                    response = SolicitudAjax('series/save', 'POST', formData);
                    Swal.fire({
                        position: 'top-center',
                        icon: response['tipo_msj'],
                        title: response['msj'],
                        showConfirmButton: true
                    });
                    listarSeries();
                    limpiarFormulario('#formSeries', '.validarFormSerie');
                }

            })

        }

        function resaltaInput(inputSelector) {
            // Convierte el selector en un objeto jQuery si aún no lo es
            var $input = $(inputSelector);

            $input.addClass('inputJump');
            $input.focus();

            // Eliminar la clase cuando la animación termine para que pueda ser reiniciada si se vuelve a hacer clic
            $input.on('animationend', function() {
                $input.removeClass('inputJump');
            });
        }

        function cambiadeEstadoBotonYInput(botonSelector, nuevoTextoBoton, claseBotonRemover, claseBotonAgregar, claseIconoRemover, claseIconoAgregar, nuevoIdBoton, idForm, formActualizar, inputSelector) {
            var $boton = $(botonSelector);

            // Mantener el ancho original si se define en línea
            var anchoOriginal = $boton[0].style.width;

            // Cambiar el texto del botón, si se proporciona
            if (nuevoTextoBoton) {
                $boton.find(".text-button").text(nuevoTextoBoton);
            }

            // Cambiar las clases del botón para el color, asegurándonos de mantener el tamaño
            if (claseBotonRemover && claseBotonAgregar) {
                $boton.removeClass(claseBotonRemover).addClass(claseBotonAgregar);
            }

            // Asegurar que el botón siga siendo pequeño ('btn-sm') si ya tenía esa clase
            if (!$boton.hasClass('btn-sm')) {
                $boton.addClass('btn-sm');
            }

            // Cambiar las clases del ícono y su contenedor, si se proporcionan
            if (claseIconoRemover && claseIconoAgregar) {
                var $iconContainer = $boton.find('.icon-' + claseBotonRemover);
                $iconContainer.removeClass('icon-' + claseBotonRemover).addClass('icon-' + claseBotonAgregar);
                $iconContainer.find('i').removeClass(claseIconoRemover).addClass(claseIconoAgregar);
            }

            // Cambiar el ID del botón, si se proporciona
            if (nuevoIdBoton) {
                $boton.off(); // Desvincular todos los eventos del botón actual antes de cambiar el ID
                $boton.attr('id', nuevoIdBoton);
            }

            // Cambio de ID del formulario, si se proporciona
            if (idForm && formActualizar) {
                $('#' + idForm).off();
                $('#' + idForm).attr('id', formActualizar);
            }

            // Hacer focus en el input especificado, si se proporciona
            if (inputSelector) {
                $(inputSelector).focus();
            }

            // Restaurar el ancho original si estaba definido
            if (anchoOriginal) {
                $boton.css('width', anchoOriginal);
            }
        }

        function obtenerSerie(id) {
            response = SolicitudAjax('series/get/' + id, 'GET');
            var datoSerie = response.datoComprobante;
            // Rellenar los campos del modal con los datos obtenidos
            $('#idSerie').val(datoSerie.id);
            $('#serie').val(datoSerie.serie);
            $('#numInicial').val(datoSerie.numero_inicial);
            cargarComprobante(datoSerie.id_tipo_comprobante);
            //animacion al input
            resaltaInput("#serie");
            resaltaInput("#tipoComprobante");
            cambiadeEstadoBotonYInput(
                '#btnRegistrarSerie', // Selector del botón
                'ACTUALIZAR', // Nuevo texto para el botón
                'btn-success', // Clase a remover del botón
                'btn-primary', // Clase a agregar al botón
                'fa-save', // Clase a remover del ícono
                'fa-sync', // Clase a agregar al ícono
                'btnActualizarSerie', // Nuevo ID para el botón
                'formSeries', //ID del formulario anterior
                'formSerieActualizar', //Nuevo ID del form
                '#serie' // Selector del input para hacer focus
            );

        }

        function actualizarSerie() {

            formValidateSerie = validarFormulario('validarFormSerie');
            if (!formValidateSerie) {
                mensajeToast("error", "Complete los datos obligatorios");
                return;
            }
            Swal.fire({
                title: 'Está seguro(a) de actualizar la serie?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si!',
                cancelButtonText: 'No',
            }).then((result) => {
                if (result.isConfirmed) {
                    var formData = new FormData();
                    formData.append('datoSerie', $("#formSerieActualizar").serialize());
                    response = SolicitudAjax('series/update', 'POST', formData);
                    Swal.fire({
                        position: "center",
                        icon: response['tipo_msj'],
                        title: response['msj'],
                        showConfirmButton: true,
                        timer: 6000
                    });

                    recargarTablas('tblSeries');
                    limpiarFormulario('#formSerieActualizar', '.validarFormSerie');
                    cambiadeEstadoBotonYInput(
                        '#btnActualizarSerie', // Selector del botón
                        'GUARDAR', // Nuevo texto para el botón
                        'btn-primary', // Clase a remover del botón
                        'btn-success', // Clase a agregar al botón
                        'fa-sync', // Clase a remover del ícono
                        'fa-save', // Clase a agregar al ícono
                        'btnRegistrarSerie', // Nuevo ID para el botón
                        'formSerieActualizar', //ID del formulario anterior
                        'formSeries', //Nuevo ID del
                        '#descripcion' // Selector del input para hacer focus
                    );
                }

            })

        }

        function darDeBajaSerie(id) {
            Swal.fire({
                title: 'Está seguro(a) de Dar de Baja la Serie?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si!',
                cancelButtonText: 'No',
            }).then((result) => {
                if (result.isConfirmed) {
                    response = SolicitudAjax('series/delete/' + id, 'POST');
                    Swal.fire({
                        position: "center",
                        icon: response['tipo_msj'],
                        title: response['msj'],
                        showConfirmButton: true,
                        timer: 6000
                    });
                    recargarTablas('tblSeries');
                }

            })

        }

        function activarSerie(id) {
            Swal.fire({
                title: 'Está seguro(a) de Activar la Serie ?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si!',
                cancelButtonText: 'No',
            }).then((result) => {
                if (result.isConfirmed) {
                    response = SolicitudAjax('series/active/' + id, 'POST');
                    Swal.fire({
                        position: "center",
                        icon: response['tipo_msj'],
                        title: response['msj'],
                        showConfirmButton: true,
                        timer: 6000
                    });
                    recargarTablas('tblSeries');
                }

            })

        }
    </script>