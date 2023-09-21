<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Historia
 *
 * @property $id
 * @property $diagnostico
 * @property $signosvitales
 * @property $antecedentesalergicos
 * @property $evolucion
 * @property $tratamiento
 * @property $pacientes_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Paciente $paciente
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Historia extends Model
{
    
    static $rules = [
    'diagnostico'=>'required',
    'signosvitales'=>'required',
    'antecedentesalergicos'=>'required',
		'evolucion' => 'required',
		'tratamiento' => 'required',
		'pacientes_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['diagnostico','signosvitales','antecedentesalergicos','evolucion','tratamiento','pacientes_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function paciente()
    {
        return $this->hasOne('App\Models\Paciente', 'id', 'pacientes_id');
    }
    

}
