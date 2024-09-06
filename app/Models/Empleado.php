<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    protected $fillable = [
        'nombres', 'apellidos', 'fecha_contratacion', 'dpi', 'tipo_sangre', 'email', 'telefono', 'direccion', 'tipo_contrato', 'puesto_id'
    ];

    public function puesto()
    {
        return $this->belongsTo(Puesto::class, 'puesto_id');
    }

    public function documentaciones() {
        return $this->hasMany(Documentacion::class);
    }

    public function nominas()
    {
        return $this->hasMany(Nomina::class);
    }

    
}
