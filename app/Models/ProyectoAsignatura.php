<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ProyectoAsignatura
 * 
 * @property int $proyecto_id
 * @property string $asignatura_codigo
 * @property int $docente_id
 * @property string|null $grupo
 * @property int|null $semestre
 * @property int|null $año
 * @property Carbon $created_at
 * 
 * @property Proyecto $proyecto
 * @property Asignatura $asignatura
 * @property Docente $docente
 *
 * @package App\Models
 */
class ProyectoAsignatura extends Model
{
	protected $table = 'proyecto_asignaturas';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'proyecto_id' => 'int',
		'docente_id' => 'int',
		'semestre' => 'int',
		'año' => 'int'
	];

	protected $fillable = [
		'docente_id',
		'grupo',
		'semestre',
		'año'
	];

	public function proyecto()
	{
		return $this->belongsTo(Proyecto::class);
	}

	public function asignatura()
	{
		return $this->belongsTo(Asignatura::class, 'asignatura_codigo');
	}

	public function docente()
	{
		return $this->belongsTo(Docente::class);
	}
}
