<?php

namespace App\Controllers\Ventas;

use App\Controllers\BaseController;
use App\Models\ClientesModel;
use App\Models\TipoDocumentoModel;


class Clientes extends BaseController
{

    protected $clientes, $tipDocumento;

    public $db;

    public function __construct()
    {
        $this->clientes = new ClientesModel();
        $this->tipDocumento = new TipoDocumentoModel();
        $this->db =  \Config\Database::connect();
    }

    public function Index($estado = 1)
    {
        $data = [
            'titulo' => 'Administar Clientes'
        ];

        echo view('layout/header');
        echo view('layout/aside');
        echo view('clientes/list', $data);
        echo view('layout/footer');
    }



    public function save()
    {
        try {
            $formulario_cliente = [];
            parse_str($_POST['datos_cliente'], $formulario_cliente);

            $this->clientes->save([

                'id_tipo_documento' => $formulario_cliente['tipo_documento'],
                'nro_documento' => $formulario_cliente['nro_documento'],
                'apellidos' => $formulario_cliente['apellido_cliente'],
                'nombres' => $formulario_cliente['nombre_cliente'],
                'direccion' => $formulario_cliente['direccion'],
                'correo' => $formulario_cliente['correo'],
                'telefono' => $formulario_cliente['telefono'],
                'celular' => $formulario_cliente['celular'],
                'estado' => 1

            ]);
            $respuesta['tipo_msj'] = 'success';
            $respuesta['msj'] = 'Se registró el cliente correctamente';
        } catch (\Exception $e) {
            $respuesta['tipo_msj'] = 'error';
            $respuesta['msj'] = 'Error al registrar el cliente ' . $e->getMessage();
        }
        echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
    }


    public function edit($id)
    {
        $venta = $this->clientes->where('id_venta', $id)->first();

        $data = [
            'titulo' => 'Editar Ventas',
            'datos' => $venta
        ];

        echo view('layout/header');

        echo view('layout/aside');
        echo view('clientes_medida/edit', $data);
        echo view('layout/footer');
    }

    public function update()
    {
        try {
            $formulario_cliente = [];
            parse_str($_POST['datos_cliente'], $formulario_cliente);
            $idCliente = $formulario_cliente['id_cliente'];

            // Asegúrate de que el idcliente esté incluido en los datos enviados por POST
            if (!isset($idCliente) && filter_var($idCliente, FILTER_VALIDATE_INT) !== false) {
                throw new \Exception("El ID del cliente es obligatorio.");
            }

            // Actualiza el registro del cliente existente utilizando el ID del cliente
            $this->clientes->update($idCliente, [

                'id_tipo_documento' => $formulario_cliente['tipo_documento'],
                'nro_documento' => $formulario_cliente['nro_documento'],
                'apellidos' => $formulario_cliente['apellido_cliente'],
                'nombres' => $formulario_cliente['nombre_cliente'],
                'direccion' => $formulario_cliente['direccion'],
                'correo' => $formulario_cliente['correo'],
                'telefono' => $formulario_cliente['telefono'],
                'celular' => $formulario_cliente['celular'],
                'estado' => 1 // Asumiendo que quieres mantener el estado en 1

            ]);

            $respuesta['tipo_msj'] = 'success';
            $respuesta['msj'] = "Cliente actualizado correctamente";
        } catch (\Exception $e) {
            $respuesta['tipo_msj'] = 'error';
            $respuesta['msj'] = 'Error al actualizar el cliente: ' . $e->getMessage();
        }

        echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
    }


    public function delete($idCliente)
    {
        try {
            // Asegúrate de que el idcliente esté incluido en los datos enviados por POST
            if (!isset($idCliente) && filter_var($idCliente, FILTER_VALIDATE_INT) !== false) {
                throw new \Exception("El ID del cliente es obligatorio.");
            }
            $this->clientes->update($idCliente, [
                'estado' => 0 // Asumiendo que quieres mantener el estado en 1
            ]);

            $respuesta['tipo_msj'] = 'success';
            $respuesta['msj'] = "Cliente se eliminó correctamente";
        } catch (\Exception $e) {
            $respuesta['tipo_msj'] = 'error';
            $respuesta['msj'] = 'Error al eliminar el cliente: ' . $e->getMessage();
        }

        echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
    }

    public function active($idCliente)
    {
        try {
            // Asegúrate de que el idcliente esté incluido en los datos enviados por POST
            if (!isset($idCliente) && filter_var($idCliente, FILTER_VALIDATE_INT) !== false) {
                throw new \Exception("El ID del cliente es obligatorio.");
            }
            $this->clientes->update($idCliente, [
                'estado' => 1 // Asumiendo que quieres mantener el estado en 1
            ]);

            $respuesta['tipo_msj'] = 'success';
            $respuesta['msj'] = "Cliente se activo correctamente";
        } catch (\Exception $e) {
            $respuesta['tipo_msj'] = 'error';
            $respuesta['msj'] = 'Error al activar el cliente: ' . $e->getMessage();
        }

        echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
    }

