<?php

namespace App\Models;

use CodeIgniter\Model;

class ClientesModel extends Model
{
    protected $table      = 'cliente';
    protected $primaryKey = 'id_cliente';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'id_tipo_documento',
        'nro_documento',
        'apellidos',
        'nombres',
        'direccion',
        'correo',
        'telefono',
        'celular',
        'estado'
    ];





    // Dates


    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;
}
