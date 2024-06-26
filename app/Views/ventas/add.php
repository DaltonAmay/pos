<div class="content-wrapper">

    <div class="content">
        <div class="container-fluid">
            <!-- Content Header (Page header) -->
            <div class="content-header pb-1">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h2 class="m-0 fw-bold">ADMINISTRAR VENTAS</h2>
                        </div><!-- /.col -->
                        <div class="col-sm-6 d-none d-md-block">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Inicio</a></li>
                                <li class="breadcrumb-item active">Ventas / Factura</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <div class="content">

                <input type="hidden" name="id_caja" id="id_caja" value="0">

                <div class="row">

                    <div class="col-12 ">

                        <div class="card card-primary card-outline card-outline-tabs">

                            <div class="card-header p-0 border-bottom-0">

                                <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">

                                    <!-- TAB REGISTRO DE FACTURAS -->
                                    <li class="nav-item">
                                        <a class="nav-link active my-0" id="registrar-facturas-tab" data-toggle="pill" href="#registrar-facturas" role="tab" aria-controls="registrar-facturas" aria-selected="false"><i class="fas fa-file-signature"></i> Registrar</a>
                                    </li>

                                    <!-- TAB LISTADO DE FACTURAS -->
                                    <li class="nav-item">
                                        <a class="nav-link my-0" id="listado-facturas-tab" data-toggle="pill" href="#listado-facturas" role="tab" aria-controls="listado-facturas" aria-selected="true"><i class="fas fa-list"></i> Listado de Facturas</a>
                                    </li>


                                </ul>

                            </div>

                            <div class="card-body py-1">

                                <div class="tab-content" id="custom-tabs-four-tabContent">

                                    <!-- TAB CONTENT REGISTRO DE FACTURAS -->
                                    <div class="tab-pane fade active show" id="registrar-facturas" role="tabpanel" aria-labelledby="registrar-facturas-tab">

                                        <form id="frm-datos-venta-factura" class="needs-validation-venta-factura" novalidate>

                                            <div class="row">

                                                <div class="col-12 col-lg-6 text-center mb-2">
                                                    <div class="form-group clearfix w-100 d-flex justify-content-start justify-content-lg-center my-0 ">
                                                        <div class="icheck-warning d-inline mx-2">
                                                            <input type="radio" id="rb-venta-envio" value="1" name="rb_generar_venta" checked="">
                                                            <label for="rb-venta-envio">
                                                                Generar Venta y Enviar Comprobante
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12 col-lg-6 text-center mb-2">
                                                    <div class="form-group clearfix w-100 d-flex justify-content-start justify-content-lg-center my-0 ">
                                                        <div class="icheck-success d-inline mx-2">
                                                            <input type="radio" id="rb-venta" value="2" name="rb_generar_venta">
                                                            <label for="rb-venta">
                                                                Solo Generar Venta
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- --------------------------------------------------------- -->
                                                <!-- COMPROBANTE DE PAGO -->
                                                <!-- --------------------------------------------------------- -->
                                                <div class="col-12 col-lg-6">

                                                    <div class="card card-gray shadow card-comprobante">

                                                        <div class="card-header">
                                                            <h3 class="card-title fs-6">COMPROBANTE DE PAGO</h3>
                                                            <div class="card-tools m-0">

                                                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                                    <i class="fas fa-minus"></i>
                                                                </button>
                                                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                                                    <i class="fas fa-times"></i>
                                                                </button>

                                                            </div> <!-- ./ end card-tools -->
                                                        </div> <!-- ./ end card-header -->

                                                        <div class="card-body py-2">

                                                            <div class="row">

                                                                <!-- EMITIR POR -->
                                                                <div class="col-12 mb-2">
                                                                    <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-building mr-1 my-text-color"></i> Empresa Emisora</label>
                                                                    <select class="empresa_emisora" style="width: 100%;" id="empresa_emisora" name="empresa_emisora" aria-label="Floating label select example" required>
                                                                    </select>
                                                                    <div class="invalid-feedback">Seleccione Empresa</div>
                                                                </div>

                                                                <div class="col-12 col-lg-4 mb-2">
                                                                    <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-calendar-alt mr-1 my-text-color"></i> Fecha Emisión</label>
                                                                    <div class="input-group input-group-sm mb-3 ">
                                                                        <span class="input-group-text" id="inputGroup-sizing-sm" style="cursor: pointer;" data-toggle="datetimepicker" data-target="#fecha_emision"><i class="fas fa-calendar-alt ml-1 text-white"></i></span>
                                                                        <input type="text" class="form-control form-control-sm datetimepicker-input" style="border-top-right-radius: 20px;border-bottom-right-radius: 20px;" aria-label="Sizing example input" id="fecha_emision" name="fecha_emision" aria-describedby="inputGroup-sizing-sm" required>
                                                                        <div class="invalid-feedback">Ingrese Fecha de Emisión</div>
                                                                    </div>
                                                                </div>


                                                                <!-- TIPO COMPROBANTE -->
                                                                <div class="col-12 col-lg-8 mb-2">
                                                                    <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-file-contract mr-1 my-text-color"></i>Tipo de Comprobante</label>
                                                                    <select class="tipo_comprobante" style="width: 100%;"id="tipo_comprobante" name="tipo_comprobante" aria-label="Floating label select example" required readOnly>
                                                                    </select>
                                                                    <div class="invalid-feedback">Seleccione Tipo de Comprobante</div>
                                                                </div>

                                                                <!-- SERIE -->
                                                                <div class="col-12 col-lg-4 mb-2">
                                                                    <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-barcode mr-1 my-text-color"></i>Serie</label>
                                                                    <select class="form-select" id="serie" name="serie" aria-label="Floating label select example" required>
                                                                    </select>
                                                                    <div class="invalid-feedback">Seleccione la Serie</div>
                                                                </div>

                                                                <!-- CORRELATIVO -->
                                                                <div class="col-12 col-lg-4 mb-2">
                                                                    <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-list-ol mr-1 my-text-color"></i>Correlativo</label>
                                                                    <input type="text" style="border-radius: 20px;" class="form-control form-control-sm" id="correlativo" name="correlativo" aria-label="Small" aria-describedby="inputGroup-sizing-sm" required readonly>
                                                                </div>

                                                                <!-- MONEDA -->
                                                                <div class="col-12 col-lg-4 mb-2">
                                                                    <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-money-bill-wave mr-1 my-text-color"></i>Moneda</label>
                                                                    <select class="form-select" id="moneda" name="moneda" aria-label="Floating label select example" required>
                                                                    </select>
                                                                    <div class="invalid-feedback">Seleccione la moneda</div>
                                                                </div>

                                                            </div>

                                                        </div>

                                                    </div>
                                                </div>

                                                <!-- --------------------------------------------------------- -->
                                                <!-- DATOS DEL CLIENTE -->
                                                <!-- --------------------------------------------------------- -->
                                                <div class="col-12 col-lg-6">
                                                    <div class="card card-gray shadow">

                                                        <div class="card-header">
                                                            <h3 class="card-title fs-6">DATOS DEL CLIENTE</h3>
                                                            <div class="card-tools m-0">

                                                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                                    <i class="fas fa-minus"></i>
                                                                </button>
                                                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                                                    <i class="fas fa-times"></i>
                                                                </button>

                                                            </div>
                                                        </div> <!-- ./ end card-header -->

                                                        <div class="card-body py-2">

                                                            <div class="row">

                                                                <div class="col-12 col-lg-6 mb-2">

                                                                    <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-file-signature mr-1 my-text-color"></i>Tipo Documento</label>
                                                                    <select class="tipo_documento"  style="width: 100%;"id="tipo_documento" name="tipo_documento" aria-label="Floating label select example" required readonly>
                                                                    </select>
                                                                    <div class="invalid-feedback">Seleccione el Tipo de Documento</div>

                                                                </div>

                                                                <div class="col-12 col-lg-6 mb-2">

                                                                    <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-id-card mr-1 my-text-color"></i> Nro Documento</label>
                                                                    <div class="input-group input-group-sm mb-3 ">
                                                                        <span class="input-group-text btnConsultarDni" id="inputGroup-sizing-sm" style="cursor: pointer;"><i class="fas fa-search ml-1 text-white"></i></span>
                                                                        <input type="text" class="form-control form-control-sm" style="border-top-right-radius: 20px;border-bottom-right-radius: 20px;" aria-label="Sizing example input" id="nro_documento" name="nro_documento" placeholder="Ingrese Nro de documento" aria-describedby="inputGroup-sizing-sm" required>
                                                                        <div class="invalid-feedback">Ingrese el Nro de Documento</div>
                                                                    </div>

                                                                </div>

                                                                <div class="col-12 mb-2">

                                                                    <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-user-tie mr-1 my-text-color"></i>Nombre del Cliente/ Razón Social</label>
                                                                    <input type="text" style="border-radius: 20px;" class="form-control form-control-sm" id="nombre_cliente_razon_social" name="nombre_cliente_razon_social" placeholder="Ingrese Nombre del Cliente o Razón Social" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                                                </div>

                                                                <div class="col-12 col-lg-9 mb-2">

                                                                    <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-map-marker-alt mr-1 my-text-color"></i>Dirección</label>
                                                                    <input type="text" style="border-radius: 20px;" class="form-control form-control-sm" id="direccion" name="direccion" placeholder="Ingrese la dirección" aria-label="Small" aria-describedby="inputGroup-sizing-sm">

                                                                </div>

                                                                <div class="col-12 col-lg-3 mb-2">

                                                                    <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-phone-alt mr-1 my-text-color"></i>Teléfono</label>
                                                                    <input type="text" style="border-radius: 20px;" class="form-control form-control-sm" id="telefono" name="telefono" placeholder="Teléfono" aria-label="Small" aria-describedby="inputGroup-sizing-sm">

                                                                </div>

                                                            </div>

                                                        </div>

                                                    </div>
                                                </div>

                                                <!-- --------------------------------------------------------- -->
                                                <!-- LISTADO DE PRODUCTOS -->
                                                <!-- --------------------------------------------------------- -->
                                                <div class="col-12 col-lg-8">

                                                    <div class="card card-gray shadow">

                                                        <div class="card-header">
                                                            <h4 class="card-title fs-6">LISTADO DE PRODUCTOS</h4>
                                                            <div class="card-tools m-0">

                                                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                                    <i class="fas fa-minus"></i>
                                                                </button>
                                                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                                                    <i class="fas fa-times"></i>
                                                                </button>

                                                            </div> <!-- ./ end card-tools -->

                                                        </div> <!-- ./ end card-header -->

                                                        <div class="card-body py-2">

                                                            <div class="row">

                                                                <div class="d-block col-12 d-lg-none col-lg-12 mb-3">
                                                                    <div class="col-12 text-center px-2 rounded-3">
                                                                        <div class="btn fw-bold fs-3  text-warning my-bg w-100" id="totalVenta">S/0.00</div>
                                                                    </div>
                                                                </div>

                                                                <!-- INPUT PARA INGRESO DEL CODIGO DE BARRAS O DESCRIPCION DEL PRODUCTO -->
                                                                <div class="col-12 mb-2">
                                                                    <!-- <div class="form-floating mb-2">
                                                            <input type="text" id="producto" class="form-control" name="producto">
                                                            <label for="producto">Digite el Producto a vender</label>                                                            
                                                        </div> -->
                                                                    <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-cart-plus mr-1 my-text-color"></i>Digite el Producto a vender</label>
                                                                    <input type="text" placeholder="Ingrese el código de barras o el nombre del producto" style="border-radius: 20px;" class="form-control form-control-sm" id="producto" name="producto" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                                                </div>

                                                                <div class="col-12 col-lg-4 mb-2">
                                                                    <!-- <div class="form-floating mb-2"> -->
                                                                    <!-- <select class="form-select select2" id="tipo_operacion" name="tipo_operacion" aria-label="Floating label select example" required>
                                                            </select>
                                                            <label for="tipo_operacion">Tipo Operación</label> -->
                                                                    <!-- <div class="invalid-feedback">Ingrese el codigo del Producto</div> -->

                                                                    <!-- </div> -->

                                                                    <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-file-alt mr-1 my-text-color"></i>Tipo Operación</label>
                                                                    <select class="form-select" id="tipo_operacion" name="tipo_operacion" aria-label="Floating label select example" required>
                                                                    </select>
                                                                    <div class="invalid-feedback">Ingrese el Tipo de Operación</div>
                                                                </div>

                                                                <!-- FORMA DE PAGO -->
                                                                <div class="col-12 col-lg-3 mb-2">
                                                                    <!-- <div class="form-floating mb-2">
                                                            <select class="form-select select2" id="forma_pago" name="forma_pago" aria-label="Floating label select example" required>
                                                            </select>
                                                            <label for="forma_pago">Forma de Pago</label>
                                                            <div class="invalid-feedback">Ingrese el codigo del Producto</div>
                                                        </div> -->
                                                                    <label class="mb-0 ml-1 text-sm my-text-color"><i class="far fa-credit-card mr-1 my-text-color"></i>Forma de Pago</label>
                                                                    <select class="form-select" id="forma_pago" name="forma_pago" aria-label="Floating label select example" required>
                                                                    </select>
                                                                    <div class="invalid-feedback">Ingrese Forma de Pago</div>
                                                                </div>

                                                                <!-- TOTAL RECIBIDO -->
                                                                <div class="col-12 col-lg-3 mb-2">
                                                                    <!-- <div class="form-floating mb-2">
                                                            <input type="number" min="0" step="0.01" id="total_recibido" class="form-control" name="total_recibido">
                                                            <label for="total_recibido">Total Recibido</label>
                                                            <div class="invalid-feedback">Ingrese el codigo del Producto</div>
                                                        </div> -->

                                                                    <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-hand-holding-usd mr-1 my-text-color"></i>Total Recibido</label>
                                                                    <input type="number" min="0" step="0.01" placeholder="Dinero recibido" style="border-radius: 20px;" class="form-control form-control-sm" id="total_recibido" name="total_recibido" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                                                </div>

                                                                <!-- VUELTO -->
                                                                <div class="col-12 col-lg-2 mb-2">
                                                                    <!-- <div class="form-floating mb-2">
                                                            <input type="number" min="0" id="vuelto" step="0.01" class="form-control" name="vuelto">
                                                            <label for="vuelto">Vuelto</label>
                                                            <div class="invalid-feedback">Ingrese el codigo del Producto</div>
                                                        </div> -->
                                                                    <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-hand-holding-usd mr-1 my-text-color"></i>Vuelto</label>
                                                                    <input type="number" min="0" step="0.01" placeholder="Vuelto" style="border-radius: 20px;" class="form-control form-control-sm" id="vuelto" name="vuelto" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                                                </div>


                                                                <!-- LISTADO QUE CONTIENE LOS PRODUCTOS QUE SE VAN AGREGANDO PARA LA COMPRA -->
                                                                <div class="col-md-12 mt-2">

                                                                    <table id="tbl_ListadoProductos" class="display nowrap table-striped w-100 shadow ">
                                                                        <thead class="bg-main text-left fs-6">
                                                                            <tr>
                                                                                <th>ITEM</th>
                                                                                <th>CÓDIGO</th>
                                                                                <th>DESCRIPCIÓN</th>
                                                                                <th>ID TIPO IGV</th>
                                                                                <th>TIPO IGV</th>
                                                                                <th>UND/MEDIDA</th>
                                                                                <th>VALOR</th>
                                                                                <th>CANTIDAD</th>
                                                                                <th>CANTIDAD FINAL</th>
                                                                                <th>SUBTOTAL</th>
                                                                                <th>IGV</th>
                                                                                <th>IMPORTE</th>
                                                                                <th></th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody class="small text-left fs-6">
                                                                        </tbody>
                                                                    </table>
                                                                    <!-- / table -->
                                                                </div>


                                                                <!-- /.col -->
                                                            </div>
                                                        </div> <!-- ./ end card-body -->
                                                    </div>
                                                </div>

                                                <!-- --------------------------------------------------------- -->
                                                <!-- RESUMEN DE LA VENTA -->
                                                <!-- --------------------------------------------------------- -->
                                                <div class="col-12 col-lg-4">

                                                    <div class="row">

                                                        <!-- <div class="d-none d-lg-block col-lg-12 mb-3">
                                                <div class="col-12 text-center px-2 rounded-3">
                                                    <div class="btn fw-bold fs-3  text-warning my-bg w-100" id="totalVenta">S/0.00</div>
                                                </div>
                                            </div> -->

                                                        <div class="col-12">
                                                            <!-- --------------------------------------------------------- -->
                                                            <!-- RESUMEN DE LA VENTA -->
                                                            <!-- --------------------------------------------------------- -->
                                                            <div class="card card-gray shadow w-lg-100 float-right">

                                                                <div class="card-header">
                                                                    <h3 class="card-title fs-6">RESUMEN</h3>
                                                                </div> <!-- ./ end card-header -->

                                                                <div class="card-body py-2">

                                                                    <div class="row fw-bold">

                                                                        <div class="col-12 col-md-12">
                                                                            <span>OP. GRAVADAS</span>
                                                                            <span class="float-right" id="resumen_opes_gravadas">S/
                                                                                0.00</span>
                                                                        </div>
                                                                        <div class="col-12 col-md-12">
                                                                            <span>OP. INAFECTAS</span>
                                                                            <span class="float-right" id="resumen_opes_inafectas">S/
                                                                                0.00</span>
                                                                        </div>
                                                                        <div class="col-12 col-md-12">
                                                                            <span>OP. EXONERADAS</span>
                                                                            <span class="float-right" id="resumen_opes_exoneradas">S/
                                                                                0.00</span>
                                                                        </div>
                                                                        <div class="col-12 col-md-12">
                                                                            <span>SUBTOTAL</span>
                                                                            <span class="float-right" id="resumen_subtotal">S/ 0.00</span>
                                                                        </div>
                                                                        <div class="col-12 col-md-12">
                                                                            <span>IGV</span>
                                                                            <span class="float-right" id="resumen_total_igv">S/ 0.00</span>
                                                                            <hr class="m-1" />
                                                                        </div>

                                                                        <div class="col-12 col-md-12 fs-4 my-color">
                                                                            <span>TOTAL</span>
                                                                            <span class="float-right " id="resumen_total_venta">S/
                                                                                0.00</span>
                                                                        </div>

                                                                    </div>

                                                                </div>

                                                            </div>
                                                        </div>

                                                        <div class="col-12 text-center my-1">
                                                            <a class="btn btn-sm btn-danger  fw-bold " id="btnCancelarVenta" style="position: relative; width: 160px;">
                                                                <span class="text-button">CANCELAR</span>
                                                                <span class="btn fw-bold icon-btn-danger d-flex align-items-center">
                                                                    <i class="fas fa-times fs-5 text-white m-0 p-0"></i>
                                                                </span>
                                                            </a>

                                                            <a class="btn btn-sm btn-success  fw-bold " id="btnGuardarComprobante" style="position: relative; width: 160px;">
                                                                <span class="text-button">VENDER</span>
                                                                <span class="btn fw-bold icon-btn-success d-flex align-items-center">
                                                                    <i class="fas fa-save fs-5 text-white m-0 p-0"></i>
                                                                </span>
                                                            </a>
                                                        </div>

                                                        <!-- <div class="col-12 text-center">
                                                <div class="form-group clearfix w-100 d-flex justify-content-evenly ">
                                                    <div class="icheck-warning d-inline mx-2">
                                                        <input type="radio" id="rb-venta-envio" value="1" name="rb_generar_venta" checked="">
                                                        <label for="rb-venta-envio">
                                                            Generar Venta y Enviar Comprobante
                                                        </label>
                                                    </div>

                                                    <div class="icheck-success d-inline mx-2">
                                                        <input type="radio" id="rb-venta" value="2" name="rb_generar_venta">
                                                        <label for="rb-venta">
                                                            Solo Generar Venta
                                                        </label>
                                                    </div>

                                                </div>

                                            </div> -->
                                                    </div>


                                                </div>

                                            </div>

                                        </form>

                                    </div>

                                    <!-- TAB CONTENT LISTADO DE FACTURAS -->
                                    <div class="tab-pane fade" id="listado-facturas" role="tabpanel" aria-labelledby="listado-facturas-tab">

                                        <div class="row">

                                            <!--LISTADO DE BOLETAS -->
                                            <div class="col-md-12">
                                                <table id="tbl_facturas" class="table  w-100 shadow border border-secondary">
                                                    <thead class="bg-main text-left">
                                                        <th></th>
                                                        <th>Id</th>
                                                        <th>Comprob.</th>
                                                        <th>Fec. Emisión</th>
                                                        <th>Ope. Gravadas</th>
                                                        <th>Ope. Exoneradas</th>
                                                        <th>Ope. Inafectas</th>
                                                        <th>Total Igv</th>
                                                        <th>Importe Total</th>
                                                        <th>Estado Resp. Sunat</th>
                                                        <th>Estado Sunat</th>
                                                        <th>Nombre Xml</th>
                                                        <th>Estado Comprobante</th>
                                                        <th>Mensaje Sunat</th>
                                                    </thead>
                                                </table>
                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <!-- /.card -->
                        </div>

                    </div>

                </div>

            </div>

            <!-- =========================================================================
