<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class EstudianteAsignatura
 * 
 * @property int $estudiante_id
 * @property string $asignatura_codigo
 * @property string $semestre
 * @property int $año
 * @property string|null $grupo
 * @property float|null $nota_final
 * @property Carbon $fecha_matricula
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property USER-DEFINED|null $estado
 * 
 * @property Estudiante $estudiante
 * @property Asignatura $asignatura
 *
 * @package App\Models
 */
class EstudianteAsignatura extends Model
{
	protected $table = 'estudiante_asignaturas';
	public $incrementing = false;

	protected $casts = [
		'estudiante_id' => 'int',
		'año' => 'int',
		'nota_final' => 'float',
		'fecha_matricula' => 'datetime',
		'estado' => 'USER-DEFINED'
	];

	protected $fillable = [
		'grupo',
		'nota_final',
		'fecha_matricula',
		'estado'
	];

	public function estudiante()
	{
		return $this->belongsTo(Estudiante::class);
	}

	public function asignatura()
	{
		return $this->belongsTo(Asignatura::class, 'asignatura_codigo');
	}
}
