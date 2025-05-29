<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluacion extends Model
{
    use HasFactory;

    protected $table = 'evaluaciones';

    protected $fillable = [
        'proyectoId',
        'evaluadorId',
        'fechaEvaluacion',
        'calificacion',
        'observaciones',
        'criteriosEvaluacion'
    ];

    protected $dates = [
        'fechaEvaluacion'
    ];

    protected $casts = [
        'calificacion' => 'decimal:2',
        'criteriosEvaluacion' => 'array'
    ];

    // Relaciones
    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class, 'proyectoId');
    }

    public function evaluador()
    {
        return $this->belongsTo(Evaluador::class, 'evaluadorId');
    }
}