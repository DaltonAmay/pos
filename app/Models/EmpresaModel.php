<?php

namespace App\Models;

use CodeIgniter\Model;

class EmpresaModel extends Model
{
    protected $table      = 'empresa';
    protected $primaryKey = 'id_empresa';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'genera_fact_electronica',
        'tipo_documento',
        'numero_documento',
        'razon_social',
        'nombre_comercial',
        'email',
        'telefono',
        'direccion',
        'departamento',
        'provincia',
        'canton',
        'cod_postal',
        'idEntidad',
        'ruta_certificado',
        'clave_certificado',
        'usuario_sri',
        'clave_sri',
        'estado',
        'empresa_principal',
        'factura_default',
        'genera_fact_electronica',
        'logo',
        'img',
        'estado'
    ];





    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;
}
