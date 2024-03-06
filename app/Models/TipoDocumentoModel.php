<?php 

namespace App\Models;

use CodeIgniter\Model;

class TipoDocumentoModel extends Model{
    protected $table      = 'tipo_documento';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['descripcion','created_at', 'updated_at','estado'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';


    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;
}



?>