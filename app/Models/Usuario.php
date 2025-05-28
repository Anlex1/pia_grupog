<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Usuario
 * 
 * @property int $id
 * @property string $username
 * @property string $email
 * @property Carbon|null $email_verified_at
 * @property string $password
 * @property bool $activo
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Role[] $roles
 *
 * @package App\Models
 */
class Usuario extends Model
{
	protected $table = 'usuarios';

	protected $casts = [
		'email_verified_at' => 'datetime',
		'activo' => 'bool'
	];

	protected $hidden = [
		'password',
		'remember_token'
	];

	protected $fillable = [
		'username',
		'email',
		'email_verified_at',
		'password',
		'activo',
		'remember_token'
	];

	public function roles()
	{
		return $this->belongsToMany(Role::class, 'usuario_roles', 'usuario_id', 'rol_id')
					->withPivot('fecha_asignacion');
	}
}
