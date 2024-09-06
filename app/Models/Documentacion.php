<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documentacion extends Model
{
    protected $table = 'documentaciones'; // Especifica el nombre correcto de la tabla



    protected $fillable = [
        'empleado_id', 'file_path', 'nombre'
    ];
    

    public function empleado()
    {
        return $this->belongsTo(Empleado::class);
    }

  
    
}
