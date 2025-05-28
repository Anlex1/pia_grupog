<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Evaluadore
 * 
 * @property int $id
 * @property string $identificacion
 * @property string $nombres
 * @property string $apellidos
 * @property string $email
 * @property string|null $telefono
 * @property string|null $especialidad
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Evaluacione[] $evaluaciones
 *
 * @package App\Models
 */
class Evaluadore extends Model
{
	protected $table = 'evaluadores';

	protected $fillable = [
		'identificacion',
		'nombres',
		'apellidos',
		'email',
		'telefono',
		'especialidad'
	];

	public function evaluaciones()
	{
		return $this->hasMany(Evaluacione::class, 'evaluador_id');
	}
}
