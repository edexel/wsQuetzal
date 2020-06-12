<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $idInstanciaCodigos
 * @property int $idInstanciaSistema
 * @property string $codigo
 * @property integer $activo
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property InstanciaSistema $instanciaSistema
 */
class InstanciaCodigos extends Model
{
    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * @var array
     */
    protected $fillable = ['idInstanciaSistema', 'codigo', 'activo', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function instanciaSistema()
    {
        return $this->belongsTo('App\InstanciaSistema', 'idInstanciaSistema', 'idInstanciaSistema');
    }
}
