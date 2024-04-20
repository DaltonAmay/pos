<?php

namespace App\Controllers\Ventas;

use App\Controllers\BaseController;
use App\Models\VentasModel;


class Venta extends BaseController
{

    protected $ventas;
    public $db;

    public function __construct()
    {
        $this->ventas = new VentasModel();
        $this->db = \Config\Database::connect();
    }

    public function Index($estado = 1)
    {
        $ventas = $this->ventas->where('estado', $estado)->findAll();
        $data = [
            'titulo' => 'Administar nuevas Ventas de medida',
            'datos' => $ventas
        ];

        echo view('layout/header');

        echo view('layout/aside');
        echo view('ventas/add', $data);
        echo view('layout/footer');
    }

    public function new()
    {
        $data = [
            'titulo' => 'Registrar nueva Unidad de medida',

        ];
        echo view('layout/header');

        echo view('layout/aside');
        echo view('ventas_medida/new', $data);
        echo view('layout/footer');
    }

    public function save()
    {
        $this->ventas->save([
            'nombre' => $this->request->getPost('nombre'),
            'abreviatura' => $this->request->getPost('abreviatura')

        ]);
        return redirect()->to(base_url() . 'administrar/ventas');
    }


    public function edit($id)
    {

        $venta = $this->ventas->where('id_venta', $id)->first();

        $data = [
            'titulo' => 'Editar Ventas',
            'datos' => $venta
        ];

        echo view('layout/header');

        echo view('layout/aside');
        echo view('ventas_medida/edit', $data);
        echo view('layout/footer');
    }

    public function update()
    {
        $this->ventas->update($this->request->getPost('id'), [
            'nombre' => $this->request->getPost('nombre'), 
            'abreviatura' => $this->request->getPost('abreviatura')

        ]);
        return redirect()->to(base_url() . 'administrar/ventas');
    }

    public function delete($id)
    {
        $this->ventas->update($id, [
            'estado' => 0
        ]);
        return redirect()->to(base_url() . 'administrar/ventas');
    }

    public function eliminated($estado = 0)
    {
        $ventas = $this->ventas->where('estado', $estado)->findAll();
        $data = [
            'titulo' => 'Ventas de medida Eliminadas',
            'datos' => $ventas
        ];

        echo view('layout/header');

        echo view('layout/aside');
        echo view('ventas_medida/eliminated', $data);
        echo view('layout/footer');
    }

    public function active($id)
    {
        $this->ventas->update($id, [
            'estado' => 1
        ]);
        return redirect()->to(base_url() . 'administrar/ventas');
    }

}
