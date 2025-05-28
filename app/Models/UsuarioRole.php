<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UsuarioRole
 * 
 * @property int $usuario_id
 * @property int $rol_id
 * @property Carbon $fecha_asignacion
 * 
 * @property Usuario $usuario
 * @property Role $role
 *
 * @package App\Models
 */
class UsuarioRole extends Model
{
	protected $table = 'usuario_roles';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'usuario_id' => 'int',
		'rol_id' => 'int',
		'fecha_asignacion' => 'datetime'
	];

	protected $fillable = [
		'fecha_asignacion'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class);
	}

	public function role()
	{
		return $this->belongsTo(Role::class, 'rol_id');
	}
}
