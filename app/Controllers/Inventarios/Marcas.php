<?php

namespace App\Controllers\Inventarios;

use App\Controllers\BaseController;
use App\Models\MarcasModel;


class Marcas extends BaseController
{

    protected $marcas;

    public function __construct()
    {
        $this->marcas = new MarcasModel();
    }

    public function Index()
    {
        $data = [
            'titulo' => 'Marcas',
        ];

        echo view('layout/header');
        echo view('layout/aside');
        echo view('marcas/list', $data);
        echo view('layout/footer');
    }


    public function ajaxListarMarcas()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('marca mar');
        $builder->select(
            "mar.id_marca,
         mar.nombre,
         mar.created_at,
         mar.updated_at,
         '' as opciones,
         CASE WHEN mar.estado = 1 THEN 'ACTIVO' ELSE 'INACTIVO' END as estado",
            false
        );

        // Resto de la función se mantiene igual, solo cambia la parte de búsqueda y mapeo de columnas

        // Búsqueda
        if (isset($_POST["search"]["value"])) {
            $searchValue = $_POST["search"]["value"];
            $builder->like('mar.nombre', $searchValue);
            $builder->orLike('mar.estado', $searchValue);
            $builder->orLike('mar.created_at', $searchValue);
            $builder->orLike('mar.updated_at', $searchValue);
            // Agrega más condiciones de búsqueda si es necesario
        }

        // Mapeo de índices de DataTables a nombres de columnas en la base de datos
        $columnMap = [
            0 => 'mar.id_marca',
            1 => 'mar.nombre',
            2 => 'mar.estado',
            3 => 'mar.created_at',
            4 => 'mar.updated_at',
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
         $builderTotal = $db->table('marca');
         $builderTotal->select('COUNT(*) as total');
         $queryTotal = $builderTotal->get();
         $totalData = $queryTotal->getRowArray()['total'];
 

        // Datos para la respuesta
        $data = array();
        foreach ($results as $row) {
            $sub_array = array();
            $sub_array[] = $row['id_marca'];
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

    public function obtenerMarcas()
    {
        $data = $this->marcas->where('estado', 1)->findAll();
        if (count($data) > 0) {
            return json_encode($data); // Devuelve los datos y el framework se encarga de la codificación JSON
        } else {
            return json_encode([
                'error' => 'No se encontraron marcas activas.'
            ]); // Devuelve un código de estado HTTP 404
        }
    }

    public function obtenerMarca($id)
    {
        $datosMarca = $this->marcas->find($id);
        return $this->response->setJSON([
            'datoMarca' => $datosMarca,
        ]);
    }


    public function save()
    {
        try {
            $formMarca = [];
            parse_str($_POST['datosMarca'], $formMarca);

            $this->marcas->save([
                'nombre' => $formMarca['nombre'],
                'estado' => 1
            ]);
            $respuesta['tipo_msj'] = 'success';
            $respuesta['msj'] = 'Se registró la Marca correctamente';
        } catch (\Exception $e) {
            $respuesta['tipo_msj'] = 'error';
            $respuesta['msj'] = 'Error al registrar la Marca  ' . $e->getMessage();
        }
        echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
    }

   

    public function update()
    {
        try {
            $formMarca = [];
            parse_str($_POST['datosMarca'], $formMarca);
            $id = $formMarca['idMarca'];

            // Asegúrate de que el idcliente esté incluido en los datos enviados por POST
            if (!isset($id) && filter_var($id, FILTER_VALIDATE_INT) !== false) {
                throw new \Exception("El ID de la Unidad de medidad es obligatorio.");
            }
            $this->marcas->update($id, [
                'nombre' => $formMarca['nombre'],
            ]);
            $respuesta['tipo_msj'] = 'success';
            $respuesta['msj'] = "La Marca se actualizado correctamente";
        } catch (\Exception $e) {
            $respuesta['tipo_msj'] = 'error';
            $respuesta['msj'] = 'Error al actualizar la Marca: '. $id;
        }

        echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
    }

    public function delete($id)
    {
        try {
            // Asegúrate de que el idcliente esté incluido en los datos enviados por POST
            if (!isset($id) && filter_var($id, FILTER_VALIDATE_INT) !== false) {
                throw new \Exception("El ID de la Marca es obligatorio.");
            }

            $this->marcas->update($id, [
                'estado' => 0
            ]);

            $respuesta['tipo_msj'] = 'success';
            $respuesta['msj'] = "Marca Dado de Baja correctamente";
        } catch (\Exception $e) {
            $respuesta['tipo_msj'] = 'error';
            $respuesta['msj'] = 'Error al dar de baja Marca : ' . $e->getMessage();
        }

        echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
    }

    public function active($id)
    {
        try {
            // Asegúrate de que el idcliente esté incluido en los datos enviados por POST
            if (!isset($id) && filter_var($id, FILTER_VALIDATE_INT) !== false) {
                throw new \Exception("El ID de la Marca es obligatorio.");
            }

            $this->marcas->update($id, [
                'estado' => 1
            ]);

            $respuesta['tipo_msj'] = 'success';
            $respuesta['msj'] = "La marca fue activada correctamente";
        } catch (\Exception $e) {
            $respuesta['tipo_msj'] = 'error';
            $respuesta['msj'] = 'Error al activar : ' . $e->getMessage();
        }

        echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
    }
}
