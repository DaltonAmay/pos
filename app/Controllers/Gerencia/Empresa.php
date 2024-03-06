<?php

namespace App\Controllers\Gerencia;

use App\Controllers\BaseController;
use App\Models\EmpresaModel;
use App\Models\TipoDocumentoModel;


class Empresa extends BaseController
{

    protected $empresa, $tipDocumento;

    public $db;

    public function __construct()
    {
        $this->empresa = new EmpresaModel();
        $this->tipDocumento = new TipoDocumentoModel();
        $this->db =  \Config\Database::connect();
        $this->validation = \Config\Services::validation();
    }

    public function Index()
    {
        $data = [
            'titulo' => 'Administar Empresa'
        ];

        echo view('layout/header');
        echo view('layout/aside');
        echo view('empresa/list', $data);
        echo view('layout/footer');
    }

    protected function validarEmpresa($data)
    {
        $validationRules = [
            'tipo_documento' => 'required|string|max_length[13]',
            'numero_documento' => 'required|string|max_length[13]|is_natural',
            'razon_social' => 'required|string|max_length[255]',
            'nombre_comercial' => 'required|string|max_length[255]',
            'email' => 'permit_empty|valid_email|max_length[255]',
            'telefono' => 'permit_empty|string|max_length[15]',
            'direccion' => 'required|string|max_length[255]',
            'canton' => 'required|string|max_length[255]',
            'provincia' => 'required|string|max_length[255]',
            'cod_postal' => 'permit_empty|string|max_length[10]',
            'entidad_certificadora' => 'permit_empty|integer',
            'ruta_certificado' => 'permit_empty|string|max_length[255]',
            'clave_certificado' => 'permit_empty|string|max_length[255]',
            'usuario_sri' => 'permit_empty|string|max_length[255]',
            'clave_sri' => 'permit_empty|string|max_length[255]',
            'empresa_principal' => 'permit_empty|integer',
            'factura_default' => 'permit_empty|integer',
            'genera_fact_electronica' => 'permit_empty|integer',
        ];



        $this->validation->setRules($validationRules);

        if (!$this->validation->run($data)) {
            return [
                'success' => false,
                'errors'  =>  $this->validation->getErrors()
            ];
        }

        return ['success' => true];
    }

    // public function saveImage($fileInputName)
    // {
    //     $response = [
    //         'success' => false,
    //         'data' => null,
    //         'error' => null,
    //     ];
    //     if ($fileInputName && $fileInputName->isValid() && !$fileInputName->hasMoved()) {
    //         try {
    //             // Obtener el contenido del archivo
    //             $imageContent = file_get_contents($fileInputName->getTempName());

    //             $response['success'] = true;
    //             $response['data'] = $imageContent;
    //         } catch (\Exception $e) {
    //             $response['error'] = 'Error al procesar la imagen: ' . $e->getMessage();
    //         }
    //     } else {
    //         $response['error'] = 'No se ha proporcionado una imagen válida o hubo un error en la carga.';
    //     }

    //     return $response;
    // }
    public function saveImage($fileInputName, $isUpdate = false)
    {
        $response = [
            'success' => true,  // Asumimos éxito a menos que se pruebe lo contrario
            'data' => null,
            'error' => null,
        ];

        // Procesamos la nueva imagen si se ha proporcionado una y es válida
        if ($fileInputName && $fileInputName->isValid() && !$fileInputName->hasMoved()) {
            try {
                // Obtener el contenido binario de la imagen
                $imageContent = file_get_contents($fileInputName->getTempName());
                $response['data'] = $imageContent;  // Almacenamos el contenido binario de la nueva imagen
                return $response;
            } catch (\Exception $e) {
                $response['success'] = false;
                $response['error'] = 'Error al procesar la imagen: ' . $e->getMessage();
            }
        } else {
            //SI HAY UNA ACTUALIZACION Y EL USUARIO NO CAMBIO EL LOGO
            if ($isUpdate) {
                $response['data'] = false;//NO SE CAMBIA EL LOGO
            } else {
                // Si estamos creando un nuevo registro pero no se ha proporcionado ninguna imagen las variables de data van igual a como se las declaró osea en null
            }
        }

        return $response;
    }



