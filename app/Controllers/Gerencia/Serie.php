<?php

namespace App\Controllers\Gerencia;

use App\Controllers\BaseController;
use App\Models\serieModel;
use App\Models\SeriesModel;

// use App\Models\TipoD;


class Serie extends BaseController
{
    protected $serie;

    public $db;

    public function __construct()
    {
        $this->serie = new SeriesModel();
        $this->db =  \Config\Database::connect();
    }

    public function Index()
    {
        $data = [
            'titulo' => 'Series',
        ];

        echo view('layout/header');
        echo view('layout/aside');
        echo view('series/list', $data);
        echo view('layout/footer');
    }


    public function obtenerseries(){
        $data = $this->serie->where('estado', 1)->findAll();
        if (count($data) > 0) {
            return json_encode($data); // Devuelve los datos y el framework se encarga de la codificación JSON
        } else {
            return json_encode([
                'error' => 'No se encontraron tipos de Comprobantes activos.']); // Devuelve un código de estado HTTP 404
        }
    }

    //METODO PARA TRAER TODOS LOS TIPOS DE ComprobanteS DE LA BD
    public function ajaxListarSeries()
    {
        $builder = $this->db->table('serie sr');
        $builder->select(
            "sr.id,
                sr.serie,
                sr.numero_inicial,
                sr.numero_actual,
                '' as opciones,
                tc.descripcion as tipoComprobante,
                CASE WHEN sr.estado = 1 THEN 'ACTIVO' ELSE 'INACTIVO' END as estado", 
            false
        );
        $builder->join('tipo_comprobante tc', 'sr.id_tipo_comprobante = tc.id');
        // Búsqueda
        if (isset($_POST["search"]["value"])) {
            $searchValue = $_POST["search"]["value"];
            $builder->like('sr.serie', $searchValue); 
            $builder->orLike('sr.numero_inicial', $searchValue);
            $builder->orLike('sr.numero_actual', $searchValue);
            $builder->orLike('tc.descripcion', $searchValue);
        }

        // Mapeo de índices de DataTables a nombres de columnas en la base de datos
        $columnMap = [
            0 => 'sr.id',
            1 => 'sr.serie',
            2 => 'tc.descripcion',
            3 => 'sr.numero_inicial',
            4 => 'sr.numero_actual',
            5 => 'estado',
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
        // $builder->where('tc.estado', 1);
        $queryTotalFiltered = $builder->get();
        $totalFiltered = $queryTotalFiltered->getRowArray()['total'];

        // Obtener el número total de filas (sin filtros)
        $builderTotal = $this->db->table('serie');
        $builderTotal->select('COUNT(*) as total');
        $queryTotal = $builderTotal->get();
        $totalData = $queryTotal->getRowArray()['total'];

        // Datos para la respuesta
        $data = array();
        foreach ($results as $row) {
            $sub_array = array();
            $sub_array[] = $row['id'];
            $sub_array[] = $row['serie'];
            $sub_array[] = $row['tipoComprobante'];
            $sub_array[] = $row['numero_inicial'];
            $sub_array[] = $row['numero_actual'];
            $sub_array[] = $row['estado'];
            $sub_array[] = $row['opciones'];
            $data[] = $sub_array;
        }

        $serie = array(
            'draw' => $_POST['draw'],
            "recordsTotal" => $totalData,
            "recordsFiltered" => $totalFiltered,
            "data" => $data
        );

        return json_encode($serie, JSON_UNESCAPED_UNICODE);
    }


    public function save()
    {
        try {
            $formComprobantes = [];
            parse_str($_POST['datosSerie'], $formComprobantes);

            $this->serie->save([
                'id_tipo_comprobante' => $formComprobantes['tipoComprobante'],
                'serie' => $formComprobantes['serie'],
                'numero_inicial' => $formComprobantes['numInicial'],
                'numero_actual' => $formComprobantes['numInicial'],
                'estado' => 1
            ]);
            $respuesta['tipo_msj'] = 'success';
            $respuesta['msj'] = 'Se registró el Serie correctamente';
        } catch (\Exception $e) {
            $respuesta['tipo_msj'] = 'error';
            $respuesta['msj'] = 'Error al registrar el Serie  ' . $e->getMessage();
        }
        echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
    }

    public function obtenerSerie($id){
        $datoComprobante = $this->serie->find($id);
        return $this->response->setJSON([
            'datoComprobante' => $datoComprobante,
        ]);
    }


    public function update()
    {
        try {
            $formSerie = [];
            parse_str($_POST['datoSerie'], $formSerie);
            $id = $formSerie['idSerie'];

            // Asegúrate de que el idcliente esté incluido en los datos enviados por POST
            if (!isset($id) && filter_var($id, FILTER_VALIDATE_INT) !== false) {
                throw new \Exception("El ID del Serie es obligatorio.");
            }

            $this->serie->update($id, [
                'id_tipo_comprobante' => $formSerie['tipoComprobante'],
                'serie' => $formSerie['serie'],
                'numero_inicial' => $formSerie['numInicial'],
            ]);

            $respuesta['tipo_msj'] = 'success';
            $respuesta['msj'] = "Serie actualizado correctamente";
        } catch (\Exception $e) {
            $respuesta['tipo_msj'] = 'error';
            $respuesta['msj'] = 'Error al actualizar el Serie: ' . $e->getMessage();
        }

        echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
    }

    public function delete($id)
    {
        try {
            // Asegúrate de que el idcliente esté incluido en los datos enviados por POST
            if (!isset($id) && filter_var($id, FILTER_VALIDATE_INT) !== false) {
                throw new \Exception("El ID del Serie es obligatorio.");
            }

            $this->serie->update($id, [
                'estado' => 0
            ]);

            $respuesta['tipo_msj'] = 'success';
            $respuesta['msj'] = "Serie Dada de Baja correctamente";
        } catch (\Exception $e) {
            $respuesta['tipo_msj'] = 'error';
            $respuesta['msj'] = 'Error al dar de baja la Serie: ' . $e->getMessage();
        }

        echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
    }

    public function active($id)
    {
        try {
            // Asegúrate de que el idcliente esté incluido en los datos enviados por POST
            if (!isset($id) && filter_var($id, FILTER_VALIDATE_INT) !== false) {
                throw new \Exception("El ID del Serie es obligatorio.");
            }

            $this->serie->update($id, [
                'estado' => 1
            ]);

            $respuesta['tipo_msj'] = 'success';
            $respuesta['msj'] = "Serie fue activado correctamente";
        } catch (\Exception $e) {
            $respuesta['tipo_msj'] = 'error';
            $respuesta['msj'] = 'Error al activar el de Serie: ' . $e->getMessage();
        }

        echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
    }
}
