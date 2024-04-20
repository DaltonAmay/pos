<?php

namespace App\Controllers\Inventarios;

use App\Controllers\BaseController;
use App\Models\CategoriasModel;
use App\Models\MarcasModel;
use App\Models\UnidadesModel;
use App\Models\ProductosModel;


class Productos extends BaseController
{

    protected $productos, $categorias, $marcas, $unidad;

    public $db;

    private $sqlQueries = [];


    public function __construct()
    {
        $this->db =  \Config\Database::connect();
        $this->productos = new productosModel();
        $this->categorias = new CategoriasModel();
        $this->marcas = new MarcasModel();
        $this->unidad = new UnidadesModel();
        helper('text');
    }

    public function Index()
    {
        $data = [
            'categorias' => $this->categorias->where('estado', 1)->findAll(),
            'marcas' => $this->marcas->where('estado', 1)->findAll(),
            'unidades' => $this->unidad->where('estado', 1)->findAll(),
            'titulo' => 'Administar nuevos productos',
            'datos' =>  $this->productos->where('estado', 1)->findAll()
        ];

        echo view('layout/header');

        echo view('layout/aside');
        echo view('productos/list', $data);
        echo view('layout/footer');
    }



    public function ajaxListarProductos()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('producto p');
        $builder->select(
            "p.id_producto,
            p.cod_interno, 
            p.cod_barras,
            p.nombre_producto,
            p.precio_compra,
            p.precio_venta,
            p.precio_venta_mayoreo,
            p.utilidad,
            p.stock,
            p.stock_min,
            p.exento,
            p.inventariable,
            p.perecedero,
        '' as opciones,
        c.nombre as nombre_categoria",
            false,
            "CASE WHEN td.estado = 1 THEN 'ACTIVO' ELSE 'INACTIVO' END as estado",
            false
        );

        $builder->join('categoria c', 'p.idcategoria = c.id_categoria');
        $builder->where('p.estado', 1);
        // Mapeo de índices de DataTables a nombres de columnas en la base de datos
        $columnMap = [
            0 => 'opciones',
            1 => 'id_producto',
            2 => 'p.cod_interno',
            3 => 'p.cod_barras',
            4 => 'p.nombre_producto',
            5 => 'c.nombre',
            6 => 'p.precio_compra',
            7 => 'p.precio_venta',
            8 => 'p.precio_venta_mayoreo',
            9 => 'p.utilidad',
            10 => 'p.stock',
            11 => 'p.stock_min',
            12 => 'p.exento',
            13 => 'p.inventariable',
            14 => 'p.perecedero',
            15 => 'estado'
        ];
        // Búsqueda
        if (isset($_POST["search"]["value"])) {
            $searchValue = $_POST["search"]["value"];
            $builder->like('c.nombre', $searchValue);
            $builder->orLike('p.cod_interno', $searchValue);
            $builder->orLike('p.nombre_producto', $searchValue);
            $builder->orLike('p.cod_barras', $searchValue);
            $builder->orLike('c.nombre', $searchValue);
            $builder->orLike('p.precio_compra', $searchValue);
            $builder->orLike('p.precio_venta', $searchValue);
            $builder->orLike('p.precio_venta_mayoreo', $searchValue);
            $builder->orLike('p.utilidad', $searchValue);
        }

        // Orden
        if (isset($_POST["order"])) {
            $orderColumnIndex = $_POST['order']['0']['column'];
            $orderColumn = $columnMap[$orderColumnIndex] ?? null;
            $orderDir = $_POST['order']['0']['dir'];
            if ($orderColumn) {
                $builder->orderBy($orderColumn, $orderDir);
            }
        }

        // Paginación
        if ($_POST["length"] != -1) {
            $builder->limit($_POST["length"], $_POST["start"]);
        }

    
        $query = $builder->get();
        $results = $query->getResultArray();

        // Obtener el número total de filas filtradas
        // $builder->select('COUNT(*) as total');
        // $builder->where('estado', 1);
        // $queryTotalFiltered = $builder->get();
        // $totalFiltered = $queryTotalFiltered->getRowArray()['total'];

        $builder = $db->table('producto p');
        $builder->select('COUNT(*) as total');
        $builder->where('p.estado', 1);
        $builder->join('categoria c', 'p.idcategoria = c.id_categoria');

        $query = $builder->get();
        $totalFiltered = $query->getRow()->total;


