<?php

namespace App\Controllers\Gerencia;

use App\Controllers\BaseController;
use App\Models\TipoComprobanteModel;
// use App\Models\TipoD;


class TipoComprobante extends BaseController
{
    protected $tipoComprobante;

    public $db;

    public function __construct()
    {
        $this->tipoComprobante = new TipoComprobanteModel();
        $this->db =  \Config\Database::connect();
    }

    public function Index()
    {
        $data = [
            'titulo' => 'Tipo de Comprobante',
        ];

        echo view('layout/header');
        echo view('layout/aside');
        echo view('comprobante/list', $data);
        echo view('layout/footer');
    }


    public function getComprobantes(){
        $data = $this->tipoComprobante->where('estado', 1)->findAll(); 
        if (count($data) > 0) {
            return json_encode($data); // Devuelve los datos y el framework se encarga de la codificación JSON
        } else {
            return json_encode([
                'error' => 'No se encontraron tipos de Comprobantes activos.']); // Devuelve un código de estado HTTP 404
        }
    }

    //METODO PARA TRAER TODOS LOS TIPOS DE ComprobanteS DE LA BD
    public function ajaxListarTipoComprobantes()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('tipo_comprobante tc');
        $builder->select(
            "tc.id,
                tc.codigo,
                tc.descripcion,
                '' as opciones,
                CASE WHEN tc.estado = 1 THEN 'ACTIVO' ELSE 'INACTIVO' END as estado",
            false
        );
        // $builder->where('tc.estado', 1);
        // Búsqueda
        if (isset($_POST["search"]["value"])) {
            $searchValue = $_POST["search"]["value"];
            $builder->like('tc.descripcion', $searchValue); 
            $builder->orLike('tc.codigo', $searchValue);
        }

        // Mapeo de índices de DataTables a nombres de columnas en la base de datos
        $columnMap = [
            0 => 'tc.id',
            1 => 'tc.codigo',
            2 => 'tc.descripcion',
            3 => 'tc.estado',
            4 => 'opciones'
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
        // $builder->where('tc.estado', 1);
        $queryTotalFiltered = $builder->get();
        $totalFiltered = $queryTotalFiltered->getRowArray()['total'];

        // Obtener el número total de filas (sin filtros)
        $builderTotal = $db->table('tipo_comprobante');
        $builderTotal->select('COUNT(*) as total');
        $queryTotal = $builderTotal->get();
        $totalData = $queryTotal->getRowArray()['total'];

        // Datos para la respuesta
        $data = array();
        foreach ($results as $row) {
            $sub_array = array();
            $sub_array[] = $row['id'];
            $sub_array[] = $row['codigo'];
            $sub_array[] = $row['descripcion'];
            $sub_array[] = $row['estado'];
            $sub_array[] = $row['opciones'];
            $data[] = $sub_array;
        }

        $tipoComprobante = array(
            'draw' => $_POST['draw'],
            "recordsTotal" => $totalData,
            "recordsFiltered" => $totalFiltered,
            "data" => $data
        );

        return json_encode($tipoComprobante, JSON_UNESCAPED_UNICODE);
    }


    public function save()
    {
        try {
            $formComprobantes = [];
            parse_str($_POST['datosTiposComprobantes'], $formComprobantes);

            $this->tipoComprobante->save([
                'codigo' => $formComprobantes['codigo'],
                'descripcion' => $formComprobantes['descripcion'],
                'estado' => 1
            ]);
            $respuesta['tipo_msj'] = 'success';
            $respuesta['msj'] = 'Se registró el Tipo de Comprobante correctamente';
        } catch (\Exception $e) {
            $respuesta['tipo_msj'] = 'error';
            $respuesta['msj'] = 'Error al registrar el Tipo de Comprobante  ' . $e->getMessage();
        }
        echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
    }

    public function obtenerComprobante($id){
        $datoComprobante = $this->tipoComprobante->find($id);
        return $this->response->setJSON([
            'datoComprobante' => $datoComprobante,
        ]);
    }


    public function update()
    {
        try {
            $formTipoDoc = [];
            parse_str($_POST['datosComprobante'], $formTipoDoc);
            $id = $formTipoDoc['idComprobante'];

            // Asegúrate de que el idcliente esté incluido en los datos enviados por POST
            if (!isset($id) && filter_var($id, FILTER_VALIDATE_INT) !== false) {
                throw new \Exception("El ID del Tipo de Comprobante es obligatorio.");
            }

            $this->tipoComprobante->update($id, [
                'descripcion' => $formTipoDoc['descripcion'],
                'codigo' => $formTipoDoc['codigo'],
            ]);

            $respuesta['tipo_msj'] = 'success';
            $respuesta['msj'] = "Tipo de Comprobante actualizado correctamente";
        } catch (\Exception $e) {
            $respuesta['tipo_msj'] = 'error';
            $respuesta['msj'] = 'Error al actualizar el Tipo de Comprobante: ' . $e->getMessage();
        }

        echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
    }

    public function delete($id)
    {
        try {
            // Asegúrate de que el idcliente esté incluido en los datos enviados por POST
            if (!isset($id) && filter_var($id, FILTER_VALIDATE_INT) !== false) {
                throw new \Exception("El ID del Tipo de Comprobante es obligatorio.");
            }

            $this->tipoComprobante->update($id, [
                'estado' => 0
            ]);

            $respuesta['tipo_msj'] = 'success';
            $respuesta['msj'] = "Tipo de Comprobante Dado de Baja correctamente";
        } catch (\Exception $e) {
            $respuesta['tipo_msj'] = 'error';
            $respuesta['msj'] = 'Error al dar de baja el Tipo de Comprobante: ' . $e->getMessage();
        }

        echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
    }

    public function active($id)
    {
        try {
            // Asegúrate de que el idcliente esté incluido en los datos enviados por POST
            if (!isset($id) && filter_var($id, FILTER_VALIDATE_INT) !== false) {
                throw new \Exception("El ID del Tipo de Comprobante es obligatorio.");
            }

            $this->tipoComprobante->update($id, [
                'estado' => 1
            ]);

            $respuesta['tipo_msj'] = 'success';
            $respuesta['msj'] = "Tipo de Comprobante fue activado correctamente";
        } catch (\Exception $e) {
            $respuesta['tipo_msj'] = 'error';
            $respuesta['msj'] = 'Error al activar el de Tipo de Comprobante: ' . $e->getMessage();
        }

        echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
    }
}
