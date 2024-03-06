<?php

namespace App\Controllers\Inventarios;

use App\Controllers\BaseController;
use App\Models\UnidadesModel;


class Unidades extends BaseController
{

    protected $unidades;

    public function __construct()
    {
        $this->unidades = new UnidadesModel();
    }

    public function Index()
    {
        $data = [
            'titulo' => 'Unidades de medida',
        ];

        echo view('layout/header');
        echo view('layout/aside');
        echo view('unidades_medida/list', $data);
        echo view('layout/footer');
    }


    public function ajaxListarUnidadMedida()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('unidad_medida um');
        $builder->select(
            "um.id_uni_medida,
         um.nombre,
         um.abreviatura,
         um.created_at,
         um.updated_at,
         '' as opciones,
         CASE WHEN um.estado = 1 THEN 'ACTIVO' ELSE 'INACTIVO' END as estado",
            false
        );

        // Resto de la función se mantiene igual, solo cambia la parte de búsqueda y mapeo de columnas

        // Búsqueda
        if (isset($_POST["search"]["value"])) {
            $searchValue = $_POST["search"]["value"];
            $builder->like('um.nombre', $searchValue);
            $builder->orLike('um.abreviatura', $searchValue);
            // Agrega más condiciones de búsqueda si es necesario
        }

        // Mapeo de índices de DataTables a nombres de columnas en la base de datos
        $columnMap = [
            0 => 'um.id_uni_medida',
            1 => 'um.nombre',
            2 => 'um.abreviatura',
            3 => 'um.estado',
            4 => 'um.created_at',
            5 => 'um.updated_at',
            6 => 'opciones'
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
         $builderTotal = $db->table('unidad_medida');
         $builderTotal->select('COUNT(*) as total');
         $queryTotal = $builderTotal->get();
         $totalData = $queryTotal->getRowArray()['total'];
 

        // Datos para la respuesta
        $data = array();
        foreach ($results as $row) {
            $sub_array = array();
            $sub_array[] = $row['id_uni_medida'];
            $sub_array[] = $row['nombre'];
            $sub_array[] = $row['abreviatura'];
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

    public function obtenerTipoDocumentos()
    {
        $data = $this->tipoDocumento->where('estado', 1)->findAll();
        if (count($data) > 0) {
            return json_encode($data); // Devuelve los datos y el framework se encarga de la codificación JSON
        } else {
            return json_encode([
                'error' => 'No se encontraron tipos de documentos activos.'
            ]); // Devuelve un código de estado HTTP 404
        }
    }

    public function save()
    {
        try {
            $formUnidadM = [];
            parse_str($_POST['datos_unidades'], $formUnidadM);

            $this->unidades->save([
                'nombre' => $formUnidadM['nombre'],
                'abreviatura' => $formUnidadM['abreviatura'],
                'estado' => 1
            ]);
            $respuesta['tipo_msj'] = 'success';
            $respuesta['msj'] = 'Se registró el Tipo de Documento correctamente';
        } catch (\Exception $e) {
            $respuesta['tipo_msj'] = 'error';
            $respuesta['msj'] = 'Error al registrar el Tipo de Documento  ' . $e->getMessage();
        }
        echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
    }

    public function obtenerUnidad($id)
    {
        $datosUnidad = $this->unidades->find($id);
        return $this->response->setJSON([
            'datoUnid' => $datosUnidad,
        ]);
    }


    public function update()
    {
        try {
            $formUnidadM = [];
            parse_str($_POST['datosUnidadM'], $formUnidadM);
            $id = $formUnidadM['idUnidadM'];

            // Asegúrate de que el idcliente esté incluido en los datos enviados por POST
            if (!isset($id) && filter_var($id, FILTER_VALIDATE_INT) !== false) {
                throw new \Exception("El ID de la Unidad de medidad es obligatorio.");
            }

            $this->unidades->update($id, [
                'nombre' => $formUnidadM['nombre'],
                'abreviatura' => $formUnidadM['abreviatura'],
            ]);

            $respuesta['tipo_msj'] = 'success';
            $respuesta['msj'] = "Unidad de medida se actualizado correctamente";
        } catch (\Exception $e) {
            $respuesta['tipo_msj'] = 'error';
            $respuesta['msj'] = 'Error al actualizar la Unidad de medida: '. $id;
        }

        echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
    }

    public function delete($id)
    {
        try {
            // Asegúrate de que el idcliente esté incluido en los datos enviados por POST
            if (!isset($id) && filter_var($id, FILTER_VALIDATE_INT) !== false) {
                throw new \Exception("El ID de la unidad de medida es obligatorio.");
            }

            $this->unidades->update($id, [
                'estado' => 0
            ]);

            $respuesta['tipo_msj'] = 'success';
            $respuesta['msj'] = "Unidad de medida Dado de Baja correctamente";
        } catch (\Exception $e) {
            $respuesta['tipo_msj'] = 'error';
            $respuesta['msj'] = 'Error al dar de baja Unidad de medida : ' . $e->getMessage();
        }

        echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
    }

    public function active($id)
    {
        try {
            // Asegúrate de que el idcliente esté incluido en los datos enviados por POST
            if (!isset($id) && filter_var($id, FILTER_VALIDATE_INT) !== false) {
                throw new \Exception("El ID del Tipo de documento es obligatorio.");
            }

            $this->unidades->update($id, [
                'estado' => 1
            ]);

            $respuesta['tipo_msj'] = 'success';
            $respuesta['msj'] = "La unidad de medida fue activado correctamente";
        } catch (\Exception $e) {
            $respuesta['tipo_msj'] = 'error';
            $respuesta['msj'] = 'Error al activar : ' . $e->getMessage();
        }

        echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
    }
}
