<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Institucione
 * 
 * @property string $codigo
 * @property string $nombre
 * @property string|null $direccion
 * @property string|null $telefono
 * 
 * @property Collection|Facultade[] $facultades
 *
 * @package App\Models
 */
class Institucione extends Model
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