    public function obtenerCliente($id_cliente)
    {
        $datosCliente = $this->clientes->find($id_cliente);

        if (!$datosCliente) {
            return $this->response->setJSON(['error' => 'No existen clientes registrados']);
        }


        // Inicializa el Query Builder para la tabla 'clientes'
        $builder = $this->db->table('clientes');

        // Construye la consulta
        $builder->select('clientes.*, tipo_documento.descripcion as nombreDocumento')
            ->join('tipo_documento', 'tipo_documento.id = clientes.id_tipo_documento')
            ->where('clientes.id_cliente', $id_cliente);
        $query = $builder->get();
        // Obtiene el resultado
        $cliente = $query->getRow();
        if ($cliente) {
            return $this->response->setJSON([
                'datoCliente' => $cliente,
            ]);
        } else {
            return $this->response->setJSON(['error' => 'Cliente no encontrado']);
        }
    }
    // FUNCIONES DESDE AJAX OBTENER TODOS LOS CLIENTES
    public function obtenerClientes()
    {
        $db = \Config\Database::connect(); // Obtiene la conexión de base de datos

        $builder = $db->table('clientes cli');
        $builder->select(
            "
        '' ,
        cli.id_cliente,
        cli.id_tipo_documento,
        td.descripcion as tipo_documento,
        cli.nro_documento,
        cli.apellidos,
        cli.nombres,
        cli.direccion,
        cli.correo,
        cli.telefono,
        cli.celular,
        CASE WHEN cli.estado = 1 THEN 'ACTIVO' ELSE 'INACTIVO' END as estado",
            false
        );
        $builder->join('tipo_documento td', 'cli.id_tipo_documento = td.id');


        // Búsqueda
        if (isset($_POST["search"]["value"])) {
            $searchValue = $_POST["search"]["value"];
            $builder->like('td.descripcion', $searchValue);
            $builder->orLike('cli.nro_documento', $searchValue);
            $builder->orLike('cli.nombres', $searchValue);
            $builder->orLike('cli.apellidos', $searchValue);
            $builder->orLike('cli.direccion', $searchValue);
            $builder->orLike('cli.celular', $searchValue);
            // ... Incluir todas las condiciones de búsqueda
        }

        // Mapeo de índices de DataTables a nombres de columnas en la base de datos
        $columnMap = [
            0 => '',
            1 => 'cli.id_cliente',
            2 => 'cli.id_tipo_documento',
            3 => 'td.descripcion',
            4 => 'cli.nro_documento',
            5 => 'cli.apellidos',
            6 => 'cli.nombres',
            7 => 'cli.direccion',
            8 => 'cli.correo',
            9 => 'cli.telefono',
            10 => 'cli.celular',
            11 => 'cli.estado'
        ];

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
        $builder->select('COUNT(*) as total');
        $queryTotalFiltered = $builder->get();
        $totalFiltered = $queryTotalFiltered->getRowArray()['total'];

        // Obtener el número total de filas (sin filtros)
        $builderTotal = $db->table('productos');
        $builderTotal->select('COUNT(*) as total');
        $queryTotal = $builderTotal->get();
        $totalData = $queryTotal->getRowArray()['total'];


        // Datos para la respuesta
        $data = array();
        foreach ($results as $row) {
            $sub_array = array();
            $sub_array[] = $row[''];
            $sub_array[] = $row['id_cliente'];
            $sub_array[] = $row['id_tipo_documento'];
            $sub_array[] = $row['tipo_documento'];
            $sub_array[] = $row['nro_documento'];
            $sub_array[] = $row['apellidos'];
            $sub_array[] = $row['nombres'];
            $sub_array[] = $row['direccion'];
            $sub_array[] = $row['correo'];
            $sub_array[] = $row['telefono'];
            $sub_array[] = $row['celular'];
            $sub_array[] = $row['estado'];
            $data[] = $sub_array;
        }

        // Obtener el número total de filas
        $builder->select('COUNT(*) as total');
        $queryTotal = $builder->get();
        $totalData = $queryTotal->getRowArray();
        $count_all_data = $totalData['total'];

        $clientes = array(
            'draw' => $_POST['draw'],
            "recordsTotal" => $count_all_data,
            "recordsFiltered" => $totalFiltered,
            "data" => $data
        );

        //return $clientes;
        echo json_encode($clientes, JSON_UNESCAPED_UNICODE);
    }

}
