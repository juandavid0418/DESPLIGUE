<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Contrato
 *
 * @property $id
 * @property $idEps
 * @property $costo
 * @property $politicas
 * @property $created_at
 * @property $updated_at
 *
 * @property Ep $ep
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Contrato extends Model
{
    
    static $rules = [
      'Nro_Contrato'=>'required',
		'idEps' => 'required',
		'fecha_inicio' => 'required',
		'fecha_fin' => 'required',
		'estado' => '',
    'razon_cancelacion'=>'',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['Nro_Contrato','idEps','fecha_inicio','fecha_fin','estado','razon_cancelacion'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function ep()
    {
        return $this->hasOne('App\Models\Ep', 'id', 'idEps');
    }
    
    public function eps(){
        return $this->belongsTo(Ep::class, 'idEps');
    }
  
    public function usuarios() {
        return $this->hasMany('App\Models\User', 'idContrato');
    }
    
    public function pacientes() {
        return $this->hasMany('App\Models\Paciente', 'idContrato');
    }
    

}
