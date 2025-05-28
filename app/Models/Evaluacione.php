<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Evaluacione
 * 
 * @property int $id
 * @property int $proyecto_id
 * @property int $evaluador_id
 * @property Carbon $fecha_evaluacion
 * @property float|null $calificacion
 * @property string|null $observaciones
 * @property string|null $criterios_evaluacion
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Proyecto $proyecto
 * @property Evaluadore $evaluadore
 *
 * @package App\Models
 */
class Evaluacione extends Model
{
	protected $table = 'evaluaciones';

	protected $casts = [
		'proyecto_id' => 'int',
		'evaluador_id' => 'int',
		'fecha_evaluacion' => 'datetime',
		'calificacion' => 'float'
	];

	protected $fillable = [
		'proyecto_id',
		'evaluador_id',
		'fecha_evaluacion',
		'calificacion',
		'observaciones',
		'criterios_evaluacion'
	];

	public function proyecto()
	{
		return $this->belongsTo(Proyecto::class);
	}

	public function evaluadore()
	{
		return $this->belongsTo(Evaluadore::class, 'evaluador_id');
	}
}
