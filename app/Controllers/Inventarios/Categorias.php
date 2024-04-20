<?php

namespace App\Controllers\Inventarios;

use App\Controllers\BaseController;
use App\Models\CategoriasModel;


class Categorias extends BaseController
{

    protected $categorias;

    public function __construct()
    {
        $this->categorias = new CategoriasModel();
    }

    public function Index()
    {
        $data = [
            'titulo' => 'Categorías',
        ];

        echo view('layout/header');
        echo view('layout/aside');
        echo view('categorias/list', $data);
        echo view('layout/footer');
    }


    public function ajaxListarCategorias()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('categoria cat');
        $builder->select(
            "cat.id_categoria,
         cat.nombre,
         cat.created_at,
         cat.updated_at,
         '' as opciones,
         CASE WHEN cat.estado = 1 THEN 'ACTIVO' ELSE 'INACTIVO' END as estado",
            false
        );

        // Búsqueda
        if (isset($_POST["search"]["value"])) {
            $searchValue = $_POST["search"]["value"];
            $builder->like('cat.nombre', $searchValue);
            $builder->orLike('cat.estado', $searchValue);
            $builder->orLike('cat.created_at', $searchValue);
            // Agrega más condiciones de búsqueda si es necesario
        }

        // Mapeo de índices de DataTables a nombres de columnas en la base de datos
        $columnMap = [
            0 => 'cat.id_categoria',
            1 => 'cat.nombre',
            2 => 'cat.estado',
            3 => 'cat.created_at',
            4 => 'cat.updated_at',
            5 => 'opciones'
        ];

        // Orden
        $order = $this->request->getPost('order');
        if (!empty($order)) {
            $orderColumnIndex = $order[0]['column'];
            $orderColumn = $columnMap[$orderColumnIndex] ?? null;
            $orderDir = $order[0]['dir'];
            if ($orderColumn) {
                $builder->orderBy($orderColumn, $orderDir);
            }else{
                
            }
        }

         // Paginación
         $length = $this->request->getPost("length");
         $start = $this->request->getPost("start");
         if ($length != -1) {
             $builder->limit($length, $start);
         }
 
         $query = $builder->get();
         $results = $query->getResultArray();
 
         // Obtener el número total de filas filtradas
         $builder->select('COUNT(*) as total');
         $queryTotalFiltered = $builder->get();
         $totalFiltered = $queryTotalFiltered->getRowArray()['total'];
 
         // Obtener el número total de filas (sin filtros)
         $builderTotal = $db->table('categoria');
         $builderTotal->select('COUNT(*) as total');
         $queryTotal = $builderTotal->get();
         $totalData = $queryTotal->getRowArray()['total'];
 

        // Datos para la respuesta
        $data = array();
        foreach ($results as $row) {
            $sub_array = array();
            $sub_array[] = $row['id_categoria'];
            $sub_array[] = $row['nombre'];
            $sub_array[] = $row['estado'];
            $sub_array[] = $row['created_at'];
            $sub_array[] = $row['updated_at'];
            
            $sub_array[] = $row['opciones'];
            $data[] = $sub_array;
        }

        $unidadMedida = array(
            'draw' => $_POST['draw'],
            "recordsTotal" => $totalData,
            "recordsFiltered" => $totalFiltered,
            "data" => $data
        );

        return json_encode($unidadMedida, JSON_UNESCAPED_UNICODE);
    }

    public function obtenerCategorias()
    {
        $data = $this->categorias->where('estado', 1)->findAll();
        if (count($data) > 0) {
            return json_encode($data); // Devuelve los datos y el framework se encarga de la codificación JSON
        } else {
            return json_encode([
                'error' => 'No se encontraron categorias activas.'
            ]); // Devuelve un código de estado HTTP 404
        }
    }

    public function obtenerCategoria($id)
    {
        $datosCategoria = $this->categorias->find($id);
        return $this->response->setJSON([
            'datoCate' => $datosCategoria,
        ]);
    }


    public function save()
    {
        try {
            $formCategoria = [];
            parse_str($_POST['datosCategoria'], $formCategoria);

            $this->categorias->save([
                'nombre' => $formCategoria['nombre'],
                'estado' => 1
            ]);
            $respuesta['tipo_msj'] = 'success';
            $respuesta['msj'] = 'Se registró la Categoría correctamente';
        } catch (\Exception $e) {
            $respuesta['tipo_msj'] = 'error';
            $respuesta['msj'] = 'Error al registrar la Categoría  ' . $e->getMessage();
        }
        echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
    }

   

    public function update()
    {
        try {
            $formCategoria = [];
            parse_str($_POST['datosCategoria'], $formCategoria);
            $id = $formCategoria['idCategoria'];

            // Asegúrate de que el idcliente esté incluido en los datos enviados por POST
            if (!isset($id) && filter_var($id, FILTER_VALIDATE_INT) !== false) {
                throw new \Exception("El ID de la Unidad de medidad es obligatorio.");
            }

            $this->categorias->update($id, [
                'nombre' => $formCategoria['nombre'],
            ]);

            $respuesta['tipo_msj'] = 'success';
            $respuesta['msj'] = "Categoria se actualizado correctamente";
        } catch (\Exception $e) {
            $respuesta['tipo_msj'] = 'error';
            $respuesta['msj'] = 'Error al actualizar la Categoria: '. $id;
        }

        echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
    }

    public function delete($id)
    {
        try {
            // Asegúrate de que el idcliente esté incluido en los datos enviados por POST
            if (!isset($id) && filter_var($id, FILTER_VALIDATE_INT) !== false) {
                throw new \Exception("El ID de la categoría es obligatorio.");
            }

            $this->categorias->update($id, [
                'estado' => 0
            ]);

            $respuesta['tipo_msj'] = 'success';
            $respuesta['msj'] = "Categoria Dado de Baja correctamente";
        } catch (\Exception $e) {
            $respuesta['tipo_msj'] = 'error';
            $respuesta['msj'] = 'Error al dar de baja Categoria : ' . $e->getMessage();
        }

        echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
    }

    public function active($id)
    {
        try {
            // Asegúrate de que el idcliente esté incluido en los datos enviados por POST
            if (!isset($id) && filter_var($id, FILTER_VALIDATE_INT) !== false) {
                throw new \Exception("El ID de la Categoría es obligatorio.");
            }

            $this->categorias->update($id, [
                'estado' => 1
            ]);

            $respuesta['tipo_msj'] = 'success';
            $respuesta['msj'] = "La categoría fue activada correctamente";
        } catch (\Exception $e) {
            $respuesta['tipo_msj'] = 'error';
            $respuesta['msj'] = 'Error al activar : ' . $e->getMessage();
        }

        echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
    }
}
