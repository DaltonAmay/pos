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

                                        <form class="validarCategoria" novalidate id="formCategoria">

                                            <div class="row">

                                                <div class="col-md-12">
                                                    <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-layer-group mr-1 my-text-color"></i>Descripción <span class="text-danger">(*)</span></label>
                                                    <input type="hidden" name="idCategoria" id="idCategoria">

                                                    <input type="text" style="border-radius: 20px;" class="form-control form-control-sm" id="nombre" name="nombre" aria-label="Small" aria-describedby="inputGroup-sizing-sm" required>
                                                    <div class="invalid-feedback">Ingrese la Categoría</div>
                                                </div>


                                                <div class="col-md-12 mt-3 text-center">
                                                    <a class="btn btn-sm btn-success  fw-bold btnAccion" id="btnRegistrarCategoria" style="position: relative; width: 50%;">
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
                                        <table id="tblCategorias" class="table table-striped w-100 shadow border border-secondary">
                                            <thead class="bg-main text-left">
                                                <th>Id</th>
                                                <th>Descripcion</th>
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
            listarCategorias();

            //EVENTO DEL BOTON GUARDAR
            $(document).on('click', '#btnRegistrarCategoria', function(e) {
                e.preventDefault();
                guardarCategoria();
            });

            // Utiliza la delegación de eventos para vincular el evento click al nuevo ID
            //EVENTO DEL BOTON ACTUALIZAR
            $(document).on('click', '#btnActualizarCategoria', function(e) {
                e.preventDefault();
                actualizarCategoria();
            });

            //boton para cargar el dato en el imput
            $('#tblCategorias').on('click', '#btnCargarCategorias', function(e) {
                e.stopPropagation(); // Detiene la propagación del evento
                var id = $(this).data('id');
                obtenerCategoria(id);
            });

            // Evento para dar de baja
            $('#tblCategorias').on('click', '#btnDarDeBajaCategoria', function(e) {
                e.stopPropagation(); // Detiene la propagación del evento
                var id = $(this).data('id');
                darDeBajaCategoria(id);
            });

            //Evento para activar el tipo de documento
            $('#tblCategorias').on('click', '#btnActivarCategoria', function(e) {
                e.stopPropagation(); // Detiene la propagación del evento
                var id = $(this).data('id');
                activarCategoria(id);
            });

            //CONVERTIR A MAYUSCULAS
            convertirAMayusculas('#nombre');

        });


        function listarCategorias() {
            tablaProductos = $('#tblCategorias').DataTable({
                dom: 'Bfrtip',
                buttons: [{
                    extend: 'excel',
                    title: function() {
                        var printTitle = 'LISTADO DE CATEGORÍAS';
                        return printTitle
                    }
                }, 'pageLength'],
                processing: true,
                serverSide: true,
                order: [
                    [0, 'DESC']
                ],
                ajax: {
                    url: 'categorias/listar',
                    type: 'POST'
                },
                scrollX: true,
                columnDefs: [{
                        targets: [0],
                        visible: false,
                    }, {
                        targets: 2,
                        createdCell: function(td, cellData, rowData, row, col) {

                            if (rowData[2] == 'ACTIVO') {
                                $(td).html('<span class="bg-success px-3 py-1 rounded-pill fw-bold"> ' + rowData[2] + ' </span>')
                            }

                            if (rowData[2] == 'INACTIVO') {
                                $(td).html('<span class="bg-danger px-2 py-1 rounded-pill fw-bold"> ' + rowData[2] + ' </span>')
                            }

                        }
                    },
                    {

                        targets: 3,
                        createdCell: function(td, cellData, rowData, row, col) {
                            $(td).html('<span class="">' + formatearFechaHora(rowData[3]) + '</span>')
                        }
                    },
                    {

                        targets: 4,
                        createdCell: function(td, cellData, rowData, row, col) {
                            if (rowData[4] !== undefined && rowData[4] !== null && rowData[4] !== '') {
                                $(td).html('<span class="">' + formatearFechaHora(rowData[4]) + '</span>')
                            }else{
                                $(td).html('<span class="">No registra fecha</span>')
                            }
                        }
                    },
                    {
                        targets: 5,
                        createdCell: function(td, cellData, rowData, row, col) {

                            let htmlContent = "";

                            if (rowData[2] == "ACTIVO") {

                                htmlContent += "<span class='fas fa-edit text-primary fs-5' id='btnCargarCategorias' style='cursor:pointer;' data-id='" + rowData[0] + "' title='Editar'>";


                                htmlContent += "<span class='text-danger px-1' id='btnDarDeBajaCategoria' style='cursor:pointer;' data-id='" + rowData[0] + "'>" +
                                    "<i class='fa fa-trash-alt fs-5'></i>" +
                                    "</span>";
                            } else {
                                htmlContent += "<span class='text-success px-1' id='btnActivarCategoria' style='cursor:pointer;' data-id='" + rowData[0] + "'>" +
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

        function guardarCategoria() {
            formValidateCategoria = validarFormulario('validarCategoria');
            if (!formValidateCategoria) {
                mensajeToast("error", "Complete los datos obligatorios");
                return;
            }
            Swal.fire({
                title: 'Está seguro(a) de guardar la Categoría?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si!',
                cancelButtonText: 'No',
            }).then((result) => {
                if (result.isConfirmed) {
                    var formData = new FormData();
                    formData.append('datosCategoria', $("#formCategoria").serialize());
                    response = SolicitudAjax('categorias/save', 'POST', formData);

                    Swal.fire({
                        position: 'center',
                        icon: response['tipo_msj'],
                        title: response['msj'],
                        showConfirmButton: true
                    });
                    recargarTablas('tblCategorias');
                    limpiarFormulario('#formCategoria', '.validarCategoria');
                }

            })

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

        function obtenerCategoria(id) {
            response = SolicitudAjax('categorias/obtenerCategoria/' + id, 'POST');
            var datoCategoria = response.datoCate;
            // Rellenar los campos del modal con los datos obtenidos
            $('#idCategoria').val(datoCategoria.id_categoria);
            $('#nombre').val(datoCategoria.nombre);
            //animacion al input
            resaltaInput("#nombre");
            cambiadeEstadoBotonYInput(
                '#btnRegistrarCategoria', // Selector del botón
                'ACTUALIZAR', // Nuevo texto para el botón
                'btn-success', // Clase a remover del botón
                'btn-primary', // Clase a agregar al botón
                'fa-save', // Clase a remover del ícono
                'fa-sync', // Clase a agregar al ícono
                'btnActualizarCategoria', // Nuevo ID para el botón
                'formCategoria', //ID del formulario anterior
                'formActualizarCategoria', //Nuevo ID del form
                '#nombre' // Selector del input para hacer focus
            );

        }

        function actualizarCategoria() {

            formValidateUnidad = validarFormulario('validarCategoria');
            if (!formValidateUnidad) {
                mensajeToast("error", "Complete los datos obligatorios");
                return;
            }
            Swal.fire({
                title: 'Está seguro(a) de actualizar la Categoría ?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si!',
                cancelButtonText: 'No',
            }).then((result) => {
                if (result.isConfirmed) {
                    var formData = new FormData();
                    formData.append('datosCategoria', $("#formActualizarCategoria").serialize());
                    response = SolicitudAjax('categorias/update', 'POST', formData);
                    Swal.fire({
                        position: "center",
                        icon: response['tipo_msj'],
                        title: response['msj'],
                        showConfirmButton: true,
                        timer: 5000
                    });

                    recargarTablas('tblCategorias');
                    limpiarFormulario('#formActualizarCategoria', '.validarCategoria');
                    cambiadeEstadoBotonYInput(
                        '#btnActualizarCategoria', // Selector del botón
                        'GUARDAR', // Nuevo texto para el botón
                        'btn-primary', // Clase a remover del botón
                        'btn-success', // Clase a agregar al botón
                        'fa-sync', // Clase a remover del ícono
                        'fa-save', // Clase a agregar al ícono
                        'btnRegistrarCategoria', // Nuevo ID para el botón
                        'formActualizarCategoria', //ID del formulario anterior
                        'formCategoria', //Nuevo ID del
                        '#nombre' // Selector del input para hacer focus
                    );
                }

            })

        }

        function darDeBajaCategoria(id) {
            Swal.fire({
                title: 'Está seguro(a) de Dar de Baja la Categoría?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si!',
                cancelButtonText: 'No',
            }).then((result) => {
                if (result.isConfirmed) {
                    response = SolicitudAjax('categorias/delete/' + id, 'POST');
                    Swal.fire({
                        position: "center",
                        icon: response['tipo_msj'],
                        title: response['msj'],
                        showConfirmButton: true,
                        timer: 6000
                    });
                    recargarTablas('tblCategorias');
                }

            })

        }

        function activarCategoria(id) {
            Swal.fire({
                title: 'Está seguro(a) de Activar la Categoría?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si!',
                cancelButtonText: 'No',
            }).then((result) => {
                if (result.isConfirmed) {
                    response = SolicitudAjax('categorias/active/' + id, 'POST');
                    Swal.fire({
                        position: "center",
                        icon: response['tipo_msj'],
                        title: response['msj'],
                        showConfirmButton: true,
                        timer: 6000
                    });
                    recargarTablas('tblCategorias');
                }

            })

        }
    </script>