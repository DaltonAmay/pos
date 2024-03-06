<?php

namespace App\Controllers\Ventas;

use App\Controllers\BaseController;
use App\Models\TipoDocumentoModel;
// use App\Models\TipoD;


class TipoDocumento extends BaseController
{
    protected $tipoDocumento;

    public $db;

    public function __construct()
    {
        $this->tipoDocumento = new TipoDocumentoModel();
        $this->db =  \Config\Database::connect();
    }

    public function Index($estado = 1)
    {
        $tipoDocumento = $this->tipoDocumento->where('estado', $estado)->findAll();
        $data = [
            'titulo' => 'Tipos de Documentos',
            'datos' => $tipoDocumento
        ];

        echo view('layout/header');
        echo view('layout/aside');
        echo view('tipoDocumento/list', $data);
        echo view('layout/footer');
    }


    public function obtenerTipoDocumentos(){
        $data = $this->tipoDocumento->where('estado', 1)->findAll();
        if (count($data) > 0) {
            return json_encode($data); // Devuelve los datos y el framework se encarga de la codificación JSON
        } else {
            return json_encode([
                'error' => 'No se encontraron tipos de documentos activos.']); // Devuelve un código de estado HTTP 404
        }
    }

    public function eliminated($estado = 0)
    {
        $tipoDocumento = $this->tipoDocumento->where('estado', $estado)->findAll();
        $data = [
            'titulo' => 'Ventas de medida Eliminadas',
            'datos' => $tipoDocumento
        ];

        echo view('layout/header');

        echo view('layout/aside');
        echo view('clientes_medida/eliminated', $data);
        echo view('layout/footer');
    }


    //METODO PARA TRAER TODOS LOS TIPOS DE DOCUMENTOS DE LA BD
    public function ajaxListarTipoDocumento()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('tipo_documento td');
        $builder->select(
            "td.id,
                td.descripcion,
                td.created_at,
                td.updated_at,
                '' as opciones,
                CASE WHEN td.estado = 1 THEN 'ACTIVO' ELSE 'INACTIVO' END as estado",
            false
        );
        // $builder->where('td.estado', 1);
        // Búsqueda
        if (isset($_POST["search"]["value"])) {
            $searchValue = $_POST["search"]["value"];
            $builder->like('td.descripcion', $searchValue);
            // Agrega más condiciones de búsqueda si es necesario
        }

        // Mapeo de índices de DataTables a nombres de columnas en la base de datos
        $columnMap = [
            0 => 'td.id',
            1 => 'td.descripcion',
            2 => 'td.estado',
            3 => 'td.created_at',
            4 => 'td.updated_at',
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
        // $builder->where('td.estado', 1);
        $queryTotalFiltered = $builder->get();
        $totalFiltered = $queryTotalFiltered->getRowArray()['total'];

        // Obtener el número total de filas (sin filtros)
        $builderTotal = $db->table('tipo_documento');
        $builderTotal->select('COUNT(*) as total');
        $queryTotal = $builderTotal->get();
        $totalData = $queryTotal->getRowArray()['total'];

        // Datos para la respuesta
        $data = array();
        foreach ($results as $row) {
            $sub_array = array();
            $sub_array[] = $row['id'];
            $sub_array[] = $row['descripcion'];
            $sub_array[] = $row['estado'];
            $sub_array[] = $row['created_at'];
            $sub_array[] = $row['updated_at'];
            $sub_array[] = $row['opciones'];
            $data[] = $sub_array;
        }

        $tipoDocumento = array(
            'draw' => $_POST['draw'],
            "recordsTotal" => $totalData,
            "recordsFiltered" => $totalFiltered,
            "data" => $data
        );

        return json_encode($tipoDocumento, JSON_UNESCAPED_UNICODE);
    }


    public function save()
    {
        try {
            $formulario_tipo_doc = [];
            parse_str($_POST['datos_tipo_doc'], $formulario_tipo_doc);

            $this->tipoDocumento->save([
                'descripcion' => $formulario_tipo_doc['descripcion'],
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

    public function obtenerTipoDoc($id){
        $datoTipoDoc = $this->tipoDocumento->find($id);
        return $this->response->setJSON([
            'datosTipoDoc' => $datoTipoDoc,
        ]);
    }


    public function update()
    {
        try {
            $formTipoDoc = [];
            parse_str($_POST['datos_tipo_doc'], $formTipoDoc);
            $id = $formTipoDoc['idTipoEditar'];

            // Asegúrate de que el idcliente esté incluido en los datos enviados por POST
            if (!isset($id) && filter_var($id, FILTER_VALIDATE_INT) !== false) {
                throw new \Exception("El ID del Tipo de documento es obligatorio.");
            }

            $this->tipoDocumento->update($id, [
                'descripcion' => $formTipoDoc['descripcion'],
            ]);

            $respuesta['tipo_msj'] = 'success';
            $respuesta['msj'] = "Tipo de Documento actualizado correctamente";
        } catch (\Exception $e) {
            $respuesta['tipo_msj'] = 'error';
            $respuesta['msj'] = 'Error al actualizar el Tipo de Documento: ' . $e->getMessage();
        }

        echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
    }

    public function delete($id)
    {
        try {
            // Asegúrate de que el idcliente esté incluido en los datos enviados por POST
            if (!isset($id) && filter_var($id, FILTER_VALIDATE_INT) !== false) {
                throw new \Exception("El ID del Tipo de documento es obligatorio.");
            }

            $this->tipoDocumento->update($id, [
                'estado' => 0
            ]);

            $respuesta['tipo_msj'] = 'success';
            $respuesta['msj'] = "Tipo de Documento Dado de Baja correctamente";
        } catch (\Exception $e) {
            $respuesta['tipo_msj'] = 'error';
            $respuesta['msj'] = 'Error al dar de baja el Tipo de Documento: ' . $e->getMessage();
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

            $this->tipoDocumento->update($id, [
                'estado' => 1
            ]);

            $respuesta['tipo_msj'] = 'success';
            $respuesta['msj'] = "Tipo de Documento fue activado correctamente";
        } catch (\Exception $e) {
            $respuesta['tipo_msj'] = 'error';
            $respuesta['msj'] = 'Error al activar el de Tipo de Documento: ' . $e->getMessage();
        }

        echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
    }
}
