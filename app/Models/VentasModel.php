<?php

namespace App\Models;

use CodeIgniter\Model;

class VentasModel extends Model
{
    protected $table      = 'venta';
    protected $primaryKey = 'id_venta';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields =  [
        'idventa',
        'numero_venta',
        'fecha_emision',
        'id_tipo_comprobante',
        'subtotal',
        'iva',
        'exento',
        'retenido',
        'descuento',
        'importe_total',
        'sonletras',
        'recibido',
        'cambio',
        'pago_efectivo',
        'pago_tarjeta',
        'numero_tarjeta',
        'tarjeta_ambiente',
        'id_serie',
        'id_cliente',
        'id_usuario',
        'estado',
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
