<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deduccion extends Model
{
    protected $fillable = [
        'descripcion', 
        'monto', 
        'tipo', 
        'es_porcentaje'
    ];
    protected $table = 'deducciones';

    public function nominas()
    {
        return $this->belongsToMany(Nomina::class, 'deduccion_nomina');
    }

}
