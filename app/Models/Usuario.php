<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $idUsuario
 * @property string $username
 * @property string $descripcion
 * @property string $password
 * @property string $email
 * @property string $tokenRecover
 * @property integer $Activo
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 */
class Usuario extends Model
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
    protected $primaryKey = 'id';

    /**
     * @var array
     */
    protected $fillable = ['username', 'descripcion', 'password', 'email', 'tokenRecover', 'Activo', 'created_at', 'updated_at', 'deleted_at'];

}