    public function save($formEmpresa, $imageResponse, $certi)
    {

        // Primero, validamos los datos
        $validacion = $this->validarEmpresa($formEmpresa);
        if (!$validacion['success']) {
            return [
                'tipo_msj' => 'error',
                'msj' => 'Error en la validación de datos',
                'errores' => $validacion['errors']
            ];
        }
        //SI EL USUARIO REGISTRA LA EMPRESA SIN IMAGEN 
        if ($imageResponse['data'] == null) {
            $logo = null;
            $img = false;
        } else { //SI EL USUARIO REGISTRA LA IMAGEN 
            $logo = $imageResponse['data'];;
            $img = true;
        }

        try {
            $rutaArchivoGuardado = null;
            $claveCertificado = null;
            $usuSRI = null;
            $claveSRI = null;
            $entCert = null;
            if ($formEmpresa['rb_genera_facturacion'] == 1) {

                $claveCertificado = $formEmpresa['clave_certificado'];
                $usuSRI = $formEmpresa['usuarioSri'];
                $claveSRI = $formEmpresa['claveSRI'];
                $entCert = $formEmpresa['entiCertificadora'];

                // Usando realpath para resolver la ruta correctamente y DIRECTORY_SEPARATOR para compatibilidad con el SO
                $carpetaDestino = WRITEPATH . 'electronica' . DIRECTORY_SEPARATOR . 'firma' . DIRECTORY_SEPARATOR;
                if (!file_exists($carpetaDestino)) {
                    mkdir($carpetaDestino, 0777, true); // Asegúrate de que los permisos sean adecuados para tu entorno
                }

                if ($certi) {
                    // Asegúrate de que el nombre del archivo no contenga caracteres que puedan ser explotados
                    $nombreArchivoSeguro = basename($certi["nombre_archivo"]);

                    // Verificar que el nombre de archivo no tiene espacios o caracteres especiales
                    $nombreArchivoSeguro = preg_replace('/\s+/', '_', $nombreArchivoSeguro);

                    // Construir la ruta completa del archivo de destino utilizando DIRECTORY_SEPARATOR
                    $rutaArchivoGuardado = $carpetaDestino . $nombreArchivoSeguro;

                    // Mover el archivo desde la ubicación temporal a la ubicación final
                    if (!move_uploaded_file($certi["ubicacionTemporal"], $rutaArchivoGuardado)) {
                        throw new \Exception("No se pudo guardar el archivo en la ruta: " . $rutaArchivoGuardado);
                    }
                }
            }


            // Construir el arreglo con los datos del formulario
            $this->empresa->save([
                'tipo_documento' => $formEmpresa['tipo_documento'],
                'numero_documento' => $formEmpresa['numero_documento'],
                'razon_social' => $formEmpresa['razon_social'],
                'nombre_comercial' => $formEmpresa['nombre_comercial'],
                'email' => $formEmpresa['email'],
                'telefono' => $formEmpresa['telefono'],
                'direccion' => $formEmpresa['direccion'],
                'canton' => $formEmpresa['canton'],
                'provincia' => $formEmpresa['provincia'],
                'cod_postal' => $formEmpresa['cod_postal'],
                'idEntidad' => $entCert,
                'ruta_certificado' => $rutaArchivoGuardado,
                'clave_certificado' => $claveCertificado,
                'usuario_sri' => $usuSRI,
                'clave_sri' => $claveSRI,
                'estado' => 1,
                'empresa_principal' => $formEmpresa['rb_empresa_principal'],
                'factura_default' => $formEmpresa['rb_fact_nota_defecto'],
                'genera_fact_electronica' => $formEmpresa['rb_genera_facturacion'],
                'logo' => $logo,
                'img' => $img //si es true tiene imagen si es false no hay imagen
            ]);

            $res = [
                'tipo_msj' => 'success',
                'msj' => 'Se registró la Empresa correctamente'
            ];
            return $res;
        } catch (\Throwable $th) {
            return [
                'tipo_msj' => 'error',
                'msj' => 'Error al registrar la Empresas: ' . $th->getMessage()
            ];
        }
    }

