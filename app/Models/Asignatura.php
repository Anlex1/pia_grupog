<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Asignatura
 * 
 * @property string $codigo
 * @property string $descripcion
 * @property int|null $creditos
 * @property string $programa_codigo
 * 
 * @property Programa $programa
 * @property Collection|Docente[] $docentes
 * @property Collection|Estudiante[] $estudiantes
 * @property Collection|Proyecto[] $proyectos
 *
 * @package App\Models
 */
class Asignatura extends Model
{
	protected $table = 'asignaturas';
	protected $primaryKey = 'codigo';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'creditos' => 'int'
	];

	protected $fillable = [
		'descripcion',
		'creditos',
		'programa_codigo'
	];

	public function programa()
	{
		return $this->belongsTo(Programa::class, 'programa_codigo');
	}

	public function docentes()
	{
		return $this->belongsToMany(Docente::class, 'docente_asignaturas', 'asignatura_codigo')
					->withPivot('fecha_asignacion', 'activo');
	}

	public function estudiantes()
	{
		return $this->belongsToMany(Estudiante::class, 'estudiante_asignaturas', 'asignatura_codigo')
					->withPivot('semestre', 'año', 'grupo', 'nota_final', 'fecha_matricula', 'estado')
					->withTimestamps();
	}

	public function proyectos()
	{
		return $this->belongsToMany(Proyecto::class, 'proyecto_asignaturas', 'asignatura_codigo')
					->withPivot('docente_id', 'grupo', 'semestre', 'año');
	}
}
