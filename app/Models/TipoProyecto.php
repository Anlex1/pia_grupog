<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TipoProyecto
 * 
 * @property int $id
 * @property string $codigo
 * @property string $descripcion
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class TipoProyecto extends Model
{
	protected $table = 'tipo_proyectos';

	protected $fillable = [
		'codigo',
		'descripcion'
	];
}