    public function crud()
    {
        $respuesta = "";

        $formEmpresa = [];
        $accion = $_POST['accion'];
        parse_str($_POST['datos_empresa'], $formEmpresa);

        try {
            if ($accion == "registrar_empresa") {
                //MANEJO DEL LOGO IMG
                $imgFile = $this->request->getFile('archivo_imagen.0');
                $imageResponse = $this->saveImage($imgFile, false);

                if (!$imageResponse['success']) {

                    return $this->response->setJSON([
                        'tipo_msj' => 'error',
                        'msj' => $imageResponse['error']
                    ]);
                }

                $certificado = null;
                if (isset($_FILES["archivo"]["name"])) {
                    $certificado["ubicacionTemporal"] =  $_FILES["archivo"]["tmp_name"][0];
                    $certificado["nombre_archivo"] = $_FILES["archivo"]["name"][0];
                }

                $respuesta = $this->save($formEmpresa, $imageResponse, $certificado);

                //ACTUALIZO LOS REGISTROS DE EMPRESA
                /////////////////////////////////////
            } else if ($accion == "actualizar_empresa") {
                //MANEJO DEL LOGO IMG
                $imgFile = $this->request->getFile('archivo_imagen.0');

                //img[] ocupo para indicar si tiene o no imagen el segundo parametro indica que es un update
                $imageResponse = $this->saveImage($imgFile, true);

                if (!$imageResponse['success']) {
                    return $this->response->setJSON([
                        'tipo_msj' => 'error al cargar la imagen',
                        'msj' => $imageResponse['error']
                    ]);
                }
                $certificado = null;
                if (isset($_FILES["archivo"]["name"])) {
                    $certificado["ubicacionTemporal"] =  $_FILES["archivo"]["tmp_name"][0];
                    $certificado["nombre_archivo"] = $_FILES["archivo"]["name"][0];
                }
                $respuesta = $this->update($formEmpresa, $imageResponse, $certificado);
            }
        } catch (\Exception $e) {
            $respuesta = [
                'tipo_msj' => 'error',
                'msj' => 'Error al registrar la Empresa: ' . $e->getMessage()
            ];
        }

        echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
    }


