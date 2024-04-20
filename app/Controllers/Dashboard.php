<?php

namespace App\Controllers;

use App\Models\ClientesModel;

class Dashboard extends BaseController
{
    public $db;
    protected $clientes;

    public function __construct()
    {
        $this->clientes = new ClientesModel();
        $this->db =  \Config\Database::connect();
    }

    public function index()
    {
        echo view('layout/header');
        echo view('layout/aside');
        echo view('dashboard');
        echo view('layout/footer');
    }


    public function obtenerDatosDashboard()
    {
        // Total de Productos
        $totalProductos = $this->db->table('producto')->countAllResults();

        // Total de Compras
        $totalCompras = $this->db->table('producto')
            ->select('SUM(precio_compra * stock) as total_compras', false)
            ->get()
            ->getRow()
            ->total_compras;

        // Total de Ventas
        $totalVentas = $this->db->table('venta')
            ->selectSum('importe_total')
            ->get()
            ->getRow()
            ->importe_total;

        // Ganancias
        $gananciasQuery = $this->db->table('venta_detalle as vd')
            ->select('SUM(vd.importe) - SUM(p.precio_compra * vd.cantidad) as ganancia_total', false)
            ->join('producto as p', 'vd.id_producto = p.id_producto', 'inner')
            ->get()
            ->getRow();

        $gananciaTotal = 0;
        $porcentajeGanancias = 0;

        // Verifica si el resultado de la consulta no es null antes de acceder a la propiedad.
        if ($gananciasQuery !== null && $gananciasQuery->ganancia_total !== null) {
            $gananciaTotal = $gananciasQuery->ganancia_total;
            $porcentajeGanancias = $totalVentas > 0 ? ($gananciaTotal / $totalVentas) * 100 : 0;
        }

        // Productos con poco stock
        $productosPocoStock = $this->db->table('producto')
            ->where('stock <= stock_min')
            ->countAllResults();

        // Ventas de Hoy
        $ventasHoy = $this->db->table('venta')
            ->selectSum('importe_total')
            ->where('fecha_emision', date('Y-m-d'))
            ->get()
            ->getRow()
            ->importe_total;

        // Preparar y retornar los resultados
        $datosDashboard = [
            'totalProductos'     => $totalProductos,
            'totalCompras'       => '$ ' . number_format($totalCompras, 2),
            'totalVentas'        => '$ ' . number_format($totalVentas, 2),
            'ganancias'          => '$ ' . number_format($gananciaTotal, 2) . ' - % ' . number_format($porcentajeGanancias, 2),
            'productosPocoStock' => $productosPocoStock,
            'ventasHoy'          => '$ ' . number_format($ventasHoy, 2),
        ];
        return $this->response->setJSON($datosDashboard);
    }

    public function grafico_barras()
    {
        $db = \Config\Database::connect();

        // Consulta para las ventas del mes actual
        $queryActual = $db->query("
            SELECT DATE(fecha_emision) AS fecha_venta, SUM(ROUND(importe_total, 2)) AS total_venta
            FROM venta
            WHERE DATE(fecha_emision) BETWEEN DATE(LAST_DAY(NOW() - INTERVAL 1 MONTH) + INTERVAL 1 DAY) AND LAST_DAY(NOW())
            GROUP BY DATE(fecha_emision);
        ");
        $ventasMesActual = $queryActual->getResultArray();

        // Consulta para las ventas del mes anterior
        $queryAnterior = $db->query("
            SELECT DATE(fecha_emision) AS fecha_venta, SUM(ROUND(importe_total, 2)) AS total_venta
            FROM venta
            WHERE DATE(fecha_emision) BETWEEN DATE(LAST_DAY(NOW() - INTERVAL 2 MONTH) + INTERVAL 1 DAY) AND LAST_DAY(NOW() - INTERVAL 1 MONTH)
            GROUP BY DATE(fecha_emision);
        ");
        $ventasMesAnterior = $queryAnterior->getResultArray();

        // Combinar ambos conjuntos de resultados
        $respuesta = [
            'actual' => $ventasMesActual,
            'anterior' => $ventasMesAnterior
        ];

        // Establecer la cabecera de respuesta como JSON y devolver los resultados
        return $this->response->setContentType('application/json')->setBody(json_encode($respuesta));
    }

    public function TopVentasCategorias()
    {
        // Iniciar el Query Builder para la tabla 'venta_detalle'
        $builder = $this->db->table('venta_detalle vd');

        // Configurar la selección, las uniones, la agrupación y el límite de la consulta
        $builder->select('CAST(SUM(vd.importe) AS DECIMAL(8,2)) AS y, c.nombre AS label', false)
            ->join('producto p', 'vd.id_producto = p.id_producto', 'inner')
            ->join('categoria c', 'c.id_categoria = p.idcategoria', 'inner')
            ->groupBy('c.nombre')
            ->limit(10);

        // Ejecutar la consulta y obtener los resultados
        $query = $builder->get();

        // Obtener los resultados como un array de objetos
        $result = $query->getResult();

        // Configurar la respuesta como JSON y enviarla
        return $this->response->setJSON($result);
    }

    public function graficoDoughnutTipoC()
    {
        // Iniciar el Query Builder para la tabla 'venta_detalle'
        $builder = $this->db->table('venta v'); // Iniciar el Query Builder para la tabla 'venta' con un alias 'v'

        $builder->select("CAST(SUM(v.importe_total) AS DECIMAL(8,2)) AS y, tc.descripcion AS label", false)
                ->join('serie s', 'v.id_serie = s.id', 'inner')
                ->join('tipo_comprobante tc', 'tc.id = s.id_tipo_comprobante', 'inner')
                ->groupBy('s.id_tipo_comprobante')
                ->limit(10);

        // Ejecutar la consulta y obtener los resultados
        $query = $builder->get();

        // Obtener los resultados como un array de objetos
        $result = $query->getResult();

        // Configurar la respuesta como JSON y enviarla
        return $this->response->setJSON($result);
    }


    
}
