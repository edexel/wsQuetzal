<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class InstanciaCodigo
 * 
 * @property int $idInstanciaCodigos
 * @property int $idInstanciaSistema
 * @property string $codigo
 * @property bool $activo
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * 
 * @property InstanciaSistema $instancia_sistema
 *
 * @package App\Models
 */
class InstanciaCodigo extends Model
{
	use SoftDeletes;
	protected $table = 'instancia_codigos';
	protected $primaryKey = 'idInstanciaCodigos';

	protected $casts = [
		'idInstanciaSistema' => 'int',
		'activo' => 'bool'
	];

	protected $fillable = [
		'idInstanciaSistema',
		'codigo',
		'activo'
	];

	public function instancia_sistema()
	{
		return $this->belongsTo(InstanciaSistema::class, 'idInstanciaSistema');
	}
}
