<?php 

namespace App\Models;

use CodeIgniter\Model;

class SeriesModel extends Model{

    protected $table      = 'serie';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['id_tipo_comprobante','serie','numero_inicial','numero_actual','estado'];


    public function getTipoComprobante()
    {
        return $this->belongsTo('App\Models\TipoComprobanteModel', 'id_tipo_comprobante', 'id');
    }

  
}



?>