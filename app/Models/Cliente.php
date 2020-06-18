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
 * Class Cliente
 * 
 * @property int $idCliente
 * @property string $nombre
 * @property string $apellido
 * @property string $email
 * @property string $password
 * @property string $descripcion
 * @property bool $activo
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * 
 * @property Collection|InstanciaSistema[] $instancia_sistemas
 *
 * @package App\Models
 */
class Cliente extends Model
{
	use SoftDeletes;
	protected $table = 'cliente';
	protected $primaryKey = 'idCliente';

	protected $casts = [
		'activo' => 'bool'
	];

	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'nombre',
		'apellido',
		'email',
		'password',
		'descripcion',
		'activo'
	];

	public function instancia_sistemas()
	{
		return $this->hasMany(InstanciaSistema::class, 'idCliente');
	}
}