        // Obtener el número total de filas (sin filtros)
        $builderTotal = $db->table('producto');
        $builderTotal->select('COUNT(*) as total');
        $builder->join('categoria c', 'p.idcategoria = c.id_categoria');
        $queryTotal = $builderTotal->get();
        $totalData = $queryTotal->getRowArray()['total'];

        // Preparar datos para DataTables
        $data = array();
        foreach ($results as $row) {
            $sub_array = array();
            $sub_array[] = $row['opciones'];
            $sub_array[] = $row['id_producto'];
            $sub_array[] = $row['cod_interno'];
            $sub_array[] = $row['cod_barras'];
            $sub_array[] = $row['nombre_producto'];
            $sub_array[] = $row['nombre_categoria'];
            $sub_array[] = $row['precio_compra'];
            $sub_array[] = $row['precio_venta'];
            $sub_array[] = $row['precio_venta_mayoreo'];
            $sub_array[] = $row['utilidad'];
            $sub_array[] = $row['stock'];
            $sub_array[] = $row['stock_min'];
            $sub_array[] = $row['exento'];
            $sub_array[] = $row['inventariable'];
            $sub_array[] = $row['perecedero'];
            $data[] = $sub_array;
        }

        $productos = array(
            'draw' => $_POST['draw'],
            "recordsTotal" => $totalData,
            "recordsFiltered" => $totalFiltered,
            "data" => $data
        );

