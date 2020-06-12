<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $idCliente
 * @property string $nombre
 * @property string $apellidos
 * @property string $email
 * @property string $password
 * @property string $descripcion
 * @property integer $Activo
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property InstanciaSistema[] $instanciaSistemas
 */
class Cliente extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'cliente';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * @var array
     */
    protected $fillable = ['nombre', 'apellidos', 'email', 'password', 'descripcion', 'Activo', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function instanciaSistemas()
    {
        return $this->hasMany('App\InstanciaSistema', 'id', 'idCliente');
    }
}
