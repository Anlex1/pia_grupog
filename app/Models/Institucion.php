<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Institucion
 * 
 * @property string $codigo
 * @property string $nombre
 * @property string|null $direccion
 * @property string|null $telefono
 * 
 * @property Collection|Facultad[] $facultades
 *
 * @package App\Models
 */
class Institucion extends Model
{
	protected $table = 'instituciones';
	protected $primaryKey = 'codigo';
	public $incrementing = false;
	public $timestamps = false;

	protected $fillable = [
		'nombre',
		'direccion',
		'telefono'
	];

	public function facultades()
	{
		return $this->hasMany(Facultade::class, 'institucion_codigo');
	}
}
