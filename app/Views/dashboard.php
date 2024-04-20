<div class="content-wrapper">

    <div class="content">
        <div class="container-fluid">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h2 class="m-0 fw-bold">TABLERO PRINCIPAL</h2>
                        </div><!-- /.col -->
                        <div class="col-sm-6 d-none d-md-block">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
                                <li class="breadcrumb-item active">Tablero Principal</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- --------------------------------------------------------- -->
            <!-- TARJETAS INFORMATIVAS -->
            <!-- --------------------------------------------------------- -->
            <div class="row">

                <div class="col-6 col-md-4 col-lg-2 px-1">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner px-1 text-center fw-bold">
                            <h6 id="totalProductos" class="fw-bold"></h6>

                            <p>Productos</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-clipboard"></i>
                        </div>
                        <!-- <a style="cursor:pointer;" class="small-box-footer">Mas Info <i class="fas fa-arrow-circle-right"></i></a> -->
                    </div>
                </div>

                <!-- TARJETA TOTAL COMPRAS -->
                <div class="col-6 col-md-4 col-lg-2 px-1">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner px-1 text-center fw-bold">
                            <h6 id="totalCompras" class="fw-bold"></h6>

                            <p>Costo Inventario</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-cash"></i>
                        </div>
                        <!-- <a style="cursor:pointer;" class="small-box-footer">Mas Info <i class="fas fa-arrow-circle-right"></i></a> -->
                    </div>
                </div>

                <!-- TARJETA TOTAL VENTAS -->
                <div class="col-6 col-md-4 col-lg-2 px-1">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner px-1 text-center fw-bold">
                            <h6 id="totalVentas" class="fw-bold"></h6>

                            <p>Total Ventas</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-ios-cart"></i>
                        </div>
                        <!-- <a style="cursor:pointer;" class="small-box-footer">Mas Info <i class="fas fa-arrow-circle-right"></i></a> -->
                    </div>
                </div>

                <!-- TARJETA TOTAL GANANCIAS -->
                <div class="col-6 col-md-4  col-lg-2 px-1">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner px-1 text-center fw-bold">
                            <h6 id="totalGanancias" class="fw-bold"></h6>

                            <p>Total Ganancias</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-ios-pie"></i>
                        </div>
                        <!-- <a style="cursor:pointer;" class="small-box-footer">Mas Info <i class="fas fa-arrow-circle-right"></i></a> -->
                    </div>
                </div>

                <!-- TARJETA PRODUCTOS POCO STOCK -->
                <div class="col-6 col-md-4 col-lg-2 px-1">
                    <!-- small box -->
                    <div class="small-box bg-primary">
                        <div class="inner px-1 text-center fw-bold">
                            <h6 id="totalProductosMinStock" class="fw-bold"></h6>

                            <p>Productos poco stock</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-android-remove-circle"></i>
                        </div>
                        <!-- <a style="cursor:pointer;" class="small-box-footer">Mas Info <i class="fas fa-arrow-circle-right"></i></a> -->
                    </div>
                </div>

                <!-- TARJETA TOTAL VENTAS DIA ACTUAL -->
                <div class="col-6 col-md-4 col-lg-2 px-1">
                    <!-- small box -->
                    <div class="small-box bg-secondary">
                        <div class="inner px-1 text-center fw-bold">
                            <h6 id="totalVentasHoy" class="fw-bold"></h6>

                            <p>Ventas del día</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-android-calendar"></i>
                        </div>
                        <!-- <a style="cursor:pointer;" class="small-box-footer">Mas Info <i class="fas fa-arrow-circle-right"></i></a> -->
                    </div>
                </div>

                <!-- --------------------------------------------------------- -->
                <!-- GRÁFICO DE BARRAS Y DUNGHTS -->
                <!-- --------------------------------------------------------- -->


                <div class="col-12">

                    <div class="card card-gray shadow">

                        <div class="card-header">

                            <h3 class="card-title" id="title-header-ventas-mes"></h3>

                            <div class="card-tools">

                                <button id="reloadGraficos" title="Recargar Gráfico" class="btn btn-secondary"><i class="fas fa-sync-alt"></i></button>

                                <button id="changeType" title="Cambiar Tipo de Gráfico" class="btn btn-secondary"><i class="fas fa-chart-bar"></i></button>

                                <button type="button" title="Exportar a Excel" class="btn btn-secondary" id="exportarExcel">
                                    <i class="fas fa-file-excel"></i>
                                </button>

                                <!-- Separador -->
                                <div class="separador-card-tools"></div>

                                <!-- Botones de minimizar y cerrar -->

                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>

                            </div> <!-- ./ end card-tools -->

                        </div> <!-- ./ end card-header -->


                        <div class="card-body">

                            <div class="chart">

                                <canvas id="barChart" style="min-height: 250px; height: 300px; max-height: 350px; width: 100%;">

                                </canvas>

                            </div>

                        </div> <!-- ./ end card-body -->

                    </div>

                </div>


                <div class="col-12 col-lg-6">

                    <div class="card card-gray shadow">

                        <div class="card-header">

                            <h3 class="card-title"> TOP VENTAS POR CATEGORÍA</h3>

                            <div class="card-tools">

                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>

                            </div> <!-- ./ end card-tools -->

                        </div> <!-- ./ end card-header -->


                        <div class="card-body">

                            <div class="chart">

                                <div id="chartContainer" style="min-height: 250px; height: 300px; max-height: 350px; width: 100%;"></div>

                            </div>

                        </div> <!-- ./ end card-body -->

                    </div>

                </div>

                <div class="col-12 col-lg-6">

                    <div class="card card-gray shadow">

                        <div class="card-header">

                            <h3 class="card-title"> FACTURAS / BOLETAS</h3>

                            <div class="card-tools">

                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>

                            </div> <!-- ./ end card-tools -->

                        </div> <!-- ./ end card-header -->


                        <div class="card-body">

                            <div class="chart">

                                <div id="chartContainerFacturasBoletas" style="min-height: 250px; height: 300px; max-height: 350px; width: 100%;"></div>

                            </div>

                        </div> <!-- ./ end card-body -->

                    </div>

                </div>




                <!-- --------------------------------------------------------- -->
                <!-- PRODUCTOS MAS VENDIDOS Y POCO STOCK -->
                <!-- --------------------------------------------------------- -->
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card card-gray shadow">
                            <div class="card-header">
                                <h3 class="card-title">LOS 10 PRODUCTOS MAS VENDIDOS</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div> <!-- ./ end card-tools -->
                            </div> <!-- ./ end card-header -->
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table" id="tbl_productos_mas_vendidos">
                                        <thead>
                                            <tr class="text-danger">
                                                <!-- <th>Cod. producto</th> -->
                                                <th>Producto</th>
                                                <th class="text-center">Cantidad</th>
                                                <th class="text-center">Ventas</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div> <!-- ./ end card-body -->
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card card-gray shadow">
                            <div class="card-header">
                                <h3 class="card-title">PRODUCTOS CON POCO STOCK</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div> <!-- ./ end card-tools -->
                            </div> <!-- ./ end card-header -->
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table" id="tbl_productos_poco_stock">
                                        <thead>
                                            <tr class="text-danger">
                                                <!-- <th>Cod. producto</th> -->
                                                <th>Producto</th>
                                                <th class="text-center">Stock Actual</th>
                                                <th class="text-center">Mín. Stock</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div> <!-- ./ end card-body -->
                        </div>
                    </div>
                </div>





            </div>
        </div>

        <div class="loading">Loading</div>

        <script>
            $(document).ready(function() {

                fnc_MostrarLoader()


                cargarTarjetasInformativas();
                cargarGraficoBarras('bar');
                cargarGraficoDoughnut();
                // cargarProductosMasVendidos();
                // cargarProductosPocoStock();


                setInterval(() => {
                    $.ajax({
                        url: "dashboard/datosDashboard",
                        method: 'POST',

                        dataType: 'json',
                        success: function(respuesta) {

                            cargarTarjetasInformativas();
                            cargarGraficoBarras('bar');
                            // cargarGraficoDoughnut();
                            // cargarProductosMasVendidos();
                            // cargarProductosPocoStock();

                        }
                    });
                }, 30000);

                fnc_OcultarLoader();


                $('#reloadGraficos').click(function() {
                    cargarGraficoBarras('bar');
                });

                $('#exportarExcel').click(function() {
                    // Solo intenta exportar si hay datos disponibles.
                    if (datosDelGraficoGlobal != "") {
                        exportarAExcel(datosDelGraficoGlobal, "Datos_Grafico_Barras");
                    } else {
                        alert('No hay datos disponibles para exportar.');
                    }
                });
                document.getElementById('changeType').addEventListener('click', function() {
                    // Determina el nuevo tipo de gráfico
                    var newType = currentChart.config.type === 'bar' ? 'line' : 'bar';

                    // Crea un nuevo gráfico con el nuevo tipo
                    cargarGraficoBarras(newType);
                });

            })

            function fnc_MostrarLoader() {
                $(".loading").removeClass('d-none');
                $(".loading").addClass('d-block');
            }

            function fnc_OcultarLoader() {
                $(".loading").removeClass('d-block');
                $(".loading").addClass('d-none')
            }

            /* =======================================================
            SOLICITUD AJAX TARJETAS INFORMATIVAS
            =======================================================*/
            function cargarTarjetasInformativas() {

                $.ajax({
                    url: "dashboard/datosDashboard",
                    method: 'POST',
                    dataType: 'json',
                    success: function(respuesta) {
                        $("#totalProductos").html(respuesta['totalProductos']);
                        $("#totalCompras").html(respuesta['totalCompras']);
                        $("#totalVentas").html(respuesta['totalVentas']);
                        $("#totalGanancias").html(respuesta['ganancias']); // Nota: Este incluye ganancias y porcentaje
                        $("#totalProductosMinStock").html(respuesta['productosPocoStock']);
                        $("#totalVentasHoy").html(respuesta['ventasHoy']);
                    }
                });

            }


            /* =======================================================
            SOLICITUD AJAX GRAFICO DE BARRAS DE VENTAS DEL MES
            =======================================================*/
            var datosDelGraficoGlobal;
            var currentChart;

            function cargarGraficoBarras(type) {
                $.ajax({
                    url: "dashboard/grafico_barras",
                    method: 'POST',
                    dataType: 'json',
                    success: function(respuesta) {
                        var labels = []; // 
                        var totalVentaActual = []; // Totales del mes actual
                        var totalVentaAnterior = []; // Totales del mes anterior

                        respuesta.actual.forEach(function(data) {
                            labels.push(data.fecha_venta);
                            totalVentaActual.push(data.total_venta);
                        });

                        respuesta.anterior.forEach(function(data, index) {
                            if (totalVentaAnterior.length <= index) {
                                totalVentaAnterior.push(0); // Asegura que el arreglo tenga la longitud adecuada
                            }
                            totalVentaAnterior[index] += data.total_venta; // Asume que los datos están en el mismo orden
                        });

                        // Recojo los datos para utilizarlos en EXCEL
                        var datosDelGraficoGlobal = obtenerDatosParaExcel(respuesta.actual, respuesta.anterior);


                        // Aquí dibujamos el gráfico
                        $("#title-header-ventas-mes").html('VENTAS DEL MES: $ ' + totalVentaActual); // Suma el total
                        var ctx = document.getElementById('barChart').getContext('2d');
                        // Si ya existe un gráfico, destrúyelo
                        if (window.currentChart) {
                            window.currentChart.destroy();
                        }

                        window.currentChart = new Chart(ctx, {
                            type: type,
                            data: {
                                labels: labels,
                                datasets: [{
                                    label: 'Mes Actual',
                                    data: totalVentaActual,
                                    backgroundColor: 'rgba(60,141,188,0.9)'
                                }, {
                                    label: 'Mes Anterior',
                                    data: totalVentaAnterior,
                                    backgroundColor: 'rgb(255, 140, 0,0.9)'
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                plugins: {
                                    animation: {
                                        duration: 1000, // Duración en milisegundos
                                        easing: 'easeOutBounce' // Efecto de easing
                                    },
                                    legend: {
                                        display: true, // Mostrar leyenda
                                        position: 'bottom', // Posición de la leyenda
                                        labels: {
                                            color: '#333', // Color del texto
                                            font: {
                                                size: 14 // Tamaño del texto
                                            }
                                        }
                                    }
                                },

                                scales: {
                                    x: { // Nota que 'xAxes' también cambia a 'x'
                                        stacked: false,
                                    },
                                    y: { // 'yAxes' cambia a 'y'
                                        stacked: false,
                                        beginAtZero: true,
                                        // Puedes agregar configuraciones adicionales aquí si es necesario
                                        type: 'logarithmic',
                                        ticks: {
                                            // Usar una función de devolución de llamada para formatear los ticks
                                            callback: function(value, index, values) {
                                                return '$ ' + value; // Agrega un símbolo de dólar antes de cada tick
                                            }
                                        },
                                        title: {
                                            display: true,
                                            text: 'Total de entre los 2 meses',
                                            color: '#666', // Color del texto del título
                                            font: {
                                                size: 16 // Tamaño del texto
                                            }
                                        }
                                    }
                                },
                            }
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error("Error en AJAX: ", status, error);
                    }
                });
            }


            function obtenerDatosParaExcel(datosActuales, datosAnteriores) {
                let datosParaExcel = [];

                // Asumiendo que 'datosActuales' y 'datosAnteriores' son arrays y tienen la misma longitud
                for (let i = 0; i < datosActuales.length; i++) {
                    let fila = {
                        Fecha: datosActuales[i].fecha_venta,
                        VentaActual: datosActuales[i].total_venta,
                        VentaAnterior: datosAnteriores[i] ? datosAnteriores[i].total_venta : 0
                    };
                    datosParaExcel.push(fila);
                }

                return datosParaExcel;
            }

            function exportarAExcel(chartData, nombreDelArchivo) {
                var wb = XLSX.utils.book_new();
                var ws = XLSX.utils.json_to_sheet(chartData);
                XLSX.utils.book_append_sheet(wb, ws, "Datos");

                // Genera el archivo Excel como un ArrayBuffer directamente
                var wbout = XLSX.write(wb, {
                    bookType: 'xlsx',
                    type: 'array'
                });

                // Guardar el archivo usando FileSaver
                saveAs(new Blob([wbout], {
                    type: "application/octet-stream"
                }), `${nombreDelArchivo}.xlsx`);
            }

            /* =======================================================
            SOLICITUD AJAX GRAFICO DE DOUGHNUT
            =======================================================*/
            function cargarGraficoDoughnut() {

                $.ajax({
                    url: "dashboard/topVentasCategorias",
                    method: 'POST',
                    dataType: 'json',
                    success: function(respuesta) {
                        // Primero, vamos a mapear 'respuesta' para ajustarla al formato de 'dataPoints'.
                        var dataPoints = respuesta.map(function(item) {
                            return {
                                y: parseFloat(item.y), // Convierte el string 'y' a un número flotante
                                label: item.label
                            };
                        });

                        // Ahora 'dataPoints' está en el formato correcto y podemos pasarlo a CanvasJS.
                        var chart = new CanvasJS.Chart("chartContainer", {
                            animationEnabled: true,
                            title: {
                                text: "Porcentaje de Ventas por Categoría de Productos"
                            },
                            data: [{
                                type: "doughnut",
                                startAngle: 60,
                                indexLabelFontSize: 17,
                                indexLabel: "{label} - #percent%",
                                toolTipContent: "<b>{label}:</b> {y} (#percent%)",
                                dataPoints: dataPoints
                            }]
                        });
                        chart.render();
                    },
                    error: function(xhr, status, error) {
                        console.log("Error:", xhr, status, error);
                    }
                });

                $.ajax({
                    url: "dashboard/graficoDoughnutTipoComprobantes",
                    method: 'POST',
                    dataType: 'json',
                    success: function(respuesta) {

                        // Primero, vamos a mapear 'respuesta' para ajustarla al formato de 'dataPoints'.
                        var dataPoints = respuesta.map(function(item) {
                            return {
                                y: parseFloat(item.y), // Convierte el string 'y' a un número flotante
                                label: item.label
                            };
                        });

                        // Ahora 'dataPoints' está en el formato correcto y podemos pasarlo a CanvasJS.
                        var chart = new CanvasJS.Chart("chartContainerFacturasBoletas", {
                            animationEnabled: true,
                            title: {
                                text: "Proporción de Tipos de Comprobantes Emitidos"
                            },
                            data: [{
                                type: "doughnut",
                                startAngle: 60,
                                indexLabelFontSize: 17,
                                indexLabel: "{label} - #percent%",
                                toolTipContent: "<b>{label}:</b> {y} (#percent%)",
                                dataPoints: dataPoints
                            }]
                        });
                        chart.render();

                    }
                });



            }


            /* =======================================================
            SOLICITUD AJAX PRODUCTOS MAS VENDIDOS
            =======================================================*/
            function cargarProductosMasVendidos() {

                // $("#tbl_productos_mas_vendidos tbody").html('');

                $.ajax({
                    url: "ajax/dashboard.ajax.php",
                    type: "POST",
                    data: {
                        'accion': 'productos_mas_vendidos' // listar los 10 productos mas vendidos
                    },
                    dataType: 'json',
                    success: function(respuesta) {

                        for (let i = 0; i < respuesta.length; i++) {
                            filas = '<tr>' +
                                // '<td>'+ respuesta[i]["codigo_producto"] + '</td>'+
                                '<td>' + respuesta[i]["descripcion"] + '</td>' +
                                '<td class="text-center">' + respuesta[i]["cantidad"] + '</td>' +
                                '<td class="text-center"> S./ ' + respuesta[i]["total_venta"] + '</td>' +
                                '</tr>'
                            $("#tbl_productos_mas_vendidos tbody").append(filas);
                        }

                    }
                });

            }


            /* =======================================================
            SOLICITUD AJAX PRODUCTOS CON POCO STOCK
            =======================================================*/
            function cargarProductosPocoStock() {

                $("#tbl_productos_poco_stock tbody").html('');

                $.ajax({
                    url: "ajax/dashboard.ajax.php",
                    type: "POST",
                    data: {
                        'accion': 'productos_poco_stock' // listar los  productos con poco stock
                    },
                    dataType: 'json',
                    success: function(respuesta) {
                        for (let i = 0; i < respuesta.length; i++) {
                            filas = '<tr>' +
                                // '<td>'+ respuesta[i]["codigo_producto"] + '</td>'+   
                                '<td>' + respuesta[i]["descripcion"] + '</td>' +
                                '<td class="text-center">' + respuesta[i]["stock"] + '</td>' +
                                '<td class="text-center">' + respuesta[i]["minimo_stock"] + '</td>' +
                                '</tr>'
                            $("#tbl_productos_poco_stock tbody").append(filas);
                        }

                    }
                });

            }

            // window.onload = function() {
            //     var chart = new CanvasJS.Chart("chartContainer", {
            //         animationEnabled: true,
            //         title: {
            //             text: "Categorías de Email"
            //         },
            //         data: [{
            //             type: "doughnut",
            //             startAngle: 60,
            //             indexLabelFontSize: 17,
            //             indexLabel: "{label} - #percent%",
            //             toolTipContent: "<b>{label}:</b> {y} (#percent%)",
            // dataPoints: [{
            //         y: 67.00,
            //         label: "Aceites"
            //     },
            //     {
            //         y: 28.05,
            //         label: "Arroz"
            //     },
            //     {
            //         y: 28.35,
            //         label: "Huevos"
            //     },
            //     // Más puntos de datos aquí...
            // ]
            //         }]
            //     });
            //     chart.render();
            // }
        </script>