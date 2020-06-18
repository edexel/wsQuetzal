<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class InstanciaSistema
 * 
 * @property int $id
 * @property int $idCliente
 * @property string $nombre
 * @property string $descripcion
 * @property string $subDominio
 * @property bool $activo
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * 
 * @property Cliente $cliente
 * @property Collection|InstanciaCodigo[] $instancia_codigos
 *
 * @package App\Models
 */
class InstanciaSistema extends Model
{
	use SoftDeletes;
	protected $table = 'instancia_sistema';

	protected $casts = [
		'idCliente' => 'int',
		'activo' => 'bool'
	];

	protected $fillable = [
		'idCliente',
		'nombre',
		'descripcion',
		'subDominio',
		'activo'
	];

	public function cliente()
	{
		return $this->belongsTo(Cliente::class, 'idCliente');
	}

	public function instancia_codigos()
	{
		return $this->hasMany(InstanciaCodigo::class, 'idInstanciaSistema');
	}
}
