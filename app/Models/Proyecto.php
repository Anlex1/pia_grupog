<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Proyecto
 * 
 * @property int $id
 * @property string $titulo
 * @property string|null $descripcion
 * @property Carbon|null $fecha_inicio
 * @property Carbon|null $fecha_fin
 * @property string $tipo_proyecto_codigo
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property USER-DEFINED|null $estado
 * 
 * @property TiposProyecto $tipos_proyecto
 * @property Collection|Asignatura[] $asignaturas
 * @property Collection|Evaluacione[] $evaluaciones
 *
 * @package App\Models
 */
class Proyecto extends Model
{
	protected $table = 'proyectos';

	protected $casts = [
		'fecha_inicio' => 'datetime',
		'fecha_fin' => 'datetime',
		'estado' => 'USER-DEFINED'
	];

	protected $fillable = [
		'titulo',
		'descripcion',
		'fecha_inicio',
		'fecha_fin',
		'tipo_proyecto_codigo',
		'estado'
	];

	public function tipos_proyecto()
	{
		return $this->belongsTo(TiposProyecto::class, 'tipo_proyecto_codigo');
	}

	public function asignaturas()
	{
		return $this->belongsToMany(Asignatura::class, 'proyecto_asignaturas', 'proyecto_id', 'asignatura_codigo')
					->withPivot('docente_id', 'grupo', 'semestre', 'año');
	}

	public function evaluaciones()
	{
		return $this->hasMany(Evaluacione::class);
	}
}
