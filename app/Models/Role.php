<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Role
 * 
 * @property int $id
 * @property string $nombre
 * @property string|null $descripcion
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Usuario[] $usuarios
 * @property Collection|RolPermiso[] $rol_permisos
 *
 * @package App\Models
 */
class Role extends Model
{
	protected $table = 'roles';

	protected $fillable = [
		'nombre',
		'descripcion'
	];

	public function usuarios()
	{
		return $this->belongsToMany(Usuario::class, 'usuario_roles', 'rol_id')
					->withPivot('fecha_asignacion');
	}

	public function rol_permisos()
	{
		return $this->hasMany(RolPermiso::class, 'rol_id');
	}
}