    public function ajaxListarEmpresas()
    {

        $builder = $this->db->table('empresa emp'); // Asegúrate de que la tabla se llame 'empresas'
        $builder->select(
            "emp.id_empresa,
             emp.razon_social,
             emp.numero_documento,
             emp.razon_social,
             emp.nombre_comercial,
             emp.email,
             emp.telefono,
             emp.direccion,
             emp.canton,
             emp.provincia,
             emp.cod_postal,
             emp.ruta_certificado,
             emp.clave_certificado,
             emp.usuario_sri,
             emp.clave_sri,
             emp.empresa_principal,
             emp.factura_default,
             emp.logo,
             emp.created_at,
             emp.updated_at,
             '' as opciones,
             CASE WHEN emp.estado = 1 THEN 'ACTIVO' ELSE 'INACTIVO' END as estado",
            false
        );

        // Búsqueda
        if (isset($_POST["search"]["value"])) {
            $searchValue = $_POST["search"]["value"];
            $builder->like('emp.razon_social', $searchValue);
            $builder->orLike('emp.numero_documento', $searchValue);
            $builder->orLike('emp.nombre_comercial', $searchValue);
            $builder->orLike('emp.email', $searchValue);
            $builder->orLike('emp.telefono', $searchValue);
            $builder->orLike('emp.direccion', $searchValue);
            $builder->orLike('emp.canton', $searchValue);
            $builder->orLike('emp.provincia', $searchValue);
            $builder->orLike('emp.cod_postal', $searchValue);
            $builder->orLike('emp.clave_certificado', $searchValue);
            $builder->orLike('emp.usuario_sri', $searchValue);
        }

        // Mapeo de índices de DataTables a nombres de columnas en la base de datos
        $columnMap = [
            0 => 'emp.id_empresa',
            1 => 'emp.razon_social',
            2 => 'emp.nombre_comercial', // Asegúrate de que el campo en la base de datos sea 'numero_documento'
            3 => 'emp.numero_documento',
            4 => 'emp.direccion',
            5 => 'emp.email',
            6 => 'emp.telefono',
            7 => 'emp.provincia',
            8 => 'emp.canton',
            9 => 'emp.usuario_sri',
            10 => 'emp.empresa_principal',
            11 => 'emp.created_at',
            12 => 'emp.updated_at',
            13 => 'emp.estado',
            14 => 'emp.cod_postal',
            15 => 'emp.factura_default',
            16 => 'emp.logo',
            17 => 'emp.ruta_certificado',
            18 => 'emp.clave_certificado',
            19 => 'emp.clave_sri',
            20 => 'opciones' // Este corresponderá al campo '' as opciones
        ];

        // Orden
        $order = $this->request->getPost('order');
        if (!empty($order)) {
            $orderColumnIndex = $order[0]['column'];
            $orderColumn = $columnMap[$orderColumnIndex] ?? null;
            $orderDir = $order[0]['dir'];
            if ($orderColumn) {
                $builder->orderBy($orderColumn, $orderDir);
            } else {
                // Si no hay una columna de orden especificada, puedes definir un orden por defecto
                $builder->orderBy('emp.created_at', 'desc'); // Ordena por fecha de creación de forma predeterminada
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
        $builderTotal = $this->db->table('empresa');
        $builderTotal->select('COUNT(*) as total');
        $queryTotal = $builderTotal->get();
        $totalData = $queryTotal->getRowArray()['total'];

        $data = array();
        foreach ($results as $row) {
            $sub_array = array();
            $sub_array[] = $row['id_empresa'];
            $sub_array[] = $row['opciones'];
            $sub_array[] = $row['razon_social'];
            $sub_array[] = $row['nombre_comercial'];
            $sub_array[] = $row['numero_documento'];
            $sub_array[] = $row['direccion'];
            $sub_array[] = $row['email'];
            $sub_array[] = $row['telefono'];
            $sub_array[] = $row['provincia'];
            $sub_array[] = $row['canton'];
            $sub_array[] = $row['usuario_sri'];
            $sub_array[] = $row['empresa_principal'];

            $sub_array[] = $row['created_at'];
            $sub_array[] = $row['updated_at'];
            $sub_array[] = $row['estado']; // Asegúrate de que 'estado' sea parte de tu consulta SELECT
            // Este campo estará vacío ya que lo has definido así en tu SELECT

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

    public function obtenerImagen($idEmpresa)
    {
        $empresaImg = $this->empresa->find($idEmpresa);
        $datosImagen = $empresaImg['logo'] ?? null;

        if ($datosImagen) {
            // Si hay datos de imagen, los enviamos en la respuesta.
            // Necesitarás determinar el tipo de contenido (MIME type) de la imagen.
            // Esto puede ser un desafío si se guardan diferentes tipos de imágenes (jpg, png, gif, etc.)
            // Puede que necesites guardar esta información en la base de datos o intentar detectarla de alguna manera.
            $tipoMime = 'image/jpeg'; // Ejemplo, asumiendo que todas las imágenes son JPEG

            return $this->response
                ->setStatusCode(200)
                ->setContentType($tipoMime)
                ->setBody($datosImagen);
        } else {
            // Si no hay datos de imagen, enviamos una imagen por defecto o un error
            $rutaImagenPorDefecto = 'assets/imagenes/logo.jpg'; // Asegúrate de que esta ruta sea correcta y el archivo exista
            $imagenPorDefecto = file_get_contents($rutaImagenPorDefecto);

            return $this->response
                ->setStatusCode(404) // O podrías querer usar un código diferente ya que estás proporcionando una imagen por defecto
                ->setContentType('image/jpeg') // Asegúrate de que esto coincida con el tipo MIME de tu imagen por defecto
                ->setBody($imagenPorDefecto);
        }
    }



    public function obtenerEmpresas()
    {
        // $data = $this->empresa->where('estado', 1)->findAll();
        $data = $this->empresa->findAll();
        if (count($data) > 0) {
            return json_encode($data);
        } else {
            return json_encode([
                'error' => 'No se encontraron categorias activas.'
            ]); // Devuelve un código de estado HTTP 404
        }
    }

    // Endpoint para descargar el certificado
    public function descargarCertificado($idEmpresa)
    {
        // Buscar información de la empresa basada en el id
        $empresa = $this->empresa->find($idEmpresa);

        // Verificar que la empresa existe y que tiene un certificado asociado
        if ($empresa && !empty($empresa['ruta_certificado'])) {
            $rutaCertificado = $empresa['ruta_certificado'];

            // Verificar que el archivo existe en el servidor
            if (file_exists($rutaCertificado)) {
                // Servir el archivo para descarga
                return $this->response->download($rutaCertificado, null, true);
            } else {
                // Manejar el error cuando el archivo no existe
                return $this->response->setStatusCode(404, 'Certificado no encontrado');
            }
        } else {
            // Manejar el error cuando no se encuentra la empresa o no tiene certificado
            return $this->response->setStatusCode(404, 'Empresa o certificado no encontrado');
        }
    }



    public function obtenerEmpresa($id)
    {
        $datoEmpresa = $this->empresa->find($id);

        if ($datoEmpresa) {
            // Eliminar el campo 'logo' del array antes de enviarlo para evitar conflictos al convertir los datos a json
            unset($datoEmpresa['logo']);
            return $this->response->setJSON([
                'datoEmp' => $datoEmpresa,
            ]);
        } else {
            return $this->response->setJSON(['error' => 'No se a registrado ninguna empresa']);
        }
    }




    public function update($formEmpresa, $imageResponse, $certi)
    {
        //SI EL USUARIO ACTUALIZA LA EMPRESA PERO NO CAMBIA LA IMAGEN NO SE HACE NADA

        try {
            $empresaId = $formEmpresa['id_empresa'];
            $empresa = $this->empresa->find($empresaId);

            if (!$empresa) {
                throw new \Exception("Empresa no encontrada.");
            }

            $rutaArchivoGuardado = "";
            $claveCertificado = "";
            $usuSRI = "";
            $claveSRI = "";
            $entCert = "";
            if ($formEmpresa['rb_genera_facturacion'] == 1) {

                $claveCertificado = $formEmpresa['clave_certificado'];
                $usuSRI = $formEmpresa['usuarioSri'];
                $claveSRI = $formEmpresa['claveSRI'];
                $entCert = $formEmpresa['entiCertificadora'];
                // Verificar si se ha cargado un nuevo certificado
                if ($certi && isset($certi["ubicacionTemporal"]) && file_exists($certi["ubicacionTemporal"])) {
                    // Eliminar el certificado anterior si existe
                    $this->eliminarCertificadoAnterior($empresaId);

                    // Procesa y guarda el nuevo certificado
                    $carpetaDestino = WRITEPATH . 'electronica' . DIRECTORY_SEPARATOR . 'firma' . DIRECTORY_SEPARATOR;
                    if (!file_exists($carpetaDestino)) {
                        mkdir($carpetaDestino, 0777, true);
                    }

                    // Asegura que el nombre del archivo sea seguro
                    $nombreArchivoSeguro = basename($certi["nombre_archivo"]);
                    $nombreArchivoSeguro = preg_replace('/\s+/', '_', $nombreArchivoSeguro);

                    // Construye la ruta completa del archivo de destino
                    $rutaArchivoGuardado = $carpetaDestino . $nombreArchivoSeguro;

                    // Mueve el archivo desde la ubicación temporal a la ubicación final
                    if (!move_uploaded_file($certi["ubicacionTemporal"], $rutaArchivoGuardado)) {
                        throw new \Exception("No se pudo guardar el archivo en la ruta: " . $rutaArchivoGuardado);
                    }
                } else {
                    // Conserva la ruta existente del certificado por defecto
                    $rutaArchivoGuardado = $empresa['ruta_certificado'];
                }
            }

            // Prepara los datos para la actualización
            $datosActualizados = [
                'ruta_certificado' => $rutaArchivoGuardado, // Actualiza la ruta del certificado
                'tipo_documento' => $formEmpresa['tipo_documento'],
                'numero_documento' => $formEmpresa['numero_documento'],
                'razon_social' => $formEmpresa['razon_social'],
                'nombre_comercial' => $formEmpresa['nombre_comercial'],
                'email' => $formEmpresa['email'],
                'telefono' => $formEmpresa['telefono'],
                'direccion' => $formEmpresa['direccion'],
                'canton' => $formEmpresa['canton'],
                'provincia' => $formEmpresa['provincia'],
                'cod_postal' => $formEmpresa['cod_postal'],
                'idEntidad' => $entCert,
                'clave_certificado' => $claveCertificado,
                'usuario_sri' => $usuSRI,
                'clave_sri' => $claveSRI,
                'empresa_principal' => $formEmpresa['rb_empresa_principal'],
                'factura_default' => $formEmpresa['rb_fact_nota_defecto'],
                'genera_fact_electronica' => $formEmpresa['rb_genera_facturacion'],
            ];

            if ($imageResponse['data'] != false) {
                $datosActualizados['logo']  = $imageResponse['data'];
                $datosActualizados['img']  = true;
            } 


            $this->empresa->update($empresaId, $datosActualizados);

            return [
                'tipo_msj' => 'success',
                'msj' => 'Empresa actualizada correctamente'
            ];
        } catch (\Throwable $th) {
            return [
                'tipo_msj' => 'error',
                'msj' => 'Error al actualizar la Empresa: ' . $th->getMessage()
            ];
        }
    }

    private function eliminarCertificadoAnterior($idEmpresa)
    {
        $empresa = $this->empresa->find($idEmpresa);
        if (!$empresa) {
            return false;
        }

        $rutaCertificadoAnterior = $empresa['ruta_certificado'];
        if (!empty($rutaCertificadoAnterior) && file_exists($rutaCertificadoAnterior)) {
            unlink($rutaCertificadoAnterior);
        }

        return true;
    }




    public function deleteLogo($id)
    {
        try {
            // Asegúrate de que el idcliente esté incluido en los datos enviados por POST
            if (!isset($id) && filter_var($id, FILTER_VALIDATE_INT) !== false) {
                throw new \Exception("El ID de la empresa es obligatorio.");
            }

            $this->empresa->update($id, [
                'logo' => null,
                'img' => false
            ]);

            $respuesta['tipo_msj'] = 'success';
            $respuesta['msj'] = "Logo eliminado satisfactoriamente..";
        } catch (\Exception $e) {
            $respuesta['tipo_msj'] = 'error';
            $respuesta['msj'] = 'Error al eliminar Logo : ' . $e->getMessage();
        }

        echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
    }

    public function delete($id)
    {
        try {
            // Asegúrate de que el idcliente esté incluido en los datos enviados por POST
            if (!isset($id) && filter_var($id, FILTER_VALIDATE_INT) !== false) {
                throw new \Exception("El ID de la empresa es obligatorio.");
            }

            $this->empresa->update($id, [
                'estado' => 0,
            ]);

            $respuesta['tipo_msj'] = 'success';
            $respuesta['msj'] = "Empresa eliminada satisfactoriamente..";
        } catch (\Exception $e) {
            $respuesta['tipo_msj'] = 'error';
            $respuesta['msj'] = 'Error al eliminar Empresa : ' . $e->getMessage();
        }

        echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
    }

    public function active($id)
    {
        try {
            // Asegúrate de que el idcliente esté incluido en los datos enviados por POST
            if (!isset($id) && filter_var($id, FILTER_VALIDATE_INT) !== false) {
                throw new \Exception("El ID de la empresa es obligatorio.");
            }

            $this->empresa->update($id, [
                'estado' => 1,
            ]);

            $respuesta['tipo_msj'] = 'success';
            $respuesta['msj'] = "Empresa activada satisfactoriamente..";
        } catch (\Exception $e) {
            $respuesta['tipo_msj'] = 'error';
            $respuesta['msj'] = 'Error al activar Empresa : ' . $e->getMessage();
        }

        echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
    }
}
