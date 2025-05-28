<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Facultade
 * 
 * @property string $codigo
 * @property string $descripcion
 * @property string $institucion_codigo
 * 
 * @property Institucione $institucione
 * @property Collection|Departamento[] $departamentos
 *
 * @package App\Models
 */
class Facultade extends Model
{
	protected $table = 'facultades';
	protected $primaryKey = 'codigo';
	public $incrementing = false;
	public $timestamps = false;

	protected $fillable = [
		'descripcion',
		'institucion_codigo'
	];

	public function institucione()
	{
		return $this->belongsTo(Institucione::class, 'institucion_codigo');
	}

	public function departamentos()
	{
		return $this->hasMany(Departamento::class, 'facultad_codigo');
	}
}
