<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Programa
 * 
 * @property string $codigo
 * @property string $descripcion
 * @property string $departamento_codigo
 * 
 * @property Departamento $departamento
 * @property Collection|Asignatura[] $asignaturas
 * @property Collection|Docente[] $docentes
 * @property Collection|Estudiante[] $estudiantes
 *
 * @package App\Models
 */
class Programa extends Model
{
	protected $table = 'programas';
	protected $primaryKey = 'codigo';
	public $incrementing = false;
	public $timestamps = false;

	protected $fillable = [
		'descripcion',
		'departamento_codigo'
	];

	public function departamento()
	{
		return $this->belongsTo(Departamento::class, 'departamento_codigo');
	}

	public function asignaturas()
	{
		return $this->hasMany(Asignatura::class, 'programa_codigo');
	}

	public function docentes()
	{
		return $this->hasMany(Docente::class, 'programa_codigo');
	}

	public function estudiantes()
	{
		return $this->hasMany(Estudiante::class, 'programa_codigo');
	}
}
