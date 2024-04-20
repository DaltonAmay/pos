<?php 

namespace App\Models;

use CodeIgniter\Model;

class ProductosModel extends Model{
    protected $table      = 'producto';
    protected $primaryKey = 'id_producto';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'cod_interno',
        'cod_barras',
        'nombre_producto', 
        'precio_compra',
        'precio_venta',
        'precio_venta_mayoreo',
        'utilidad',
        'stock_min',
        'stock',
        'idcategoria', 
        'idmarca',
        'idunidad',
        'estado',
        'exento', 
        'inventariable',
        'perecedero',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';


    // protected $belongsTo = [
    //     'categorias' => [
    //         'model' => 'CategoriasModel',
    //         'foreign_key' => 'idcategoria',
    //         'local_key' => 'id_categoria'
    //     ]
    // ];


    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;
}



?>