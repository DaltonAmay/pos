<div class="content-wrapper">

    <div class="content">
        <div class="container-fluid">
            <div class="mt-2"></div>
            <div class="card mb-4">
                <div class="card-header caja d-flex justify-content-between align-items-center">
                    <a id="abreModalAgregar" class="btn btn-primary"><i class="fa fa-plus"></i> Agregar Nuevo Producto</a>

                    <div class="text-center mx-auto titulo-container">
                        <span class="text-primary titulo h5 d-block" style="font-size: 1.5em;"><?php echo $titulo; ?></span>
                    </div>

                    <div class="ml-auto">
                        <div class="btn-group">
                            <a href="<?php echo base_url() ?>administrar/unidades/eliminated" class="btn btn-info"><i class="fa fa-trash" aria-hidden="true"></i> Eliminados</a>

                        </div>
                    </div>
                </div>

                <div class="card-body">

                    <table class="tableSis table table-striped w-100 shadow" id="tbl_productos">
                        <thead class="bg-info">
                            <tr>

                                <th>Opc</th>
                                <th>idproducto</th>
                                <th>C.Interno</th>
                                <th>C.Barras</th>
                                <th>Nombre</th>
                                <th>Categoría</th>
                                <th>P. Compra</th>
                                <th>P. Venta</th>
                                <th>P Mayoreo</th>
                                <th>Utilidad</th>
                                <th>Stock</th>
                                <th>Stock Min</th>
                                <th>Exento</th>
                                <th>Invent</th>
                                <th>Perece</th>
                            </tr>
                        </thead>
                        <tbody></tbody>


                        <tfoot>
                            <tr>

                                <th>Opc</th>
                                <th>idproducto</th>
                                <th>C.Interno</th>
                                <th>C.Barras</th>
                                <th>Nombre</th>
                                <th>Categoría</th>
                                <th>P. Compra</th>
                                <th>P. Venta</th>
                                <th>P Mayoreo</th>
                                <th>Utilidad</th>
                                <th>Stock</th>
                                <th>Stock Min</th>
                                <th>Exento</th>
                                <th>Invent</th>
                                <th>Perece</th>
                            </tr>
                        </tfoot>

                    </table>
                </div>

            </div>
        </div><!-- /.container-fluid -->

        <!-- ==========================================*/
        MODAL PARA AGREGAR UN NUEVO PRODUCTO
        ==========================================*/ -->
        <div class="modal fade" id="mdAgregarProducto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header bg-gray py-1">
                        <h5 class="modal-title" id="exampleModalLabel">Agregar Nuevo Producto</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="formAgregarProducto" class="validar_producto_new" autocomplete="off" novalidate>
                            <div class="row">
                                <!-- Primera Columna -->
                                <div class="col-md-6">
                                    <div class="mb-1">
                                        <label for="codBarras" class="col-form-label"><i class="fas fa-barcode"></i> Código de Barras:</label>
                                        <input type="text" class="form-control" id="codBarras" name="codBarras" required>
                                        <div class="invalid-feedback">Código de barras es obligatorio</div>
                                    </div>

                                    <div class="mb-1">
                                        <label for="nombreProducto" class="col-form-label"><i class="fas fa-cube"></i> Nombre del Producto:</label>
                                        <input type="text" class="form-control" id="nombreProducto" name="nombreProducto" required>
                                        <div class="invalid-feedback">Nombre de producto es obligatorio</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6">
                                            <div class="mb-1">
                                                <label for="preCompra" class="col-form-label"><i class="fas fa-money-bill-wave"></i> Precio Compra:</label>
                                                <input type="text" class="form-control" id="preCompra" name="preCompra" required>
                                                <div class="invalid-feedback">Precio de compra es obligatorio</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <div class="mb-1">
                                                <label for="preVenta" class="col-form-label"><i class="fas fa-cash-register"></i> Precio Venta al Público:</label>
                                                <input type="text" class="form-control" id="preVenta" name="preVenta" required>
                                                <div class="invalid-feedback">Precio de venta es obligatorio</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6">
                                            <div class="mb-1">
                                                <label for="preVentaMayoreo" class="col-form-label"><i class="fas fa-cart-arrow-down"></i> Precio Venta Mayoreo:</label>
                                                <input type="text" class="form-control" id="preVentaMayoreo" name="preVentaMayoreo" required>
                                                <div class="invalid-feedback">Pre. Venta mayoreo es obligatorio</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <div class="mb-1">
                                                <label for="utilidad" class="col-form-label"><i class="fas fa-chart-line"></i> Margen de Utilidad:</label>
                                                <input type="text" class="form-control" id="utilidad" name="utilidad" required>
                                                <div class="invalid-feedback">Margen Utilidad es obligatorio</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6">
                                            <div class="mb-1">
                                                <label for="stock" class="col-form-label"><i class="fas fa-cubes"></i> Stock Producto:</label>
                                                <input type="text" class="form-control" id="stock" name="stock">

                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <div class="mb-1">
                                                <label for="stock_min" class="col-form-label"> <i class="fas fa-sort-numeric-up"></i> Stock Mínimo:</label>
                                                <input type="text" class="form-control" id="stock_min" name="stock_min" required>
                                                <div class="invalid-feedback">Stock Mínimo es obligatorio</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Segunda Columna -->
                                <div class="col-md-6">
                                    <div class="mb-1">
                                        <label for="selectCategorias" class="col-form-label"><i class="fas fa-layer-group"></i> Seleccione la Categoría:</label>
                                        <select class="selectCategorias form-control" data-live-search="true" id="idcategoria" name="idcategoria" title="" required>
                                            <option value=""> Seleccione una Categoría</option>
                                            <?php foreach ($categorias as $categoria) : ?>

                                                <option value="<?php echo $categoria['id_categoria'] ?>">
                                                    <?php echo $categoria['nombre']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <div class="invalid-feedback">Seleecione una Categoría </div>
                                    </div>
                                    <div class="mb-1">
                                        <label for="selectMarca" class="col-form-label"><i class="fas fa-tag"></i> Seleccione una Marca:</label>
                                        <select class="selectMarca form-control" data-live-search="true" id="selectMarca" name="idmarca" title="" required>
                                            <option value=""> Seleccione una Marca</option>
                                            <?php foreach ($marcas as $marca) : ?>
                                                <option value="<?php echo $marca['id_marca']; ?>">
                                                    <?php echo $marca['nombre']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <div class="invalid-feedback">Seleecione una Marca </div>
                                    </div>
                                    <div class="mb-1">
                                        <label for="selectUnidad" class="col-form-label"><i class="fas fa-balance-scale"></i> Seleccione una Unidad de Medida:</label>
                                        <select class="selectUnidad form-control" data-live-search="true" id="selectUnidad" name="idunidad" title="" required>
                                            <option value=""> Seleccione una Unidad de Medida</option>
                                            <?php foreach ($unidades as $unidad) : ?>
                                                <option value="<?php echo $unidad['id_uni_medida']; ?>">
                                                    <?php echo $unidad['nombre']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <div class="invalid-feedback">Seleecione una Unidad de medida </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 ">
                                            <div class="mb-1">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="1" id="exentoImp" name="exento" checked>
                                                    <label class="form-check-label" for="exentoImp"> Exento</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="1" id="inventariable" name="inventariable" checked>
                                                    <label class="form-check-label" for="inventariable"> Inventariable</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="0" id="perecedero" name="perecedero">
                                                    <label class="form-check-label" for="perecedero"> Perecedero</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <!-- Otras columnas, si es necesario -->
                            </div>
                            <div class="modal-footer">
                                <button id="saveProducto" class="btn btn-success"><span class="fa fa-save"></span> Guardar</button>


                            </div>

                        </form>

                    </div>


                </div>
            </div>
        </div>

        <!-- ==========================================*/
        MODAL PARA EDITAR UN PRODUCTO
        ==========================================*/ -->

        <div class="modal fade" id="mdEditarProducto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header bg-gray py-1">
                        <h5 class="modal-title" id="exampleModalLabel">Editar Nuevo Producto</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" id="formActualizarProducto" autocomplete="off" class="validar_producto_edit">

                            <div class="row">
                                <!-- Primera Columna -->
                                <div class="col-md-6">
                                    <div class="mb-1">
                                        <input type="hidden" name="id_producto" id="id_producto">
                                        <label for="codBarras" class="col-form-label">
                                            <i class="fas fa-barcode"></i> Código de Barras:
                                        </label>
                                        <input type="text" class="form-control" id="codBarrasE" name="codBarrasE" required>
                                        <div class="invalid-feedback">Código de barras es obligatorio</div>
                                    </div>

                                    <div class="mb-1">
                                        <label for="nombreProducto" class="col-form-label">
                                            <i class="fas fa-cube"></i> Nombre del Producto:
                                        </label>
                                        <input type="text" class="form-control" id="nombreProductoE" name="nombreProductoE" required>
                                        <div class="invalid-feedback">El nombre de producto es obligatorio</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 col-sm-6">
                                            <div class="mb-1">
                                                <label for="preCompra" class="col-form-label">
                                                    <i class="fas fa-money-bill-wave"></i> Precio Compra:
                                                </label>
                                                <input type="text" class="form-control" id="preCompraE" name="preCompraE" required>
                                                <div class="invalid-feedback">Precio de compra es obligatorio</div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-sm-6">
                                            <div class="mb-1">
                                                <label for="preVenta" class="col-form-label">
                                                    <i class="fas fa-cash-register"></i></i> Precio Venta al Público:
                                                </label>
                                                <input type="text" class="form-control" id="preVentaE" name="preVentaE" required>
                                                <div class="invalid-feedback">Precio de venta es obligatorio</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 col-sm-6">
                                            <div class="mb-1">
                                                <label for="preVentaMayoreo" class="col-form-label">
                                                    <i class="fas fa-cart-arrow-down"></i> Precio Venta Mayoreo:
                                                </label>
                                                <input type="text" class="form-control" id="preVentaMayoreoE" name="preVentaMayoreoE" required>
                                                <div class="invalid-feedback">Pre. mayoreo es obligatorio</div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-sm-6">
                                            <div class="mb-1">
                                                <label for="utilidad" class="col-form-label">
                                                    <i class="fas fa-chart-line"></i> Margen de Utilidad:
                                                </label>
                                                <input type="text" class="form-control" id="utilidadE" name="utilidadE" require>
                                                <div class="invalid-feedback">Marge de utilidad es obligatorio</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 col-sm-6">
                                            <div class="mb-1">
                                                <label for="stock" class="col-form-label">
                                                    <i class="fas fa-cubes"></i> Stock Producto:
                                                </label>
                                                <input type="text" class="form-control" id="stockE" name="stockE">
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-sm-6">
                                            <div class="mb-1">
                                                <label for="stock_min" class="col-form-label">
                                                    <i class="fas fa-sort-numeric-up"></i> Stock Mínimo:
                                                </label>
                                                <input type="text" class="form-control" id="stock_minE" name="stock_minE">
                                                <div class="invalid-feedback">Stock Mínimo es obligatorio</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <!-- Segunda Columna -->
                                <div class="col-md-6">
                                    <div class="mb-1">
                                        <label for="selectCategorias" class="col-form-label">
                                            <i class="fas fa-layer-group"></i> Seleccione la Categoría:
                                        </label>
                                        <select class="selectCategoriasE form-control selectpicker" data-live-search="true" id="selectcategoriaE" name="idcategoriaE" title="Selecciona una Categoría">
                                            <div class="invalid-feedback">Seleecione una Categoría</div>

                                        </select>
                                    </div>

                                    <div class="mb-1">
                                        <label for="selectMarca" class="col-form-label">
                                            <i class="fas fa-tag"></i> Seleccione una Marca:
                                        </label>
                                        <select class="selectMarcaE form-control" data-live-search="true" id="selectMarcaE" title="Selecciona una Marca" name="idmarcaE">
                                        </select>
                                        <div class="invalid-feedback">Seleecione una Marca</div>
                                    </div>

                                    <div class="mb-1">
                                        <label for="selectUnidad" class="col-form-label">
                                            <i class="fas fa-balance-scale"></i> Seleccione una Unidad de Medida:
                                        </label>
                                        <select class="selectUnidadE form-control" data-live-search="true" id="selectUnidadE" title="Selecciona una Unidad de Medida" name="idunidadE">
                                            <div class="invalid-feedback">Seleecione una Unidad de medida</div>
                                        </select>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 col-sm-6">
                                            <div class="mb-1">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="exentoImpE" name="exentoImpE">
                                                    <label class="form-check-label" for="exentoImpE">
                                                        Exento
                                                    </label>
                                                </div>

                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="inventariableE" name="inventariableE">
                                                    <label class="form-check-label" for="inventariableE">
                                                        Inventariable
                                                    </label>
                                                </div>

                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="perecederoE" name="perecederoE">
                                                    <label class="form-check-label" for="perecederoE">
                                                        Perecedero
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <!-- Otras columnas, si es necesario -->
                            </div>
                            <div class="modal-footer">
                                <button id="updateProducto" class="btn btn-success" data-bs-dismiss="modal"><span class="fa fa-save"></span> Actualizar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <script>
            $(document).ready(function() {
                /*==========================================*/
                // INICIALIZO EL SELECT DE CATEGORIAS
                /*==========================================*/

                $('.selectCategorias').selectpicker();
                /*==========================================*/
                // INICIALIZO EL SELECT DE MARCAS
                /*==========================================*/
                $('.selectMarca').selectpicker();
                /*==========================================*/
                // INICIALIZO EL SELECT DE UNIDAD DE MEDIDA
                /*==========================================*/
                $('.selectUnidad').selectpicker();
                /*==========================================*/
                // INICIALIZO EL SELECT DE CATEGORIAS EN EL MODAL DE EDICIÓN
                /*==========================================*/
                $('.selectcategoriaE').selectpicker();
                /*==========================================*/
                // INICIALIZO EL SELECT DE MARCAS EN EL MODAL DE EDICIÓN
                /*==========================================*/
                $('.selectMarcaE').selectpicker();
                /*==========================================*/
                // INICIALIZO EL SELECT DE UNIDAD DE MEDIDA EN EL MODAL DE EDICIÓN
                /*==========================================*/
                $('.selectUnidadE').selectpicker();

                /*==========================================*/
                // METODO PARA CAMBIAR EL VALOR DE LOS CHECK BOX
                /*==========================================*/
                // Si el checkbox está marcado, establece el valor
                // como 1, de lo contrario, establece el valor como 0
                $('#exentoImp').change(function() {
                    $(this).val(this.checked ? 1 : 0);
                });
                $('#inventariable').change(function() {
                    $(this).val(this.checked ? 1 : 0);
                });
                $('#perecedero').change(function() {
                    $(this).val(this.checked ? 1 : 0);
                });

                $('#exentoImpE').change(function() {
                    $(this).val(this.checked ? 1 : 0);
                });
                $('#inventariableE').change(function() {
                    $(this).val(this.checked ? 1 : 0);
                });
                $('#perecederoE').change(function() {
                    $(this).val(this.checked ? 1 : 0);
                });
                // Metodo para abrir el modal
                $('#mdAgregarProducto').on('shown.bs.modal', function() {
                    $("#codBarras").focus();
                });

                $("#abreModalAgregar").click(function(e) {
                    $('#mdAgregarProducto').modal('show');
                });

                $(".btn-close").click(function(e) {
                    limpiarFormulario('#formAgregarProducto', '.validar_producto_new');
                });
            });
            var table = "";

            function listarTabla() {
                if ($.fn.DataTable.isDataTable('#tbl_productos')) {
                    $('#tbl_productos').DataTable().destroy();
                    $('#tbl_productos tbody').empty();
                }

                table = $('#tbl_productos').DataTable({
                    dom: 'Bfrtip',

                    buttons: [{
                        extend: 'excel',
                        title: function() {
                            var printTitle = 'LISTADO DE PRODUCTOS';
                            return printTitle;
                        }
                    }, 'print', 'pageLength'],
                    serverSide: true,
                    processing: true,
                    order: [
                        [2, 'DESC']
                    ],
                    pageLength: [5, 10, 15, 30, 50, 100],
                    pageLength: 10,
                    ajax: {
                        url: base_url + "administrar/productos/listar",
                        type: 'post',

                    },
                    scrollX: true,
                    initComplete: function(settings, json) {
                        aplicarScrollHorizontal('#tbl_productos');
                    },
                    columnDefs: [{
                            "className": "dt-center",
                            "targets": "_all"
                        },
                        {
                            targets: 0,
                            orderable: false,


                            createdCell: function(td, cellData, rowData, row, col) {
                                $(td).html("<center>" +
                                    "<span class='btnEditarProducto text-primary px-1' style='cursor:pointer;' data-id='" + rowData[1] + "'>" +
                                    "<i class='fa fa-pencil-alt fs-5' ></i>" +
                                    "</span>" +
                                    "<span class='btnAumentarStock text-success px-1' style='cursor:pointer;'>" +
                                    "<i class='fa fa-plus-circle fs-5'></i>" +
                                    "</span>" +
                                    "<span class='btnDisminuirStock text-warning px-1' style='cursor:pointer;'>" +
                                    "<i class='fa fa-minus-circle fs-5'></i>" +
                                    "</span>" +
                                    "<span class='btnEliminarProducto text-danger px-1' style='cursor:pointer;' data-id='" + rowData[1] + "'>" +
                                    "<i class='fa fa-trash-alt fs-5'></i>" +
                                    "</span>" +
                                    "</center>");
                            }
                        },
                        {
                            targets: [1],
                            visible: false,
                            // orderable: false
                        },
                        {
                            targets: 10,
                            createdCell: function(td, cellData, rowData, row, col) {
                                var stock = parseFloat(rowData[10]);
                                var stock_min = parseFloat(rowData[11]);
                                if (stock <= stock_min && stock > 0) {
                                    $(td).html("<i class='fas fa-exclamation-triangle text-warning mr-1'></i>" + stock);
                                } else if (stock == 0) {
                                    $(td).html('<i class="fas fa-ban text-danger mr-1"></i>' + stock);
                                } else if (stock > stock_min) {
                                    $(td).html("<i class='fas fa-check text-success mr-1'></i>" + stock);
                                }
                            }
                        }, {
                            targets: 12,
                            createdCell: function(td, cellData, rowData, row, col) {

                                if (rowData[12] == 1) {
                                    $(td).html("<center>" +
                                        "<i class='fas fa-check-circle text-success'></i> " +
                                        "</center>");
                                } else {
                                    $(td).html("<center>" + "<i class='fas fa-times-circle text-danger mr-1'></i> " +
                                        "</center>");
                                }
                            }
                        },
                        {
                            targets: 13,
                            createdCell: function(td, cellData, rowData, row, col) {

                                if (rowData[13] == 1) {
                                    $(td).html("<center>" +
                                        "<i class='fas fa-check-circle text-success'></i> " +
                                        "</center>");
                                } else {
                                    $(td).html("<center>" + "<i class='fas fa-times-circle text-danger mr-1'></i> " +
                                        "</center>");
                                }
                            }
                        },
                        {
                            targets: 14,
                            createdCell: function(td, cellData, rowData, row, col) {

                                if (rowData[14] == 1) {
                                    $(td).html("<center>" +
                                        "<i class='fas fa-check-circle text-success'></i> " +
                                        "</center>");
                                } else {
                                    $(td).html("<center>" + "<i class='fas fa-times-circle text-danger mr-1'></i> " +
                                        "</center>");
                                }
                            }
                        },
                    ],
                    scrollX: true,
                    scrollY: true,
                    language: {
                        url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
                    },
                    colReorder: true,
                    rowReorder: {
                        selector: 'td:nth-child(2)', // Indica la columna que se utilizará como el identificador para reordenar filas
                        update: false, // Evita que DataTables actualice el orden automáticamente
                    }
                });

            }


            function guardaProducto() {

                form_producto_validate = validarFormulario('validar_producto_new');
                if (!form_producto_validate) {
                    mensajeToast("error", "Complete los datos obligatorios");
                    return;
                }

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
                            limpiarFormulario('#formAgregarProducto', '.validar_producto_new');

                        }
                    },
                    error: function(xhr, status, error) {
                        // Error de AJAX
                        alert('Ha ocurrido un error al guardar el producto');
                    }
                });


            }

            function actualizarProducto() {
                form_producto_validate = validarFormulario('validar_producto_edit');

                //INICIO DE LAS VALIDACIONES
                if (!form_producto_validate) {
                    mensajeToast("error", "Complete los datos obligatorios");
                    return;
                }

                Swal.fire({
                    title: 'Está seguro(a) de actualizar los datos del Producto?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si!',
                    cancelButtonText: 'No',
                }).then((result) => {

                    if (result.isConfirmed) {

                        var formData = new FormData();
                        formData.append('datos_productos', $("#formActualizarProducto").serialize());
                        response = SolicitudAjax('productos/update', 'POST', formData);

                        Swal.fire({
                            position: 'top-center',
                            icon: response['tipo_msj'],
                            title: response['msj'],
                            showConfirmButton: true
                        });
                        //recargarTablaProductos();
                        recargarTablas('tbl_productos');
                        limpiarFormulario('#formActualizarProducto', '.validar_producto_edit');

                    }

                })




            }


            // function recargarTablaProductos() {
            //     if ($.fn.DataTable.isDataTable('#tbl_productos')) {
            //         $('#tbl_productos').DataTable().ajax.reload();
            //     }
            // }  

            function cargaProducto(id_producto) {

                // Mostrar el modal
                $('#mdEditarProducto').modal('show');
                $.ajax({
                    url: base_url + 'administrar/productos/obtenerDatosProducto/' + id_producto,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        var datosProducto = response.datosProducto;
                        // Rellenar los campos del modal con los datos obtenidos
                        $('#id_producto').val(datosProducto.id_producto);
                        $('#codBarrasE').val(datosProducto.cod_barras);
                        $('#nombreProductoE').val(datosProducto.nombre_producto);
                        $('#preCompraE').val(datosProducto.precio_compra);
                        $('#preVentaE').val(datosProducto.precio_venta);
                        $('#preVentaMayoreoE').val(datosProducto.precio_venta_mayoreo);
                        $('#utilidadE').val(datosProducto.utilidad);
                        $('#stockE').val(datosProducto.stock);
                        $('#stock_minE').val(datosProducto.stock_min);

                        // Llenar y seleccionar opciones en el select de categoría
                        $("#selectcategoriaE").selectpicker("val", "");
                        $.each(response.categorias, function(index, categoria) {
                            var selected = (categoria.id_categoria == response.datosProducto.idcategoria) ? 'selected' : '';
                            $('#selectcategoriaE').append('<option value="' + categoria.id_categoria + '" ' + selected + '>' + categoria.nombre + '</option>');
                        });
                        //
                        $('#selectcategoriaE').selectpicker('refresh');


                        
                        // Llenar y seleccionar opciones en el select de marca
                        $("#selectMarcaE").selectpicker("val", "");
                        $.each(response.marcas, function(index, marca) {
                            var selected = (marca.id_marca == response.datosProducto.idmarca) ? 'selected' : '';
                            $('#selectMarcaE').append('<option value="' + marca.id_marca + '" ' + selected + '>' + marca.nombre + '</option>');
                        });
                        $('#selectMarcaE').selectpicker('refresh');

                        // Llenar y seleccionar opciones en el select de unidad
                        $("#selectUnidadE").selectpicker("val", "");
                        $.each(response.unidades, function(index, unidad) {
                            var selected = (unidad.id_uni_medida == response.datosProducto.idunidad) ? 'selected' : '';
                            $('#selectUnidadE').append('<option value="' + unidad.id_uni_medida + '" ' + selected + '>' + unidad.nombre + '</option>');
                        });
                        $('#selectUnidadE').selectpicker('refresh');
                        // Manejar los valores de los checkboxes
                        $('#exentoImpE').prop('checked', datosProducto.exento == 1);
                        $('#inventariableE').prop('checked', datosProducto.inventariable == 1);
                        $('#perecederoE').prop('checked', datosProducto.perecedero == 1);


                    },
                    error: function(err) {
                        console.error(err);
                    }
                });
            }

            function calcularUtilidadProducto(preCompra, preVenta, util) {
                var precompra = $("#" + preCompra).val();
                var preventa = $("#" + preVenta).val();
                var utilidad = preventa - precompra;
                $("#" + util).val(utilidad.toFixed(2));
            }

            function eliminar(id_producto) {
                //esto hace que me gaurde mi paginacion actual para cuando hago una eliminacion no se reinicie la paginacion 
                var paginaActual = table.page();

                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: "btn btn-success",
                        cancelButton: "btn btn-danger"
                    },
                    buttonsStyling: false
                });

                swalWithBootstrapButtons.fire({
                    title: "¿Estás Seguro?",
                    text: "¿Deseas eliminar este producto?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Sí, Elimínalo ahora",
                    cancelButtonText: "No, Cancela",
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: base_url + 'administrar/productos/delete/' + id_producto,
                            type: 'GET',
                            dataType: 'json',
                            success: function(response) {
                                if (response.respuesta = "ok") {
                                    swalWithBootstrapButtons.fire({
                                        title: "Eliminado",
                                        text: "El producto se ha eliminado correctamente.",
                                        icon: "success"
                                    }).then(() => {
                                        // Recargar la página después de la confirmación
                                        table.ajax.reload(function() {
                                            table.page(paginaActual).draw('page');
                                        }, false);
                                    });
                                } else {
                                    swalWithBootstrapButtons.fire({
                                        title: "Error",
                                        text: response,
                                        icon: "error"
                                    });
                                }
                            },
                            error: function(err) {
                                console.error(err);
                            }
                        });
                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                        swalWithBootstrapButtons.fire({
                            title: "Cancelado",
                            text: "El producto no ha sido eliminado.",
                            icon: "error"
                        });
                    }
                });
            }

            $(function() {
                listarTabla();
                /*==========================================*/
                // EVENTO PARA CALCULAR LA UTILIDAD
                /*==========================================*/

                $("#preVenta, #preCompra ").keyup(function() {
                    calcularUtilidadProducto("preCompra", "preVenta", "utilidad");
                });

                $("#preVenta, #preCompra ").change(function() {
                    calcularUtilidadProducto("preCompra", "preVenta", "utilidad");
                });

                $("#preVentaE, #preCompraE").keyup(function() {
                    calcularUtilidadProducto("preCompraE", "preVentaE", "utilidadE");
                });

                $("#preVentaE, #preCompraE").change(function() {
                    calcularUtilidadProducto("preCompraE", "preVentaE", "utilidadE");
                });

                /*==========================================*/
                // EVENTO PARA GUARDAR EL PRODUCTO 
                /*==========================================*/
                $('#saveProducto').click(function(e) {
                    e.preventDefault();
                    guardaProducto();
                });

                /*==========================================*/
                // EVENTO PARA ACTUALIZAR EL PRODUCTO 
                /*==========================================*/
                $('#updateProducto').click(function(e) {
                    e.preventDefault();
                    actualizarProducto();
                });


                /*==========================================*/
                // FUNCION PARA CONSULTAR Y PINTAR EN LOS
                // INPUTS LOS DATOS DEL PRODUCTO
                /*==========================================*/

                $(document).on('click', '.btnEditarProducto', function() {
                    var id_producto = $(this).data('id');
                    cargaProducto(id_producto);
                });
                /*==========================================*/
                // FUNCION PARA ELIMINAR LOS DATOS DEL PRODUCTO
                /*==========================================*/
                $(document).on('click', '.btnEliminarProducto', function() {
                    var id_producto = $(this).data('id');
                    eliminar(id_producto);
                });








            });
        </script>
    </div>