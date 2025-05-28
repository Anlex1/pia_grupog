<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Departamento
 * 
 * @property string $codigo
 * @property string $descripcion
 * @property string $facultad_codigo
 * 
 * @property Facultade $facultade
 * @property Collection|Programa[] $programas
 *
 * @package App\Models
 */
class Departamento extends Model
{
	protected $table = 'departamentos';
	protected $primaryKey = 'codigo';
	public $incrementing = false;
	public $timestamps = false;

	protected $fillable = [
		'descripcion',
		'facultad_codigo'
	];

	public function facultade()
	{
		return $this->belongsTo(Facultade::class, 'facultad_codigo');
	}

	public function programas()
	{
		return $this->hasMany(Programa::class, 'departamento_codigo');
	}
}
