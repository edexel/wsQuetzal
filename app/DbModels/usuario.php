<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $idUsuario
 * @property string $nombre
 * @property string $apellidos
 * @property string $descripcion
 * @property string $password
 * @property string $email
 * @property string $tokenRecover
 * @property integer $activo
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property Infousuario $infousuario
 * @property Usuariosesion[] $usuariosesions
 */
class usuario extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'usuario';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'idUsuario';

    /**
     * @var array
     */
    protected $fillable = ['nombre', 'apellidos', 'descripcion', 'password', 'email', 'tokenRecover', 'activo', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function infousuario()
    {
        return $this->hasOne('App\Infousuario', 'idUsuario', 'idUsuario');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function usuariosesions()
    {
        return $this->hasMany('App\Usuariosesion', 'idUsuario', 'idUsuario');
    }
}
