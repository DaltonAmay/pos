<?php 

namespace App\Models;

use CodeIgniter\Model;

class TipoComprobanteModel extends Model{
    protected $table      = 'tipo_comprobante';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['codigo','descripcion','estado'];

  
}



?>