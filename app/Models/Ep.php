<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Ep
 *
 * @property $id
 * @property $descripcion
 * @property $created_at
 * @property $updated_at
 *
 * @property Contrato[] $contratos
 * @property Paciente[] $pacientes
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Ep extends Model
{
    
    static $rules = [
		'eps' => 'required',
        'direccion'=> 'required',
        'telefonogeneral'=>'required',
        'telefonoprincipal'=>'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['eps','direccion','telefonogeneral','telefonoprincipal'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contratos()
    {
        return $this->hasMany('App\Models\Contrato', 'idEps', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pacientes()
    {
        return $this->hasMany('App\Models\Paciente', 'idEps', 'id');
    }
    

}
