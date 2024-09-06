<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nomina extends Model
{
    protected $fillable = [
        'empleado_id',
        'puesto_id',
        'tipo_pago',
        'dias_trabajados',
        'horas_extras',
        'valor_hora_extra',
        'total_pago',
        'deducciones',        // Este campo almacenará el total de deducciones sin IGSS
        'salario_neto',
        'bonificacion_incentivo',
        'bonificacion_rendimiento',
        'cantidad_iggs',      // Este campo es específico para IGSS
        'pasajes_viaticos',
        'total_descuentos',   // Este campo puede ser usado para IGSS o para almacenar el total de descuentos
        'salario_liquido',
        'fecha_inicio',
        'fecha_fin',
        'dias_trabajados'
    ];
    

    public function empleado()
    {
        return $this->belongsTo(Empleado::class);
    }

    public function puesto()
    {
        return $this->belongsTo(Puesto::class);
    }

    public function deducciones()
    {
        return $this->belongsToMany(Deduccion::class, 'deduccion_nomina');
    }


}

