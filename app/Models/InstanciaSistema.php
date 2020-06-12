<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $idInstanciaSistema
 * @property int $idCliente
 * @property string $nombre
 * @property string $descripcion
 * @property string $subDominio
 * @property integer $activo
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property Cliente $cliente
 * @property InstanciaCodigo[] $instanciaCodigos
 */
class InstanciaSistema extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'instancia_sistema';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * @var array
     */
    protected $fillable = ['idCliente', 'nombre', 'descripcion', 'subDominio', 'activo', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cliente()
    {
        return $this->belongsTo('App\Cliente', 'id', 'idCliente');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function instanciaCodigos()
    {
        return $this->hasMany('App\InstanciaCodigo', 'idInstanciaSistema', 'id');
    }
}