MODAL CUOTAS DEL CREDITO
========================================================================================-->
            <div class="modal fade" id="mdlCronogramaPagos" role="dialog" tabindex="-1">

                <div class="modal-dialog modal-lg" role="document">

                    <!-- contenido del modal -->
                    <div class="modal-content">

                        <!-- cabecera del modal -->
                        <div class="modal-header my-bg py-1">

                            <h5 class="modal-title text-white text-lg">Cronograma de Pagos</h5>

                            <button type="button" class="btn btn-danger btn-sm text-white text-sm" data-bs-dismiss="modal">
                                <i class="fas fa-times text-sm m-0 p-0"></i>
                            </button>

                        </div>

                        <!-- cuerpo del modal -->
                        <div class="modal-body">

                            <div class="row mb-2">

                                <!-- TOTAL DE CUOTAS -->
                                <!-- <div class="col-12 col-md-5 col-lg-2 mb-1">
                                    <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-id-card mr-1 my-text-color"></i>Cuota N° <strong class="text-danger fw-bold">*</strong></label>
                                    <input type="number" style="border-radius: 20px;" class="form-control form-control-sm" id="nro_cuota" name="nro_cuota" aria-label="Small" aria-describedby="inputGroup-sizing-sm" required>
                                </div> -->

                                <!-- FECHA INICIO CUOTAS -->
                                <div class="col-12 col-md-5 col-lg-3 mb-1">
                                    <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-id-card mr-1 my-text-color"></i> Fecha Vencimiento <strong class="text-danger fw-bold">*</strong></label>
                                    <div class="input-group input-group-sm mb-3 ">
                                        <span class="input-group-text" id="inputGroup-sizing-sm" style="cursor: pointer;" data-toggle="datetimepicker" data-target="#fecha_vencimiento"><i class="fas fa-calendar-alt ml-1 text-white"></i></span>
                                        <input type="text" class="form-control form-control-sm datetimepicker-input" style="border-top-right-radius: 20px;border-bottom-right-radius: 20px;" aria-label="Sizing example input" id="fecha_vencimiento" name="fecha_vencimiento" aria-describedby="inputGroup-sizing-sm" required>
                                        <div class="invalid-feedback">Ingrese Fecha de Registro</div>
                                    </div>
                                </div>

                                <!-- IMPORTE DE LA CUOTA -->
                                <div class="col-12 col-md-5 col-lg-2 mb-1">
                                    <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-id-card mr-1 my-text-color"></i>Importe <strong class="text-danger fw-bold">*</strong></label>
                                    <input type="number" style="border-radius: 20px;" class="form-control form-control-sm" id="importe_cuota" name="importe_cuota" aria-label="Small" aria-describedby="inputGroup-sizing-sm" required>
                                </div>

                                <!-- IMPORTE DE LA VENTA -->
                                <div class="col-12 col-md-5 col-lg-2 mb-1">
                                    <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-id-card mr-1 my-text-color"></i>Total Venta</label>
                                    <input type="text" style="border-radius: 20px;" class="form-control form-control-sm" id="total_venta" aria-label="Small" aria-describedby="inputGroup-sizing-sm" readonly>
                                </div>

                                <div class="col-5 text-right d-flex align-items-end justify-content-end mb-1">
                                    <a class="btn btn-sm btn-success  fw-bold " id="btnAgregarCuota" style="position: relative; width: 120px;">
                                        <span class="text-button">AGREGAR</span>
                                        <span class="btn fw-bold icon-btn-success d-flex align-items-center">
                                            <i class="fas fa-plus fs-5 text-white m-0 p-0"></i>
                                        </span>
                                    </a>
                                </div>

                            </div>

                            <div class="row">

                                <div class="col-12">

                                    <table id="tbl_cronograma" class="table  w-100 shadow border border-secondary">
                                        <thead class="bg-main text-left">
                                            <th>Cuota</th>
                                            <th>Vencimiento</th>
                                            <th>Importe</th>
                                            <th>Saldo</th>
                                            <th></th>
                                        </thead>

                                        <body>
                                        </body>
                                    </table>

                                </div>

                            </div>

                            <div class="row mt-3">

                                <div class="col-12 text-center">

                                    <a class="btn btn-sm btn-success fw-bold " id="btnConfirmarVenta" style="position: relative; width: 200px;">
                                        <span class="text-button">CONFIRMAR VENTA</span>
                                        <span class="btn fw-bold icon-btn-success ">
                                            <i class="fas fa-save fs-5 text-white m-0 p-0"></i>
                                        </span>
                                    </a>

                                </div>

                            </div>

                        </div>


                    </div>

                </div>

            </div>

            <!-- <div class="loading">Loading</div> -->

        </div>
    </div>

    <script>
        $(function() {
            $('#tipo_documento').select2({
                placeholder: "Selecciona un Tipo de Documento", // Puedes definir un placeholder
                allowClear: true // Permite limpiar la selección
            });
            $('#tipo_comprobante').select2({
                placeholder: "Selecciona un Tipo de Comprobante", // Puedes definir un placeholder
                allowClear: true // Permite limpiar la selección
            });





            //METODOS PARA LLENAR LOS SELECT2
            cargarTipoDocumento();
            cargarTipoComprobante();
        });


        //FUNCIONES PARA RELLENAR TODOS LOS SELECT2
        function cargarTipoDocumento() {
            CargarSelect(null, $("#tipo_documento"), "", "ventas/loadCboTipoDocumento", 'obtener Tipo Documento', null, 1);
        }
        function cargarTipoComprobante() {
            CargarSelect(null, $("#tipo_comprobante"), "--Seleccione el Comprobante--", "ventas/loadCboTipoComprobante", 'obtener_tipoComprobante', null, 1);
        }
    </script>