<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class DocenteAsignatura
 * 
 * @property int $docente_id
 * @property string $asignatura_codigo
 * @property Carbon $fecha_asignacion
 * @property bool $activo
 * @property Carbon $created_at
 * 
 * @property Docente $docente
 * @property Asignatura $asignatura
 *
 * @package App\Models
 */
class DocenteAsignatura extends Model
{
	protected $table = 'docente_asignaturas';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'docente_id' => 'int',
		'fecha_asignacion' => 'datetime',
		'activo' => 'bool'
	];

	protected $fillable = [
		'fecha_asignacion',
		'activo'
	];

	public function docente()
	{
		return $this->belongsTo(Docente::class);
	}

	public function asignatura()
	{
		return $this->belongsTo(Asignatura::class, 'asignatura_codigo');
	}
}
