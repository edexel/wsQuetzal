<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $idInstanciaCodigos
 * @property int $idInstanciaSistema
 * @property string $codigo
 * @property integer $activo
 * @property InstanciaSistema $instanciaSistema
 */
class instancia_codigos extends Model
{
    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'idInstanciaCodigos';

    /**
     * @var array
     */
    protected $fillable = ['idInstanciaSistema', 'codigo', 'activo'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function instanciaSistema()
    {
        return $this->belongsTo('App\InstanciaSistema', 'idInstanciaSistema', 'idInstanciaSistema');
    }
}
