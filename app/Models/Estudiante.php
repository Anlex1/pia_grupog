<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    use HasFactory;

    protected $table = 'estudiantes';

    protected $fillable = [
        'identificacion',
        'nombres',
        'apellidos',
        'email',
        'telefono',
        'programa_codigo'
    ];

    protected $appends = ['nombre_completo'];

    // Relaciones
    public function programa()
    {
        return $this->belongsTo(Programa::class, 'programa_codigo', 'codigo');
    }

    public function asignaturas()
    {
        return $this->belongsToMany(Asignatura::class, 'estudiante_asignaturas', 'estudiante_id', 'asignatura_codigo')
                    ->withPivot('semestre', 'año', 'grupo', 'estado', 'nota_final', 'fecha_matricula')
                    ->withTimestamps();
    }

    public function proyectos()
    {
        return $this->belongsToMany(Proyecto::class, 'proyecto_estudiantes', 'estudiante_id', 'proyecto_id')
                    ->withPivot('rol', 'fecha_asignacion')
                    ->withTimestamps();
    }

    // Accessor para nombre completo
    public function getNombreCompletoAttribute()
    {
        return trim($this->nombres . ' ' . $this->apellidos);
    }

    // Scopes útiles
    public function scopePorPrograma($query, $programaCodigo)
    {
        return $query->where('programa_codigo', $programaCodigo);
    }

    public function scopeBuscar($query, $termino)
    {
        return $query->where(function($q) use ($termino) {
            $q->where('identificacion', 'like', "%{$termino}%")
              ->orWhere('nombres', 'like', "%{$termino}%")
              ->orWhere('apellidos', 'like', "%{$termino}%")
              ->orWhere('email', 'like', "%{$termino}%");
        });
    }

    public function scopeConProyectosActivos($query)
    {
        return $query->whereHas('proyectos', function($q) {
            $q->whereIn('estado', ['planificado', 'en_desarrollo']);
        });
    }

    // Métodos auxiliares
    public function estaEnProyecto($proyectoId)
    {
        return $this->proyectos()->where('proyecto_id', $proyectoId)->exists();
    }

    public function proyectosActivos()
    {
        return $this->proyectos()->whereIn('estado', ['planificado', 'en_desarrollo']);
    }

    public function proyectosTerminados()
    {
        return $this->proyectos()->where('estado', 'terminado');
    }

    public function getAsignaturasMatriculadas()
    {
        return $this->asignaturas()->wherePivot('estado', 'matriculado');
    }
}