<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Rol
 *
 * @property $id
 * @property $nombre_rol
 * @property $created_at
 * @property $updated_at
 *
 * @property RolesPermiso[] $rolesPermisos
 * @property Usuario[] $usuarios
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Rol extends Model
{
    
    static $rules = [
		'nombre_rol' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre_rol'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rolesPermisos()
    {
        return $this->hasMany('App\Models\RolesPermiso', 'IdRol', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function usuarios()
    {
        return $this->hasMany('App\Models\Usuario', 'id_rol', 'id');
    }
    

}
