<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Docente
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
 * @property Collection|ProyectoAsignatura[] $proyecto_asignaturas
 *
 * @package App\Models
 */
class Docente extends Model
{
	protected $table = 'docentes';

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
		return $this->belongsToMany(Asignatura::class, 'docente_asignaturas', 'docente_id', 'asignatura_codigo')
					->withPivot('fecha_asignacion', 'activo');
	}

	public function proyecto_asignaturas()
	{
		return $this->hasMany(ProyectoAsignatura::class);
	}
}
