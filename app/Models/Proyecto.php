<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    use HasFactory;

    protected $table = 'proyectos';

    protected $fillable = [
        'titulo',
        'descripcion',
        'fechaInicio',
        'fechaFin',
        'tipoProyectoId'
    ];

    protected $dates = [
        'fechaInicio',
        'fechaFin'
    ];

    // Relaciones
    public function tipoProyecto()
    {
        return $this->belongsTo(TipoProyecto::class, 'tipoProyectoId');
    }

    public function asignaturas()
    {
        return $this->belongsToMany(Asignatura::class, 'proyectoAsignaturas', 'proyectoId', 'asignaturaId')
                    ->withPivot('docenteId', 'grupo', 'semestre', 'año')
                    ->withTimestamps();
    }

    public function evaluaciones()
    {
        return $this->hasMany(Evaluacion::class, 'proyectoId');
    }

    // Scopes
    public function scopeActivos($query)
    {
        return $query->where('fechaFin', '>=', now())->orWhereNull('fechaFin');
    }
}
