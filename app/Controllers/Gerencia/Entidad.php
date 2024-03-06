<?php

namespace App\Controllers\Gerencia;

use App\Controllers\BaseController;
use App\Models\EntidadModel;


class Entidad extends BaseController
{

    protected $entidad;

    public $db;

    public function __construct()
    {
        $this->entidad = new EntidadModel();
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
        echo view('entidad/list', $data);
        echo view('layout/footer');
    }

    public function obtenerEntidades(){
        $data = $this->entidad->where('estado', 1)->findAll();
        if (count($data) > 0) {
            return json_encode($data);
        } else {
            return json_encode([
                'error' => 'No se encontraron categorias activas.'
            ]); 
        }
    }
}