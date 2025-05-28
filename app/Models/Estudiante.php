<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Estudiante
 * 
 * @property int $id
 * @property string $identificacion
 * @property string $nombres
 * @property string $apellidos
 * @property string $email
 * @property string|null $telefono
 * @property string $programa_codigo
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Programa $programa
 * @property Collection|Asignatura[] $asignaturas
 *
 * @package App\Models
 */
class Estudiante extends Model
{
	protected $table = 'estudiantes';

	protected $fillable = [
		'identificacion',
		'nombres',
		'apellidos',
		'email',
		'telefono',
		'programa_codigo'
	];

	public function programa()
	{
		return $this->belongsTo(Programa::class, 'programa_codigo');
	}

	public function asignaturas()
	{
		return $this->belongsToMany(Asignatura::class, 'estudiante_asignaturas', 'estudiante_id', 'asignatura_codigo')
					->withPivot('semestre', 'año', 'grupo', 'nota_final', 'fecha_matricula', 'estado')
					->withTimestamps();
	}
}
