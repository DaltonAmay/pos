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

                                        <form class="validarUnidadM" novalidate id="formUnidadM">

                                            <div class="row">

                                                <div class="col-md-6">
                                                    <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-layer-group mr-1 my-text-color"></i>Descripción</label>
                                                    <input type="hidden" name="idUnidadM" id="idUnidadM">

                                                    <input type="text" style="border-radius: 20px;" class="form-control form-control-sm" id="nombre" name="nombre" aria-label="Small" aria-describedby="inputGroup-sizing-sm" required>
                                                    <div class="invalid-feedback">Ingrese el Tipo de Documento</div>
                                                </div>

                                                <div class="col-md-6">
                                                    <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-layer-group mr-1 my-text-color"></i>Abreviatura:</label>


                                                    <input type="text" style="border-radius: 20px;" class="form-control form-control-sm" id="abreviatura" name="abreviatura" aria-label="Small" aria-describedby="inputGroup-sizing-sm" required>
                                                    <div class="invalid-feedback">Ingrese la Abreviatura</div>
                                                </div>

                                                <div class="col-md-12 mt-3 text-center">
                                                    <a class="btn btn-sm btn-success  fw-bold btnAccion" id="btnRegistrarUnidadM" style="position: relative; width: 50%;">
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

                            <!--LISTADO DE UNIDADES DE MEDIDA -->
                            <div class="col-12 col-lg-8">
                                <div class="card card-gray shadow">
                                    <div class="card-header">
                                        <h3 class="card-title"><i class="fas fa-list"></i> Listado <?php echo $titulo; ?></h3>
                                    </div>
                                    <div class="card-body">
                                        <table id="tblUnidadM" class="table table-striped w-100 shadow border border-secondary">
                                            <thead class="bg-main text-left">
                                                <th>Id</th>
                                                <th>Descripcion</th>
                                                <th>Abreviatura</th>
                                                <th>Estado</th>
                                                <th>F. Creación</th>
                                                <th>F. Actualiza</th>
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
            listarUnidadesMedida();

            //EVENTO DEL BOTON GUARDAR
            $(document).on('click', '#btnRegistrarUnidadM', function(e) {
                e.preventDefault();
                guardarUnidadM();
            });

            // Utiliza la delegación de eventos para vincular el evento click al nuevo ID
            //EVENTO DEL BOTON ACTUALIZAR
            $(document).on('click', '#btnActualizarUnidadM', function(e) {
                e.preventDefault();
                actualizaUnidadMedida();
            });

            //boton para cargar el dato en el imput
            $('#tblUnidadM').on('click', '#btnCargarUnidadM', function(e) {
                e.stopPropagation(); // Detiene la propagación del evento
                var id = $(this).data('id');
                obtenerUnidadM(id);
            });

            // Evento para dar de baja
            $('#tblUnidadM').on('click', '#btnDarDeBajaUnidadM', function(e) {
                e.stopPropagation(); // Detiene la propagación del evento
                var id = $(this).data('id');
                DarDeBajaTipoDocumento(id);
            });

            //Evento para activar el tipo de documento
            $('#tblUnidadM').on('click', '#btnActivarUnidadM', function(e) {
                e.stopPropagation(); // Detiene la propagación del evento
                var id = $(this).data('id');
                activarUnidadM(id);
            });
            convertirAMayusculas('#nombre');
            convertirAMayusculas('#abreviatura');

        });


        function listarUnidadesMedida() {
            tablaProductos = $('#tblUnidadM').DataTable({
                dom: 'Bfrtip',
                buttons: [{
                    extend: 'excel',
                    title: function() {
                        var printTitle = 'LISTADO DE UNIDADES DE MEDIDA';
                        return printTitle
                    }
                }, 'pageLength'],
                processing: true,
                serverSide: true,
                order: [],
                ajax: {
                    url: 'unidades/listar',
                    type: 'POST'
                },
                scrollX: true,
                columnDefs: [{
                        targets: [0, ],
                        visible: false,
                    }, {
                        targets: 2,
                        createdCell: function(td, cellData, rowData, row, col) {
                            $(td).html('<span class="text-bold"> ' + rowData[2] + ' </span>')

                        }
                    },{
                        targets: 3,
                        createdCell: function(td, cellData, rowData, row, col) {

                            if (rowData[3] == 'ACTIVO') {
                                $(td).html('<span class="bg-success px-3 py-1 rounded-pill fw-bold"> ' + rowData[3] + ' </span>')
                            }

                            if (rowData[3] == 'INACTIVO') {
                                $(td).html('<span class="bg-danger px-2 py-1 rounded-pill fw-bold"> ' + rowData[3] + ' </span>')
                            }

                        }
                    }, {

                        targets: 4,
                        createdCell: function(td, cellData, rowData, row, col) {
                            $(td).html('<span class="">' + formatearFechaHora(rowData[4]) + '</span>')

                        }
                    }, {

                        targets: 5,
                        createdCell: function(td, cellData, rowData, row, col) {
                            if (rowData[5] !== undefined && rowData[5] !== null && rowData[5] !== '') {
                                $(td).html('<span class="">' + formatearFechaHora(rowData[5]) + '</span>')
                            }else{
                                $(td).html('<span class="">No registra fecha</span>')
                            }

                        }
                    },
                    {
                        targets: 6,
                        createdCell: function(td, cellData, rowData, row, col) {

                            let htmlContent = "";

                            if (rowData[3] == "ACTIVO") {

                                htmlContent += "<span class='fas fa-edit text-primary fs-5' id='btnCargarUnidadM' style='cursor:pointer;' data-id='" + rowData[0] + "' title='Editar'>";


                                htmlContent += "<span class='text-danger px-1' id='btnDarDeBajaUnidadM' style='cursor:pointer;' data-id='" + rowData[0] + "'>" +
                                    "<i class='fa fa-trash-alt fs-5'></i>" +
                                    "</span>";
                            } else {
                                htmlContent += "<span class='text-success px-1' id='btnActivarUnidadM' style='cursor:pointer;' data-id='" + rowData[0] + "'>" +
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

        function guardarUnidadM() {
            form_validate_Unidad = validarFormulario('validarUnidadM');
            if (!form_validate_Unidad) {
                mensajeToast("error", "Complete los datos obligatorios");
                return;
            }
            Swal.fire({
                title: 'Está seguro(a) de guardar la Unidad de Medida?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si!',
                cancelButtonText: 'No',
            }).then((result) => {
                if (result.isConfirmed) {
                    var formData = new FormData();
                    formData.append('datos_unidades', $("#formUnidadM").serialize());
                    response = SolicitudAjax('unidades/save', 'POST', formData);

                    Swal.fire({
                        position: 'center',
                        icon: response['tipo_msj'],
                        title: response['msj'],
                        showConfirmButton: true
                    });
                    recargarTablas('tblUnidadM');
                    limpiarFormulario('#formUnidadM', '.validarUnidadM');
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

        function obtenerUnidadM(id) {
            response = SolicitudAjax('unidades/obtenerUnidad/' + id, 'POST');
            var datoUnidad = response.datoUnid;
            // Rellenar los campos del modal con los datos obtenidos
            $('#idUnidadM').val(datoUnidad.id_uni_medida);
            $('#nombre').val(datoUnidad.nombre);
            $('#abreviatura').val(datoUnidad.abreviatura);
            //animacion al input
            resaltaInput("#nombre");
            cambiadeEstadoBotonYInput(
                '#btnRegistrarUnidadM', // Selector del botón
                'ACTUALIZAR', // Nuevo texto para el botón
                'btn-success', // Clase a remover del botón
                'btn-primary', // Clase a agregar al botón
                'fa-save', // Clase a remover del ícono
                'fa-sync', // Clase a agregar al ícono
                'btnActualizarUnidadM', // Nuevo ID para el botón
                'formUnidadM', //ID del formulario anterior
                'formUnidadActualizar', //Nuevo ID del form
                '#nombre' // Selector del input para hacer focus
            );

        }

        function actualizaUnidadMedida() {

            formValidateUnidad = validarFormulario('validarUnidadM');
            if (!formValidateUnidad) {
                mensajeToast("error", "Complete los datos obligatorios");
                return;
            }
            Swal.fire({
                title: 'Está seguro(a) de actualizar la Unidad de Medida ?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si!',
                cancelButtonText: 'No',
            }).then((result) => {
                if (result.isConfirmed) {
                    var formData = new FormData();
                    formData.append('datosUnidadM', $("#formUnidadActualizar").serialize());
                    response = SolicitudAjax('unidades/update', 'POST', formData);
                    Swal.fire({
                        position: "center",
                        icon: response['tipo_msj'],
                        title: response['msj'],
                        showConfirmButton: true,
                        timer: 5000
                    });

                    recargarTablas('tblUnidadM');
                    limpiarFormulario('#formUnidadActualizar', '.validarUnidadM');
                    cambiadeEstadoBotonYInput(
                        '#btnActualizarUnidadM', // Selector del botón
                        'GUARDAR', // Nuevo texto para el botón
                        'btn-primary', // Clase a remover del botón
                        'btn-success', // Clase a agregar al botón
                        'fa-sync', // Clase a remover del ícono
                        'fa-save', // Clase a agregar al ícono
                        'btnRegistrarUnidadM', // Nuevo ID para el botón
                        'formUnidadActualizar', //ID del formulario anterior
                        'formUnidadM', //Nuevo ID del
                        '#nombre' // Selector del input para hacer focus
                    );
                }

            })

        }

        function DarDeBajaTipoDocumento(id) {
            Swal.fire({
                title: 'Está seguro(a) de Dar de Baja la Unidad de Medida?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si!',
                cancelButtonText: 'No',
            }).then((result) => {
                if (result.isConfirmed) {
                    response = SolicitudAjax('unidades/delete/' + id, 'POST');
                    Swal.fire({
                        position: "center",
                        icon: response['tipo_msj'],
                        title: response['msj'],
                        showConfirmButton: true,
                        timer: 6000
                    });
                    recargarTablas('tblUnidadM');
                }

            })

        }

        function activarUnidadM(id) {
            Swal.fire({
                title: 'Está seguro(a) de Activar el Tipo de Documento?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si!',
                cancelButtonText: 'No',
            }).then((result) => {
                if (result.isConfirmed) {
                    response = SolicitudAjax('unidades/active/' + id, 'POST');
                    Swal.fire({
                        position: "center",
                        icon: response['tipo_msj'],
                        title: response['msj'],
                        showConfirmButton: true,
                        timer: 6000
                    });
                    recargarTablas('tblUnidadM');
                }

            })

        }
    </script>