        return $this->response->setJSON($productos, JSON_UNESCAPED_UNICODE);
    }

    public function new()
    {
        $data = [
            'titulo' => 'Registrar nueva Categoria',

        ];
        echo view('layout/header');

        echo view('layout/aside');
        echo view('productos/new', $data);
        echo view('layout/footer');
    }

    public function save()
    {

        helper(['form', 'url']);

        $rules = [
            'codBarras' => 'required',
            'nombreProducto' => 'required',
            // Otras reglas de validación según sea necesario
        ];

        if (!$this->validate($rules)) {
            // La validación falló
            return $this->response->setJSON([
                'error' => true,
                'messages' => $this->validator->getErrors(),
            ]);
        } else {
            // Validación de datos 
            $exento = $this->request->getPost('exento') ? 1 : 0;
            $inventariable = $this->request->getPost('inventariable') ? 1 : 0;
            $perecedero = $this->request->getPost('perecedero') ? 1 : 0;
            try {
                $this->productos->save([
                    'cod_interno' => $this->generarCodigoInterno($this->request->getPost('nombreProducto')),
                    'cod_barras' => $this->request->getPost('codBarras'),
                    'nombre_producto' => strtoupper($this->request->getPost('nombreProducto')),
                    'precio_compra' => $this->request->getPost('preCompra'),
                    'precio_venta' => $this->request->getPost('preVenta'),
                    'precio_venta_mayoreo' => $this->request->getPost('preVentaMayoreo'),
                    'utilidad' => $this->request->getPost('utilidad'),
                    'stock_min' => $this->request->getPost('stock_min'),
                    'stock' => $this->request->getPost('stock'),
                    'idcategoria' => $this->request->getPost('idcategoria'),
                    'idmarca' => $this->request->getPost('idmarca'),
                    'idunidad' => $this->request->getPost('idunidad'),
                    'exento' => $exento,
                    'inventariable' => $inventariable,
                    'perecedero' => $perecedero,
                    // Agrega aquí los demás campos según sea necesario
                ]);

                // Redirigir o enviar una respuesta de éxito
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Producto guardado con éxito'
                ]);
            } catch (\Throwable $th) {
                // Manejo de errores
                return $this->response->setJSON([
                    'error' => true,
                    'message' => "ERROR: " . $th->getMessage(),
                ]);
            }
        }
    }


    function generarCodigoInterno($nombreProducto)
    {
        // Obtener las primeras 4 letras del nombre en mayúsculas
        $prefix = strtoupper(substr($nombreProducto, 0, 3));

        // Realizar una consulta para obtener el último ID del producto
        $ultimoId = $this->obtenerUltimoIdProducto();

        // Generar el código interno
        $codigoInterno = $prefix . str_pad($ultimoId + 1, 14 - strlen($prefix), '0', STR_PAD_LEFT);

        return $codigoInterno;
    }


    function obtenerUltimoIdProducto()
    {
        $query = $this->productos->select('id_producto')
            ->orderBy('id_producto', 'desc')
            ->limit(1)
            ->get();
        $result = $query->getRow();
        if ($result) {
            return $result->id_producto;
        }
    }
    /*==========================================*/
    // FUNCION PARA OBTENER TODOS LOS PRODUCTOS CON EL ID 
    /*==========================================*/
    public function obtenerDatosProducto($id_producto)
    {
        $datosProducto = $this->productos->find($id_producto);


        if (!$datosProducto) {
            return $this->response->setJSON(['error' => 'Producto no encontrado']);
        }

        // Obtener todas las categorías, marcas y unidades
        $categorias = $this->categorias->findAll();
        $marcas = $this->marcas->findAll();
        $unidades = $this->unidad->findAll();

        if (!$categorias || !$marcas || !$unidades) {
            return $this->response->setJSON(['error' => 'No se pudieron obtener las categorías, marcas o unidades']);
        }

        // Enviar datos al modal
        return $this->response->setJSON([
            'datosProducto' => $datosProducto,
            'categorias' => $categorias,
            'marcas' => $marcas,
            'unidades' => $unidades,
        ]);
    }
    public function edit($id)
    {

        $categoria = $this->productos->where('id_categoria', $id)->first();

        $data = [
            'titulo' => 'Editar productos',
            'datos' => $categoria
        ];

        echo view('layout/header');

        echo view('layout/aside');
        echo view('productos/edit', $data);
        echo view('layout/footer');
    }

    public function update()
    {
        try {
            $fromaularioProducto = [];
            parse_str($_POST['datos_productos'], $fromaularioProducto);
            $idproducto = $fromaularioProducto['id_producto'];

            // Asegúrate de que el idcliente esté incluido en los datos enviados por POST
            if (!isset($idproducto) && filter_var($idproducto, FILTER_VALIDATE_INT) !== false) {
                throw new \Exception("El ID del producto es obligatorio.");
            }

            // Actualiza el registro del cliente existente utilizando el ID del cliente
            $exento = isset($fromaularioProducto['exentoImpE']) ? 1 : 0;
            $inventariable = isset($fromaularioProducto['inventariableE']) ? 1 : 0;
            $perecedero = isset($fromaularioProducto['perecederoE']) ? 1 : 0;

            $this->db->table('productos')
                ->where('id_producto', $idproducto)
                ->update([
                    'cod_barras' => $fromaularioProducto['codBarrasE'],
                    'nombre_producto' => $fromaularioProducto['nombreProductoE'],
                    'precio_compra' => $fromaularioProducto['preCompraE'],
                    'precio_venta' => $fromaularioProducto['preVentaE'],
                    'precio_venta_mayoreo' => $fromaularioProducto['preVentaMayoreoE'],
                    'utilidad' => $fromaularioProducto['utilidadE'],
                    'stock' => $fromaularioProducto['stockE'],
                    'stock_min' =>  $fromaularioProducto['stock_minE'],
                    'exento' => $exento,
                    'inventariable' => $inventariable,
                    'perecedero' => $perecedero,
                    'idcategoria' => $fromaularioProducto['idcategoriaE'],
                    'idmarca' => $fromaularioProducto['idmarcaE'],
                    'idunidad' => $fromaularioProducto['idunidadE'],
                ]);

            $respuesta['tipo_msj'] = 'success';
            $respuesta['msj'] = "Producto actualizado correctamente";
        } catch (\Exception $e) {
            $respuesta['tipo_msj'] = 'error';
            $respuesta['msj'] = 'Error al actualizar el Producto: ' . $e->getMessage();
        }

        echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
    }

    public function delete($id)
    {
        try {
            $this->productos->update($id, [
                'estado' => 0
            ]);

            return $this->response->setJSON([
                'respuesta' => "OK",
            ]);
        } catch (\Throwable $th) {
            return $this->response->setJSON([
                'respuesta' => "ERROR",
            ]);
        }
    }

    public function eliminated($estado = 0)
    {
        $productos = $this->productos->where('estado', $estado)->findAll();
        $data = [
            'titulo' => 'productos Eliminadas',
            'datos' => $productos
        ];

        echo view('layout/header');

        echo view('layout/aside');
        echo view('productos/eliminated', $data);
        echo view('layout/footer');
    }

    public function active($id)
    {
        $this->productos->update($id, [
            'estado' => 1
        ]);
        return redirect()->to(base_url() . 'administrar/productos');
    }
}
