<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TiposProyecto
 * 
 * @property string $codigo
 * @property string $nombre
 * @property string|null $descripcion
 * 
 * @property Collection|Proyecto[] $proyectos
 *
 * @package App\Models
 */
class TiposProyecto extends Model
{
	protected $table = 'tipos_proyecto';
	protected $primaryKey = 'codigo';
	public $incrementing = false;
	public $timestamps = false;

	protected $fillable = [
		'nombre',
		'descripcion'
	];

	public function proyectos()
	{
		return $this->hasMany(Proyecto::class, 'tipo_proyecto_codigo');
	}
}
